<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * @package Carpets
 * @link    https://respinar.com
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace Respinar\Carpets\Frontend\Module;

use Respinar\Carpets\Model\CarpetsModel;
use Respinar\Carpets\Model\CarpetsCategoryModel;

/**
 * Class ModuleCarpetCarousel
 *
 * Front end module "carpet carousel".
 */

class ModuleCarpetCarousel extends ModuleCarpet
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_carpet_carousel';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['carpet_list'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		$this->carpet_categories = $this->sortOutProtected(deserialize($this->carpet_categories));

		// No carpaets categries available
		if (!is_array($this->carpet_categories) || empty($this->carpet_categories))
		{
			return '';
		}

		// Show the catalog detail if an item has been selected
		if ($this->carpet_detailModule > 0 && (isset($_GET['items']) || ($GLOBALS['TL_CONFIG']['useAutoItem'] && isset($_GET['auto_item']))))
		{
			return $this->getFrontendModule($this->carpet_detailModule, $this->strColumn);
		}

		if (TL_MODE == 'FE' and $this->carpet_rating)
		{
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/carpets/assets/jquery.raty.min.js|static';
        }

        if (TL_MODE == 'FE')
		{
            $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/carpets/assets/jquery.jcarousel.min.js|static';
            $GLOBALS['TL_CSS'][]        = 'system/modules/carpets/assets/jcarousel.css';
        }

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{

		$this->Template->carpets = array();
		$this->Template->empty = $GLOBALS['TL_LANG']['MSC']['emptyCategory'];

		$arrOptions = array();
		if ($this->carpet_sortBy)
		{
			switch ($this->carpet_sortBy)
			{
				case 'title_asc':
					$arrOptions['order'] = "title ASC";
					break;
				case 'title_desc':
					$arrOptions['order'] = "title DESC";
					break;
				case 'alias_asc':
					$arrOptions['order'] = "alias ASC";
					break;
				case 'alias_desc':
					$arrOptions['order'] = "alias DESC";
					break;
				case 'date_asc':
					$arrOptions['order'] = "date ASC";
					break;
				case 'date_desc':
					$arrOptions['order'] = "date DESC";
					break;
				case 'custom':
					$arrOptions['order'] = "sorting ASC";
					break;
			}
		}

		$objCarpets = CarpetsModel::findPublishedByPids($this->carpet_categories, $this->numberOfItems, 0, $this->carpet_status,$arrOptions);

		// Add the Carpets
		if ($objCarpets !== null)
		{
			$this->Template->carpets = $this->parseCarpets($objCarpets);
		}

		$this->Template->gategories = $this->carpet_categories;
	}
}
