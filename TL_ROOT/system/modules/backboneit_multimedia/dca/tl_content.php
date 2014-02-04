<?php

$this->loadLanguageFile('bbit_mm');

// $GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'bbit_mm_mediabox';
// $GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'bbit_mm_linkpreview';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'bbit_mm_player';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'bbit_mm_sizing';

$GLOBALS['TL_DCA']['tl_content']['palettes']['bbit_mm']
	= '{type_legend},type,headline;'
	. '{bbit_mm_media_legend},bbit_mm_media,bbit_mm_sizing;'
// 	. '{bbit_mm_mediabox_legend},bbit_mm_mediabox;'
	. '{bbit_mm_player_legend},bbit_mm_player;'
	. '{protected_legend:hide},protected;'
	. '{expert_legend:hide},guests,cssID,space';

// $GLOBALS['TL_DCA']['tl_content']['palettes']['bbit_mm_mediabox']
// 	= '{type_legend},type,headline;'
// 	. '{bbit_mm_media_legend},bbit_mm_media,bbit_mm_sizing;'
// 	. '{bbit_mm_mediabox_legend},bbit_mm_mediabox,bbit_mm_linkpreview,bbit_mm_group;'
// 	. '{bbit_mm_player_legend},bbit_mm_player;'
// 	. '{protected_legend:hide},protected;'
// 	. '{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_content']['subpalettes']['bbit_mm_sizing_custom']
	= 'bbit_mm_size';
// $GLOBALS['TL_DCA']['tl_content']['subpalettes']['bbit_mm_linkpreview_bbit_mm_linkpreview_text']
// 	= 'bbit_mm_link,bbit_mm_embedlink';
// $GLOBALS['TL_DCA']['tl_content']['subpalettes']['bbit_mm_linkpreview_bbit_mm_linkpreview_preview']
// 	= 'bbit_mm_previewsize,bbit_mm_previewcaption';


$GLOBALS['TL_DCA']['tl_content']['fields']['bbit_mm_media'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['bbit_mm']['media'],
	'exclude'		=> true,
	'inputType'		=> 'select',
	'foreignKey'	=> 'tl_bbit_mm.title',
// 	'options_callback' => array('MultimediaDCA', 'getMedia'),
	'eval'			=> array(
		'mandatory'			=> true,
		'chosen'			=> true,
		'submitOnChange'	=> true,
		'includeBlankOption'=> true,
		'blankOptionLabel'	=> &$GLOBALS['TL_LANG']['MSC']['blankOption'],
// 		'tl_class'			=> 'clr'
	),
	'wizard'		=> array(
		array('MultimediaDCA', 'getEditMediaWizard')
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['bbit_mm_sizing'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['bbit_mm']['sizing'],
	'exclude'		=> true,
	'inputType'		=> 'select',
	'default'		=> 'player',
	'options'		=> array('player', 'adjustHeight', 'adjustWidth', 'custom'),
	'reference'		=> &$GLOBALS['TL_LANG']['bbit_mm']['sizingOptions'],
	'eval'			=> array(
		'mandatory'			=> true,
		'submitOnChange'	=> true,
		'tl_class'			=> 'clr w50'
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['bbit_mm_size'] = array(
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
	)
);


$GLOBALS['TL_DCA']['tl_content']['fields']['bbit_mm_mediabox'] = array(
	'label'		=> &$GLOBALS['TL_LANG']['bbit_mm']['mediabox'],
	'exclude'	=> true,
	'inputType'	=> 'valuedCheckbox',
	'eval'		=> array(
		'submitOnChange'	=> true,
		'checkedValue'		=> 'bbit_mm_mediabox',
		'tl_class'			=> 'clr w50 cbx'
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['bbit_mm_linkpreview'] = array(
	'label'		=> &$GLOBALS['TL_LANG']['bbit_mm']['linkpreview'],
	'exclude'	=> true,
	'inputType'	=> 'valuedCheckbox',
	'eval'		=> array(
		'submitOnChange'	=> true,
		'uncheckedValue'	=> 'bbit_mm_linkpreview_text',
		'checkedValue'		=> 'bbit_mm_linkpreview_preview',
		'tl_class'			=> 'w50 cbx'
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['bbit_mm_link'] = array(
	'label'		=> &$GLOBALS['TL_LANG']['bbit_mm']['link'],
	'exclude'		=> false,
	'inputType'		=> 'text',
	'eval'			=> array(
		'decodeEntities'	=> true,
		'tl_class'			=> 'clr w50'
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['bbit_mm_embedlink'] = array(
	'label'		=> &$GLOBALS['TL_LANG']['bbit_mm']['embedlink'],
	'exclude'		=> false,
	'inputType'		=> 'text',
	'eval'			=> array(
		'decodeEntities'	=> true,
		'tl_class'			=> 'w50'
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['bbit_mm_previewsize'] = array(
	'label'		=> &$GLOBALS['TL_LANG']['bbit_mm']['previewsize'],
	'exclude'	=> true,
	'inputType'	=> 'imageSize',
	'options'	=> array('crop', 'proportional', 'box'),
	'reference'	=> &$GLOBALS['TL_LANG']['MSC'],
	'eval'		=> array(
		'rgxp'				=> 'digit',
		'nospace'			=> true,
		'tl_class'			=> 'clr w50'
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['bbit_mm_previewcaption'] = array(
	'label'		=> &$GLOBALS['TL_LANG']['bbit_mm']['previewcaption'],
	'exclude'	=> true,
	'inputType'	=> 'text',
	'eval'		=> array(
		'maxlength'			=> 255,
		'tl_class'			=> 'w50'
	)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['bbit_mm_group'] = array(
	'label'		=> &$GLOBALS['TL_LANG']['bbit_mm']['group'],
	'exclude'	=> false,
	'inputType'	=> 'text',
	'eval'		=> array(
		'rgxp'				=> 'alnum',
		'nospace'			=> true,
		'tl_class'			=> 'w50'
	)
);


$GLOBALS['TL_DCA']['tl_content']['fields']['bbit_mm_player'] = array(
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
);
