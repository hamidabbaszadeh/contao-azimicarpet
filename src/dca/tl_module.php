<?php

/**
 * Add palettes to tl_module
 */

$GLOBALS['TL_DCA']['tl_module']['palettes']['carpet_detail']    = '{title_legend},name,headline,type;
                                                                   {category_legend},carpet_categories;
                                                                   {detail_legend},carpet_price,carpet_rating;
																   {template_legend:hide},carpet_template,customTpl,imgSize,fullsize;
																   {related_legend},related_show,related_template,related_imgSize,carpetList_Class,related_Class;
                                                                   {protected_legend:hide},protected;
																   {currency_legend},currency;
                                                                   {expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['carpet_list']      = '{title_legend},name,headline,type;
                                                                   {category_legend},carpet_categories;
                                                                   {detail_legend},carpet_price,carpet_rating,carpet_detailModule;
                                                                   {config_legend},carpet_status,carpet_sortBy,numberOfItems,perPage,skipFirst;
                                                                   {template_legend:hide},carpet_template,customTpl,imgSize,carpetList_Class,carpet_Class;
                                                                   {protected_legend:hide},protected;
																   {currency_legend},currency;
                                                                   {expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['carpet_carousel']  = '{title_legend},name,headline,type;
                                                                   {category_legend},carpet_categories;
                                                                   {detail_legend},carpet_price,carpet_rating;
                                                                   {config_legend},carpet_status,carpet_sortBy,numberOfItems;
                                                                   {template_legend:hide},carpet_template,customTpl,carpet_Class,imgSize;
                                                                   {protected_legend:hide},protected;
                                                                   {expert_legend:hide},guests,cssID,space';



/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_categories'] = array(
	'label'               => &$GLOBALS['TL_LANG']['tl_module']['carpet_categories'],
	'excude'              => true,
	'inputType'            => 'checkbox',
	'options_callback'     => array('tl_module_carpets', 'getCategories'),
	'eval'                 => array('multiple'=>true, 'mandatory'=>true),
    'sql'                  => "blob NULL"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_detailModule'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['carpet_detailModule'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_carpets', 'getDetailModules'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_module'],
	'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'                     => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_template'] = array
(
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['carpet_template'],
	'exclude'              => true,
	'inputType'            => 'select',
	'options_callback'     => array('tl_module_carpets', 'getCarpetsTemplates'),
	'eval'                 => array('tl_class'=>'w50'),
    'sql'                  => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpetList_Class'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['carpetList_Class'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_Class'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['carpet_Class'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50 clr'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_status'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['carpet_status'],
	'default'                 => 'all',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('all','feature','sale','preparing', 'stock','bestseller'),
	'reference'               => &$GLOBALS['TL_LANG']['carpet_status'],
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(16) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_sortBy'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['carpet_sortBy'],
	'default'                 => 'custom',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('custom','date_desc', 'date_asc','title_asc', 'title_desc','code_asc', 'code_desc'),
	'reference'               => &$GLOBALS['TL_LANG']['carpet_sortBy'],
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(16) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_price'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['carpet_price'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['carpet_rating'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['carpet_rating'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['currency'] = array
(
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['currency'],
	'default'              => 'TMN',
	'exclude'              => true,
	'inputType'            => 'select',
	'options'              => array('RLS','TMN'),
	'reference'            => &$GLOBALS['TL_LANG']['currency'],
	'eval'                 => array('tl_class'=>'w50'),
    'sql'                  => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['related_show'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['related_show'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array(),
	'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['related_template'] = array
(
	'label'                => &$GLOBALS['TL_LANG']['tl_module']['related_template'],
	'default'              => 'carpet_related',
	'exclude'              => true,
	'inputType'            => 'select',
	'options_callback'     => array('tl_module_carpets', 'getRelatedTemplates'),
	'eval'                 => array('tl_class'=>'w50'),
    'sql'                  => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['related_Class'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['related_Class'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['related_imgSize'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['related_imgSize'],
	'exclude'                 => true,
	'inputType'               => 'imageSize',
	'options'                 => System::getImageSizes(),
	'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'helpwizard'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);


/**
 * Class tl_module_cds
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Hamid Abbaszadeh 2010
 * @author     Hamid Abbaszadeh <http://respinar.com>
 * @package    Carpets Collection
 */
class tl_module_carpets extends Backend
{

	/**
	 * Return all prices templates as array
	 * @param object
	 * @return array
	 */
	public function getCarpetsTemplates()
	{
		return $this->getTemplateGroup('carpet_');
	}

	/**
	 * Return all related templates as array
	 *
	 * @return array
	 */
	public function getRelatedTemplates()
	{
		return $this->getTemplateGroup('related_');
	}

	/**
	 * Get all product detail modules and return them as array
	 * @return array
	 */
	public function getDetailModules()
	{
		$arrModules = array();
		$objModules = $this->Database->execute("SELECT m.id, m.name, t.name AS theme FROM tl_module m LEFT JOIN tl_theme t ON m.pid=t.id WHERE m.type='carpet_detail' ORDER BY t.name, m.name");

		while ($objModules->next())
		{
			$arrModules[$objModules->theme][$objModules->id] = $objModules->name . ' (ID ' . $objModules->id . ')';
		}

		return $arrModules;
	}

	/**
	 * Get all news archives and return them as array
	 * @return array
	 */
	public function getCategories()
	{
		//if (!$this->User->isAdmin && !is_array($this->User->news))
		//{
		//	return array();
		//}

		$arrCategories = array();
		$objCategories = $this->Database->execute("SELECT id, title FROM tl_carpets_category ORDER BY title");

		while ($objCategories->next())
		{
			//if ($this->User->hasAccess($objArchives->id, 'news'))
			//{
				$arrCategories[$objCategories->id] = $objCategories->title;
			//}
		}

		return $arrCategories;
	}
}
