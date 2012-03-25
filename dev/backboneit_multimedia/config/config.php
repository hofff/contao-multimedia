<?php

$GLOBALS['BE_MOD']['content']['bbit_mm'] = array(
	'tables'	=> array('tl_bbit_mm'),
	'icon'		=> ''
);

//$GLOBALS['TL_CTE']['backboneit']['backboneit_jwplayer'] = 'ContentJWPlayer';
//$GLOBALS['FE_MOD']['backboneit']['backboneit_jwplayer'] = 'ModuleJWPlayer';

//ffs, missing module dependencies requiring this way...
//$GLOBALS['TL_HOOKS']['loadDataContainer'][] = array('JWPlayerDCA', 'setup');
	
$GLOBALS['TL_MIME']['mp4'] = array('video/mp4', 'iconVIDEO.gif');
$GLOBALS['TL_MIME']['m4v'] = array('video/mp4', 'iconVIDEO.gif');
$GLOBALS['TL_MIME']['ogv'] = array('video/ogg', 'iconVIDEO.gif');
$GLOBALS['TL_MIME']['flv'] = array('video/x-flv', 'iconVIDEO.gif');
