<?php


'source' => array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['source'],
	'inputType'		=> 'text',
	'eval'			=> array(
		'mandatory'			=> true,
		'maxlength'			=> 1023,
		'rgxp'				=> 'url',
		'tl_class'			=> 'clr long',
		'decodeEntities'	=> true
	)
),

'size' => array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['size'],
	'exclude'		=> true,
	'inputType'		=> 'text',
	'eval'			=> array(
		'multiple'			=> true,
		'size'				=> 2,
		'rgxp'				=> 'digit',
		'tl_class'			=> 'clr w50'
	),
	'save_callback'	=> array(
		array('MultimediaDCA', 'validateSize')
	),
),
// require_once 'fields.php';

// $GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('JWPlayerDCA', 'checkPlayer');
// $GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = array('JWPlayerDCA', 'checkPlayable');
// $GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = array('JWPlayerDCA', 'processYouTube');
// $GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = array('JWPlayerDCA', 'processPreview');

// $GLOBALS['TL_DCA']['tl_content']['palettes']['backboneit_jwplayer']
// 	= '{type_legend},type,headline;{backboneit_jwplayer_media_legend},' . $GLOBALS['backboneit_jwplayer']['palette_media'] . ';'
// 	. '{backboneit_jwplayer_mediabox_legend},backboneit_jwplayer_mediabox;'
// 	. '{backboneit_jwplayer_legend},backboneit_jwplayer_player;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

// $GLOBALS['TL_DCA']['tl_content']['subpalettes']['backboneit_jwplayer_type']
// 	= $GLOBALS['backboneit_jwplayer']['palette_type'];
// $GLOBALS['TL_DCA']['tl_content']['subpalettes']['backboneit_jwplayer_mediabox']
// 	= $GLOBALS['backboneit_jwplayer']['palette_mediabox'];
// $GLOBALS['TL_DCA']['tl_content']['subpalettes']['backboneit_jwplayer_player']
// 	= $GLOBALS['backboneit_jwplayer']['palette_player'];

// JWPlayerUtils::copyFields(
// 	$GLOBALS['TL_DCA']['tl_content']['fields'],
// 	$GLOBALS['backboneit_jwplayer']['fields_media'],
// 	$GLOBALS['backboneit_jwplayer']['fields_mediabox'],
// 	$GLOBALS['backboneit_jwplayer']['fields_player']
// );
// unset($GLOBALS['TL_DCA']['tl_content']['fields']['backboneit_jwplayer_addvideo']);
// unset($GLOBALS['TL_DCA']['tl_content']['fields']['backboneit_jwplayer_margin']);
// unset($GLOBALS['TL_DCA']['tl_content']['fields']['backboneit_jwplayer_floating']);
// unset($GLOBALS['TL_DCA']['tl_content']['fields']['backboneit_jwplayer_swf']);

// $GLOBALS['TL_DCA']['tl_layout']['fields']['backboneit_video_jwplayer'] = array(
// 	'label'			=> &$GLOBALS['TL_LANG']['backboneit_video']['jwplayer'],
// 	'exclude'		=> true,
// 	'inputType'		=> 'select',
// 	'options_callback' => array('JWPlayerDCA', 'getJWPlayers'),
// 	'eval'			=> array(
// 		'submitOnChange'	=> true,
// 		'includeBlankOption' => true,
// 		'blankOptionLabel'	=> &$GLOBALS['TL_LANG']['MSC']['blankOption'],
// 		'tl_class'			=> 'clr'
// 	),
// 	'wizard'		=> array(
// 		array('JWPlayerDCA', 'getEditJWPlayerWizard')
// 	)
// );
