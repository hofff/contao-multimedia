<?php

if(!isset($GLOBALS['TL_DCA']['tl_news4ward_article'])) {
	return;
}

$this->loadLanguageFile('bbit_mm');

call_user_func(function() {
	$dca = &$GLOBALS['TL_DCA']['tl_news4ward_article'];

	$dca['palettes']['__selector__'][] = 'bbit_mm_player';
	$dca['palettes']['__selector__'][] = 'bbit_mm_sizing';

	$palette = ',bbit_mm_media,bbit_mm_sizing,bbit_mm_player';
	$dca['palettes']['default'] = str_replace(
		',teaserCssID',
		',teaserCssID' . $palette,
		$dca['palettes']['default']
	);

	$dca['subpalettes']['bbit_mm_sizing_bbit_mm_custom'] = 'bbit_mm_size';

	unset($dca);
});



$GLOBALS['TL_DCA']['tl_news4ward_article']['fields']['bbit_mm_media'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['bbit_mm']['media'],
	'exclude'		=> true,
	'inputType'		=> 'select',
	'foreignKey'	=> 'tl_bbit_mm.title',
	// 	'options_callback' => array('MultimediaDCA', 'getMedia'),
	'eval'			=> array(
// 		'mandatory'			=> true,
		'chosen'			=> true,
		'submitOnChange'	=> true,
		'includeBlankOption'=> true,
		'blankOptionLabel'	=> &$GLOBALS['TL_LANG']['MSC']['blankOption'],
		'tl_class'			=> 'clr'
	),
	'wizard'		=> array(
		array('MultimediaDCA', 'getEditMediaWizard')
	),
	'sql'			=> 'int(10) unsigned NOT NULL default \'0\'',
);

$GLOBALS['TL_DCA']['tl_news4ward_article']['fields']['bbit_mm_sizing'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['bbit_mm']['sizing'],
	'exclude'		=> true,
	'inputType'		=> 'select',
	'default'		=> 'bbit_mm_player',
	'options'		=> array('bbit_mm_player', 'bbit_mm_adjustHeight', 'bbit_mm_adjustWidth', 'bbit_mm_custom'),
	'reference'		=> &$GLOBALS['TL_LANG']['bbit_mm']['sizingOptions'],
	'eval'			=> array(
		'mandatory'			=> true,
		'submitOnChange'	=> true,
		'tl_class'			=> 'clr w50'
	),
	'sql'			=> 'varchar(255) NOT NULL default \'\'',
);

$GLOBALS['TL_DCA']['tl_news4ward_article']['fields']['bbit_mm_size'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['bbit_mm']['size'],
	'exclude'		=> true,
	'inputType'		=> 'text',
	'eval'			=> array(
		'mandatory'			=> true,
		'multiple'			=> true,
		'size'				=> 2,
		'rgxp'				=> 'digit',
		'tl_class'			=> 'w50'
	),
	'save_callback'	=> array(
		array('MultimediaDCA', 'saveSize')
	),
	'sql'			=> 'varchar(255) NOT NULL default \'\'',
);

$GLOBALS['TL_DCA']['tl_news4ward_article']['fields']['bbit_mm_player'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['bbit_mm']['player'],
	'exclude'		=> true,
	'inputType'		=> 'select',
	'options'		=> array_keys((array) $GLOBALS['BBIT_MM_PLAYERS']),
	'reference'		=> &$GLOBALS['TL_LANG']['bbit_mm']['players'],
	'eval'			=> array(
		'submitOnChange'	=> true,
		'includeBlankOption'=> true,
		'blankOptionLabel'	=> &$GLOBALS['TL_LANG']['bbit_mm']['playerBlankOption'],
		'tl_class'			=> 'clr w50'
	),
	'sql'			=> 'varchar(255) NOT NULL default \'\'',
);

