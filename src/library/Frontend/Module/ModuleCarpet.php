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
 * Class ModuleCarpetReader
 *
 * Front end module "carpet reader".
 */
abstract class ModuleCarpet extends \Module
{

	/**
	 * URL cache array
	 * @var array
	 */
	private static $arrUrlCache = array();


	/**
	 * Sort out protected archives
	 * @param array
	 * @return array
	 */
	protected function sortOutProtected($arrCategories)
	{
		if (BE_USER_LOGGED_IN || !is_array($arrCategories) || empty($arrCategories))
		{
			return $arrCategories;
		}

		$this->import('FrontendUser', 'User');
		$objCategory = CarpetsCategoryModel::findMultipleByIds($arrCategories);
		$arrCategories = array();

		if ($objCategory !== null)
		{
			while ($objCategory->next())
			{
				if ($objCategory->protected)
				{
					if (!FE_USER_LOGGED_IN)
					{
						continue;
					}

					$groups = deserialize($objCategory->groups);

					if (!is_array($groups) || empty($groups) || !count(array_intersect($groups, $this->User->groups)))
					{
						continue;
					}
				}

				$arrCategories[] = $objCategory->id;
			}
		}

		return $arrCategories;
	}


	/**
	 * Parse an item and return it as string
	 * @param object
	 * @param boolean
	 * @param string
	 * @param integer
	 * @return string
	 */
	protected function parseCarpet($objCarpet, $blnAddCategory=false, $strClass='', $intCount=0)
	{
		global $objPage;

		$objTemplate = new \FrontendTemplate($this->carpet_template);
		$objTemplate->setData($objCarpet->row());

		$objTemplate->meta_price_txt   = $GLOBALS['TL_LANG']['MSC']['price_text'];
		$objTemplate->meta_brand_txt   = $GLOBALS['TL_LANG']['MSC']['brand'];
		$objTemplate->meta_model_txt   = $GLOBALS['TL_LANG']['MSC']['model'];
		$objTemplate->meta_global_ID_txt = $GLOBALS['TL_LANG']['MSC']['global_ID'];
		$objTemplate->meta_sku_txt     = $GLOBALS['TL_LANG']['MSC']['sku'];		
		$objTemplate->meta_status_txt  = $GLOBALS['TL_LANG']['MSC']['status'];

		$objTemplate->meta_vote_txt    = $GLOBALS['TL_LANG']['MSC']['vote'];

		$objTemplate->meta_availability_txt = $GLOBALS['TL_LANG']['MSC'][$objCarpet->availability];


		$objTemplate->class = (($this->carpet_Class != '') ? ' ' . $this->carpet_Class : '') . $strClass;

		if (time() - $objCarpet->date < 2592000)
			$objTemplate->new = true;

		if ($this->carpet_rating) {			
			$objTemplate->rateid = $this->generateRandomString();
		}

		$objTemplate->totalknots = $objCarpet->kwidth * $objCarpet->kheight;

		if ($objCarpet->knots > 0) {
			$objTemplate->widthcm  = round(($objCarpet->kwidth * 7 )/ $objCarpet->knots);
			$objTemplate->heightcm = round(($objCarpet->kheight * 7)/ $objCarpet->knots);
		} else {
			$objTemplate->widthcm = '-';
			$objTemplate->heightcm = '-';
		}

		$objTemplate->datetime = date('Y-m-d\TH:i:sP', $objCarpet->date);

		if ($this->carpet_price)
		{

			if ($objCarpet->sale)
			{
				$objCarpet->price = $objCarpet->price_sale;
			}

			$objCategory = CarpetsCategoryModel::findByIdOrAlias($objCarpet->pid);

			$objCarpet->price   = $objCarpet->price   * (1 + $objCategory->price_1_inc /100);
			$objCarpet->price_2 = $objCarpet->price_2 * (1 + $objCategory->price_2_inc /100);
			$objCarpet->price_3 = $objCarpet->price_3 * (1 + $objCategory->price_3_inc /100);
			$objCarpet->price_4 = $objCarpet->price_4 * (1 + $objCategory->price_4_inc /100);

			if ($this->currency == "TMN") {
					$objCarpet->price   = $objCarpet->price   / 10;
					$objCarpet->price_2 = $objCarpet->price_2 / 10;
					$objCarpet->price_3 = $objCarpet->price_3 / 10;
					$objCarpet->price_4 = $objCarpet->price_4 / 10;
			}

			$objTemplate->n_price   = number_format($objCarpet->price);

			$objTemplate->n_price_2 = $objCarpet->price_2 ? number_format($objCarpet->price_2) : 0;
			$objTemplate->n_price_3 = $objCarpet->price_3 ? number_format($objCarpet->price_3) : 0;
			$objTemplate->n_price_4 = $objCarpet->price_4 ? number_format($objCarpet->price_4) : 0;

			$objTemplate->show_price = $this->carpet_price;

			$objTemplate->currency_string = $GLOBALS['TL_LANG']['MSC'][$this->currency];
			$objTemplate->priceValidUntil = date('Y-m-d\TH:i:sP', $objProduct->priceValidUntil);

		}

		$objTemplate->link        = $this->generateCarpetUrl($objCarpet, $blnAddCategory);
		$objTemplate->more        = $this->generateLink($GLOBALS['TL_LANG']['MSC']['moredetail'], $objCarpet, $blnAddCategory, true);

		$objTemplate->category    = $objCarpet->getRelated('pid');

		$objTemplate->count = $intCount; // see #5708

		// Add an image
		if ($objCarpet->singleSRC != '')
		{
			$objModel = \FilesModel::findByUuid($objCarpet->singleSRC);

			if ($objModel !== null && is_file(\System::getContainer()->getParameter('kernel.project_dir') . '/' . $objModel->path))			
			{
				// Do not override the field now that we have a model registry (see #6303)
				$arrCarpet = $objCarpet->row();

				// Override the default image size
				if ($this->imgSize != '')
				{
					$size = \StringUtil::deserialize($this->imgSize);

					if ($size[0] > 0 || $size[1] > 0 || is_numeric($size[2]))
					{
						$arrCarpet['size'] = $this->imgSize;
					}
				}
				
				$arrCarpet['singleSRC'] = $objModel->path;		
				
				// Link to the product detail if no image link has been defined		
				$picture = $objTemplate->picture;
				unset($picture['title']);
				$objTemplate->picture = $picture;

				$objTemplate->href = $objTemplate->link;
				$objTemplate->linkTitle = \StringUtil::specialchars(sprintf($GLOBALS['TL_LANG']['MSC']['moreDetail'], $objCarpet->title), true);
				
				$this->addImageToTemplate($objTemplate, $arrCarpet, null, null, $objModel);

			}
		}

		return $objTemplate->parse();
	}


