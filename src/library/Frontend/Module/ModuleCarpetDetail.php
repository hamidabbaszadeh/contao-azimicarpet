<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Carpets
 * @link    https://respinar.com
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Respinar\Carpets\Frontend\Module;

use Respinar\Carpets\Model\CarpetsModel;
use Respinar\Carpets\Model\CarpetsCategoryModel;

/**
 * Class ModuleCarpetDetail
 *
 * Front end module "carpet deatil".
 */
class ModuleCarpetDetail extends ModuleCarpet
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_carpet_detail';

	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['carpet_reader'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		if (TL_MODE == 'FE' and $this->carpet_rating)
		{
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/carpets/assets/jquery.raty.min.js|static';
        }

        $this->carpet_categories = $this->sortOutProtected(deserialize($this->carpet_categories));

		// Set the item from the auto_item parameter
		if (!isset($_GET['items']) && $GLOBALS['TL_CONFIG']['useAutoItem'] && isset($_GET['auto_item']))
		{
			\Input::setGet('items', \Input::get('auto_item'));
		}



		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{

		global $objPage;

		$this->Template->carpets = '';
		$this->Template->referer = 'javascript:history.go(-1)';
		$this->Template->back = $GLOBALS['TL_LANG']['MSC']['goBack'];

		$objCarpet = \CarpetsModel::findPublishedByParentAndIdOrAlias(\Input::get('items'),$this->carpet_categories);

		// Overwrite the page title
		if ($objCarpet->title != '')
		{
			$objPage->pageTitle = strip_tags(strip_insert_tags($objCarpet->title));
		}

		// Overwrite the page description
		if ($objCarpet->description != '')
		{
			$objPage->description = $this->prepareMetaDescription($objCarpet->description);
		}

		if ($objCarpet->keywords != '')
		{
			$GLOBALS['TL_KEYWORDS'] .= (($GLOBALS['TL_KEYWORDS'] != '') ? ', ' : '') . $objCarpet->keywords;
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_carpets SET `visit`=`visit`+1 WHERE id=?")
					   ->execute($objCarpet->id);

		$arrCarpet = $this->parseCarpet($objCarpet);

		$this->Template->carpets = $arrCarpet;


	}
}
