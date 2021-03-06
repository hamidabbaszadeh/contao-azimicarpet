<?php

System::loadLanguageFile('tl_content');


/**
 * Table tl_carpets
 */
$GLOBALS['TL_DCA']['tl_carpets'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_carpets_category',
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id'    => 'primary',
				'pid'   => 'index',
				'alias' => 'index'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('sorting'),
			'headerFields'            => array('title','jumpTo'),
			'panelLayout'             => 'search,limit',
			'child_record_callback'   => array('tl_carpets', 'generateItemRow')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpets']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),

			'stock' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpets']['stock'],
				'icon'                => 'system/modules/azimicarpet/assets/stock.png',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleStock(this,%s)"',
				'button_callback'     => array('tl_carpets', 'toggleIconStock')
			),
			'preparing' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpets']['preparing'],
				'icon'                => 'system/modules/azimicarpet/assets/preparing.png',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.togglePreparing(this,%s)"',
				'button_callback'     => array('tl_carpets', 'toggleIconPreparing')
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpets']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_carpets', 'toggleIcon')
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpets']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpets']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpets']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_carpets']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('sale','overwriteMeta'),
		'default'                     => '{title_legend},title,alias,date;{image_legend},singleSRC,overwriteMeta;{product_legend},brand,model,sku,global_ID;{price_legend},price,price_2,price_3,price_4,availability,priceValidUntil;{sale_legend:hide},sale;{seo_legend:hide},description;{text_legend},text;{status_legend},stock,preparing,bestseller,feature;{properties_legend},knots,colors,kwidth,kheight,silk;{rating_legend},rating_value,rating_count;{publish_legend},published,start,stop'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'sale'                   => 'price_sale',
		'overwriteMeta'          => 'alt,imageTitle'
	),

		// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
        'pid' => array
		(
			'foreignKey'              => 'tl_carpets_category.title',
			'relation'                => array('type'=>'belongsTo', 'load'=>'eager'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'sorting' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),		
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'visit' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['date'],
			'default'                 => time(),
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['alias'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'alias','unique'=>true,'maxlength'=>12, 'tl_class'=>'w50 clr'),
			'sql'                     => "varchar(12) NOT NULL default ''"
		),
		'brand' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['brand'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'model' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['model'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'global_ID' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['global_ID'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'options'				  => array('mpn','isbn','gtin8','gtin12','gtin13','gtin14'),
			'inputType'               => 'inputUnit',
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'eval'                    => array('includeBlankOption'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'sku' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['sku'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'availability' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['availability'],
			'inputType'               => 'select',
			'options'                 => array('Discontinued','InStock','LimitedAvailability','OutOfStock','PreOrder','PreSale','SoldOut'),
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'stock' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['stock'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'preparing' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['preparing'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'bestseller' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['bestseller'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'feature' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['feature'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'sale' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['sale'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50','submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'kwidth' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['kwidth'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit','maxlength'=>4, 'tl_class'=>'w50'),
			'sql'                     => "int(12) NOT NULL default '0'"
		),
		'kheight' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['kheight'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'maxlength'=>4, 'tl_class'=>'w50'),
			'sql'                     => "int(12) NOT NULL default '0'"
		),
		'colors' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['colors'],
			'exclude'                 => true,
			'filter'                  => false,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'maxlength'=>3, 'tl_class'=>'w50'),
			'sql'                     => "int(12) NOT NULL default '0'"
		),
		'knots' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['knots'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'maxlength'=>4,'tl_class'=>'w50'),
			'sql'                     => "int(12) NOT NULL default '50'"
		),
		'silk' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['silk'],
			'exclude'                 => true,
			'filter'                  => false,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'maxlength'=>3, 'tl_class'=>'w50'),
			'sql'                     => "int(12) NOT NULL default '0'"
		),
		'price' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['price'],
			'exclude'                 => true,
			'filter'                  => false,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true,'rgxp'=>'digit', 'maxlength'=>12, 'tl_class'=>'w50'),
			'sql'                     => "int(12) NOT NULL default '0'"
		),
		'price_2' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['price_2'],
			'exclude'                 => true,
			'filter'                  => false,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true,'rgxp'=>'digit', 'maxlength'=>12, 'tl_class'=>'w50'),
			'sql'                     => "int(12) NOT NULL default '0'"
		),
		'price_3' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['price_3'],
			'exclude'                 => true,
			'filter'                  => false,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true,'rgxp'=>'digit', 'maxlength'=>12, 'tl_class'=>'w50'),
			'sql'                     => "int(12) NOT NULL default '0'"
		),
		'price_4' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['price_4'],
			'exclude'                 => true,
			'filter'                  => false,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true,'rgxp'=>'digit', 'maxlength'=>12, 'tl_class'=>'w50'),
			'sql'                     => "int(12) NOT NULL default '0'"
		),
		'price_sale' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['price_sale'],
			'exclude'                 => true,
			'filter'                  => false,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true,'rgxp'=>'digit', 'maxlength'=>12, 'tl_class'=>'w50' ,'load'=>'lazy'),
			'sql'                     => "int(12) NOT NULL default '0'"
		),
		'priceValidUntil' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['priceValidUntil'],
			'default'                 => time(),
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'availability' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['availability'],
			'inputType'               => 'select',
			'options'                 => array('Discontinued','InStock','InStoreOnly','LimitedAvailability','OnlineOnly','OutOfStock','PreOrder','PreSale','SoldOut'),
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'singleSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['singleSRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'extensions'=>$GLOBALS['TL_CONFIG']['validImageTypes']),
			'sql'                     => "binary(16) NULL"
		),
		'overwriteMeta' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['overwriteMeta'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 clr'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'imageTitle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['imageTitle'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'alt' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['alt'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['description'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'search'                  => true,
			'eval'                    => array('style'=>'height:60px', 'decodeEntities'=>true, 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
		),
		'text' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['text'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE'),
			'sql'                     => "text NULL"
		),
		'rating_value' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['rating_value'],
			'exclude'                 => true,
			'filter'                  => false,
			'sorting'                 => true,			
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit','doNotCopy'=>true,'tl_class'=>'w50'),
			'sql'                     => "varchar(10) NOT NULL default '0'"
		),
		'rating_count' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['rating_count'],
			'exclude'                 => true,
			'filter'                  => false,
			'sorting'                 => true,			
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit','doNotCopy'=>true,'tl_class'=>'w50'),
			'sql'                     => "int(10) NOT NULL default '0'"
		),
		'related' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['related'],
			'exclude'                 => false,
			'inputType'               => 'checkbox',
			'options_callback'        => array('tl_carpets', 'getCarpets'),
			'eval'                    => array('includeBlankOption'=>true,'multiple'=>true),
			'sql'                     => "blob NULL"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'start' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['start'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'stop' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_carpets']['stop'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		)
	)
);


/**
 * Provide miscellaneous methods that are used by the data configuration array
 */
class tl_carpets extends Backend
{

	/**
	 * Generate a song row and return it as HTML string
	 * @param array
	 * @return string
	 */
	public function generateItemRow($arrRow)
	{
		$objImage = \FilesModel::findByPk($arrRow['singleSRC']);

		if ($objImage !== null)
		{
			$strImage = \Image::getHtml(\Image::get($objImage->path, '80', '60', 'center_center'));
		}

		return '<div><div style="float:left; margin-right:10px;">'.$strImage.'</div>'. $arrRow['title'] . '<br /><span>بازدید: '.$arrRow['visit'].'</span><br><span style="padding-left:3px;color:#b3b3b3;">کد: ' . $arrRow['alias'] . '<br>قیمت: '. number_format($arrRow[price]) .' ریال</span></div>';
	}

	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_prices::published', 'alexf'))
		//{
		//	return '';
		//}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}



	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions to edit
		$this->Input->setGet('id', $intId);
		$this->Input->setGet('act', 'toggle');
		//$this->checkPermission();

		// Check permissions to publish
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_news::published', 'alexf'))
		//{
		//	$this->log('Not enough permissions to publish/unpublish news item ID "'.$intId.'"', 'tl_news toggleVisibility', TL_ERROR);
		//	$this->redirect('contao/main.php?act=error');
		//}

		$this->createInitialVersion('tl_carpets', $intId);

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_carpets']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_carpets']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_carpets SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_carpets', $intId);

	}

	public function toggleIconStock($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('sid')))
		{
			$this->toggleStock($this->Input->get('sid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_prices::published', 'alexf'))
		//{
		//	return '';
		//}

		$href .= '&amp;sid='.$row['id'].'&amp;state='.($row['stock'] ? '' : 1);

		if (!$row['stock'])
		{
			$icon = 'system/modules/azimicarpet/assets/stock_.png';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}



	public function toggleStock($intId, $blnStock)
	{
		// Check permissions to edit
		$this->Input->setGet('id', $intId);
		$this->Input->setGet('act', 'stock');
		//$this->checkPermission();

		// Check permissions to publish
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_news::published', 'alexf'))
		//{
		//	$this->log('Not enough permissions to publish/unpublish news item ID "'.$intId.'"', 'tl_news toggleVisibility', TL_ERROR);
		//	$this->redirect('contao/main.php?act=error');
		//}

		$this->createInitialVersion('tl_carpets', $intId);

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_carpets']['fields']['stock']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_carpets']['fields']['stock']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnStock = $this->$callback[0]->$callback[1]($blnStock, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_carpets SET tstamp=". time() .", stock='" . ($blnStock ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_carpets', $intId);

	}

	public function toggleIconPreparing($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('pid')))
		{
			$this->togglePreparing($this->Input->get('pid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_prices::published', 'alexf'))
		//{
		//	return '';
		//}

		$href .= '&amp;pid='.$row['id'].'&amp;state='.($row['preparing'] ? '' : 1);

		if (!$row['preparing'])
		{
			$icon = 'system/modules/azimicarpet/assets/preparing_.png';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}



	public function togglePreparing($intId, $blnPreparing)
	{
		// Check permissions to edit
		$this->Input->setGet('id', $intId);
		$this->Input->setGet('act', 'preparing');
		//$this->checkPermission();

		// Check permissions to publish
		//if (!$this->User->isAdmin && !$this->User->hasAccess('tl_news::published', 'alexf'))
		//{
		//	$this->log('Not enough permissions to publish/unpublish news item ID "'.$intId.'"', 'tl_news toggleVisibility', TL_ERROR);
		//	$this->redirect('contao/main.php?act=error');
		//}

		$this->createInitialVersion('tl_carpets', $intId);

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_carpets']['fields']['preparing']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_carpets']['fields']['preparing']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnPreparing = $this->$callback[0]->$callback[1]($blnPreparing, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_carpets SET tstamp=". time() .", preparing='" . ($blnPreparing ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_carpets', $intId);

	}

	/**
	 * Get records from the master category
	 *
	 * @param	DataContainer
	 * @return	array
	 * @link	http://www.contao.org/callbacks.html#options_callback
	 */
	public function getCarpets(DataContainer $dc)
	{

		$objItems = $this->Database->prepare("SELECT * FROM tl_carpets WHERE pid=? ORDER BY date DESC")->execute($dc->activeRecord->pid);

		while( $objItems->next() )
		{
			if ($objItems->id !== $dc->activeRecord->id) {

				$arrItems[$objItems->id] = $objItems->title;

				if($objItems->model) {
					$arrItems[$objItems->id] .= ' [model: ' . $objItems->model .']';
				}

				if ($objItems->sku) {
					$arrItems[$objItems->id] .= ' (sku: ' . $objItems->sku .')';
				} 				
				
			}
		}

		return $arrItems;
	}

}
