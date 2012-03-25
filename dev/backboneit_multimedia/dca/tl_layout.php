<?php

foreach($GLOBALS['TL_DCA']['tl_layout']['palettes'] as $strKey => &$strPalette)
	if($strKey != '__selector__')
		$strPalette .= ';{backboneit_video_jwplayer_legend},backboneit_video_jwplayer';

$GLOBALS['TL_DCA']['tl_layout']['fields']['backboneit_video_jwplayer'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['backboneit_video']['jwplayer'],
	'exclude'		=> true,
	'inputType'		=> 'select',
	'options_callback' => array('JWPlayerDCA', 'getJWPlayers'),
	'eval'			=> array(
		'submitOnChange'	=> true,
		'includeBlankOption' => true,
		'blankOptionLabel'	=> &$GLOBALS['TL_LANG']['MSC']['blankOption'],
		'tl_class'			=> 'clr'
	),
	'wizard'		=> array(
		array('JWPlayerDCA', 'getEditJWPlayerWizard')
	)
);
