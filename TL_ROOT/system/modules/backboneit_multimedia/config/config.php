<?php

$GLOBALS['BE_MOD']['content']['bbit_mm'] = array(
	'tables'	=> array('tl_bbit_mm', 'tl_bbit_mm_captions'),
	'icon'		=> ''
);

$GLOBALS['BE_FFL']['valuedCheckbox'] = 'ValuedCheckBox';

$GLOBALS['TL_CTE']['includes']['bbit_mm'] = 'ContentMultimedia';
//$GLOBALS['FE_MOD']['backboneit']['backboneit_jwplayer'] = 'ModuleJWPlayer';

//ffs, missing module dependencies requiring this way...
//$GLOBALS['TL_HOOKS']['loadDataContainer'][] = array('JWPlayerDCA', 'setup');
	
$GLOBALS['TL_MIME']['mp4'] = array('video/mp4', 'iconVIDEO.gif');
$GLOBALS['TL_MIME']['m4v'] = array('video/mp4', 'iconVIDEO.gif');
$GLOBALS['TL_MIME']['ogv'] = array('video/ogg', 'iconVIDEO.gif');
$GLOBALS['TL_MIME']['flv'] = array('video/x-flv', 'iconVIDEO.gif');

$GLOBALS['BBIT_MM_TYPES']['video'] = 'MultimediaVideo';
// $GLOBALS['BBIT_MM_TYPES']['audio'] = 'MultimediaAudio';
// $GLOBALS['BBIT_MM_TYPES']['youtube'] = 'MultimediaYoutube';
// $GLOBALS['BBIT_MM_TYPES']['rtmp'] = 'MultimediaStreamRTMP';
// $GLOBALS['BBIT_MM_TYPES']['http'] = 'MultimediaStreamHTTP';
