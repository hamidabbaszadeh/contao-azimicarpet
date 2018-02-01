<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package Carpets
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Carpets',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'Carpets\ModuleCarpetList'     => 'system/modules/carpets/modules/ModuleCarpetList.php',
	'Carpets\ModuleCarpetDetail'   => 'system/modules/carpets/modules/ModuleCarpetDetail.php',
	'Carpets\ModuleCarpet'         => 'system/modules/carpets/modules/ModuleCarpet.php',
	'Carpets\ModuleCarpetCarousel' => 'system/modules/carpets/modules/ModuleCarpetCarousel.php',

	// Models
	'Carpets\CarpetsCategoryModel' => 'system/modules/carpets/models/CarpetsCategoryModel.php',
	'Carpets\CarpetsModel'         => 'system/modules/carpets/models/CarpetsModel.php',

	// Classes
	'Carpets\Carpets'              => 'system/modules/carpets/classes/Carpets.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_carpet_list'     => 'system/modules/carpets/templates/modules',
	'mod_carpet_detail'   => 'system/modules/carpets/templates/modules',
	'mod_carpet_carousel' => 'system/modules/carpets/templates/modules',
	'carpet_short'         => 'system/modules/carpets/templates/carpet',
	'carpet_full'          => 'system/modules/carpets/templates/carpet',
	'carpet_carousel'      => 'system/modules/carpets/templates/carpet',
));
