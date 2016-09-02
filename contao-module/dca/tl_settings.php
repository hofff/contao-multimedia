<?php

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default']
	.= ';{bbit_mm_legend},bbit_mm_youtube_apikey';

$GLOBALS['TL_DCA']['tl_settings']['fields']['bbit_mm_youtube_apikey'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_settings']['bbit_mm_youtube_apikey'],
	'exclude'		=> true,
	'inputType'		=> 'text',
	'eval'			=> array(
		'decodeEntities'	=> true,
		'tl_class'			=> 'w50',
	),
);
