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


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Respinar\Carpets\Model;


/**
 * Reads and writes carpets categories
 *
 * @package   Models
 * @author    Hamid Abbaszadeh <http://respinar.com>
 * @copyright Hamid Abbaszadeh 2013-2014
 */
class CarpetsCategoryModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_carpets_category';

}