	/**
	 * Parse one or more items and return them as array
	 * @param object
	 * @param boolean
	 * @return array
	 */
	protected function parseCarpets($objCarpets, $blnAddCategory=false)
	{
		$limit = $objCarpets->count();

		if ($limit < 1)
		{
			return array();
		}

		$count = 0;
		$arrCarpets = array();

		while ($objCarpets->next())
		{
			$arrCarpets[] = $this->parseCarpet($objCarpets, $blnAddCategory, ((++$count == 1) ? ' first' : '') . (($count == $limit) ? ' last' : ''), $count);
		}

		return $arrCarpets;
	}

	/**
	 * Generate a URL and return it as string
	 * @param object
	 * @param boolean
	 * @return string
	 */
	protected function generateCarpetUrl($objItem, $blnAddCategory=false)
	{
		$strCacheKey = 'id_' . $objItem->id;

		// Load the URL from cache
		if (isset(self::$arrUrlCache[$strCacheKey]))
		{
			return self::$arrUrlCache[$strCacheKey];
		}

		// Initialize the cache
		self::$arrUrlCache[$strCacheKey] = null;

		// Link to the default page
		if (self::$arrUrlCache[$strCacheKey] === null)
		{
			$objPage = \PageModel::findByPk($objItem->getRelated('pid')->jumpTo);

			if ($objPage === null)
			{
				self::$arrUrlCache[$strCacheKey] = ampersand(\Environment::get('request'), true);
			}
			else
			{
				self::$arrUrlCache[$strCacheKey] = ampersand($this->generateFrontendUrl($objPage->row(), ((\Config::get('useAutoItem') && !\Config::get('disableAlias')) ?  '/' : '/items/') . ((!\Config::get('disableAlias') && $objItem->alias != '') ? $objItem->alias : $objItem->id)));
			}

		}

		return self::$arrUrlCache[$strCacheKey];
	}


	/**
	 * Generate a link and return it as string
	 * @param string
	 * @param object
	 * @param boolean
	 * @param boolean
	 * @return string
	 */
	protected function generateLink($strLink, $objCarpet, $blnAddCategory=false, $blnIsReadMore=false)
	{

		return sprintf('<a href="%s" title="%s">%s%s</a>',
						$this->generateCarpetUrl($objCarpet, $blnAddCategory),
						specialchars(sprintf($GLOBALS['TL_LANG']['MSC']['readMore'], $objCarpet->title), true),
						$strLink,
						($blnIsReadMore ? ' <span class="invisible">'.$objCarpet->title.'</span>' : ''));

	}

	/**
	 * Generate a random string
	 * @param int
	 * @return string
	 */
	protected function generateRandomString($length = 4)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);

		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
	return $randomString;
}


}
