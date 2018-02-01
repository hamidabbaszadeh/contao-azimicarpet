<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_carpet_list'      => 'system/modules/carpets/templates/modules',
	'mod_carpet_detail'    => 'system/modules/carpets/templates/modules',
	'mod_carpet_carousel'  => 'system/modules/carpets/templates/modules',
	'carpet_short'         => 'system/modules/carpets/templates/carpet',
	'carpet_full'          => 'system/modules/carpets/templates/carpet',
	'carpet_carousel'      => 'system/modules/carpets/templates/carpet',
));
