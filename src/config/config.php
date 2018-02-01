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
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD'], 1, array
(
	'products' => array
	(
		'yarns' => array
		(
			'tables' => array('tl_carpets_category', 'tl_carpets'),
			'icon'   => 'system/modules/carpets/assets/icon.png'
		)
	)
));


/**
 * Front end modules
 */

array_insert($GLOBALS['FE_MOD'], 2, array
(
	'carpets' => array
	(
		'carpet_list'      => 'Respinar\Carpets\Frontend\Module\ModuleCarpetList',
		'carpet_detail'    => 'Respinar\Carpets\Frontend\Module\ModuleCarpetDetail',
		'carpet_carousel'  => 'Respinar\Carpets\Frontend\Module\ModuleCarpetCarousel'
	)
));

/**
 * Register models
 */

$GLOBALS['TL_MODELS']['tl_carpets']          = 'Respinar\Carpets\Model\CarpetsModel';
$GLOBALS['TL_MODELS']['tl_carpets_category'] = 'Respinar\Carpets\Model\CarpetsCategoryModel'; 


/**
 * Register hook to add carpets items to the indexer
 */
$GLOBALS['TL_HOOKS']['getSearchablePages'][] = array('Respinar\Carpets\Carpets', 'getSearchablePages');
