<?php

$ns = 'tl_backboneit_video_jwplayer';

$GLOBALS['TL_DCA'][$ns] = array(

	'config' => array(
		'dataContainer'		=> 'TableExtended',
		'ctable'			=> array('tl_backboneit_video_jwplayer_plugins'),
		'enableVersioning'	=> true,
		'onload_callback'	=> array(
		),
		'onsubmit_callback'	=> array(
		),
	),
	
	'list' => array(
		'sorting' => array(
			'mode'			=> 2,
			'fields'		=> array('title'),
			'panelLayout'	=> 'filter,limit;search,sort',
			'disableGrouping' => true,
		),
		'label' => array(
			'fields'		=> array('title'),
			'format'		=> '%s',
//			'label_callback' => array('JWPlayerDCA', 'renderLabel'),
		),
		'global_operations' => array(
			'all' => array(
				'label'	=> &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'	=> 'act=select',
				'class'	=> 'header_edit_all',
				'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array(
			'edit' => array(
				'label'	=> &$GLOBALS['TL_LANG'][$ns]['edit'],
				'href'	=> 'act=edit',
				'icon'	=> 'edit.gif'
			),
			'plugins' => array(
				'label'	=> &$GLOBALS['TL_LANG'][$ns]['plugins'],
				'href'	=> 'table=tl_backboneit_video_jwplayer_plugins',
				'icon'	=> 'system/modules/backboneit_video/images/plugins.gif'
			),
			'copy' => array(
				'label'	=> &$GLOBALS['TL_LANG'][$ns]['copy'],
				'href'	=> 'act=paste&amp;mode=copy',
				'icon'	=> 'copy.gif'
			),
			'delete' => array(
				'label'	=> &$GLOBALS['TL_LANG'][$ns]['delete'],
				'href'	=> 'act=delete',
				'icon'	=> 'delete.gif',
				'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array(
				'label'	=> &$GLOBALS['TL_LANG'][$ns]['show'],
				'href'	=> 'act=show',
				'icon'	=> 'show.gif'
			)
		),
	),
	
	'palettes' => array(
		'default'		=> '{general_legend},title,fallback;'
			. '{player_legend},jwplayer,stretching,smoothing,html5;'
			. '{behavior_legend},volume,mute,repeatplay,autoplay;'
			. '{appearence_legend},image,size,skin;'
			. '{logo_legend},logo'
	),
	
	'subpalettes' => array(
		'skin'	=> array(
			''		=> 'dock,icons,controlbar,backcolor,frontcolor,lightcolor,screencolor',
			'css'	=> 'css,icons',
			'xml'	=> 'dock,icons,skinxml,cbpos',
			'swf'	=> 'dock,icons,skinswf,cbpos,backcolor,frontcolor,lightcolor,screencolor'
		),
		'controlbar'=> array(
			'over'	=> 'controlbarIdlehide'
		),
		'logo'		=> 'logoLink,logoFile,logoMargin,logoPosition,logoOver,logoOut,logoHide',
		'logoLink'	=> 'logoLinkURL,logoLinkTarget',
		'logoHide'	=> 'logoTimeout'
	),
	
	'fields' => array(
	
		'title' => array(
			'label'		=> &$GLOBALS['TL_LANG'][$ns]['title'],
			'exclude'	=> true,
			'inputType'	=> 'text',
			'eval'		=> array(
				'mandatory'			=> true,
				'tl_class'			=> 'clr w50'
			)
		),
		'fallback' => array(
			'label'		=> &$GLOBALS['TL_LANG'][$ns]['fallback'],
			'exclude'	=> true,
			'inputType'	=> 'checkbox',
			'eval'		=> array(
				'fallback'			=> true,
				'tl_class'			=> 'w50 cbx m12'
			)
		),
		
		
		'jwplayer' => array(
			'label'		=> &$GLOBALS['TL_LANG'][$ns]['jwplayer'],
			'exclude'	=> true,
			'inputType'	=> 'fileTree',
			'save_callback'	=> array(
				array('JWPlayerDCA', 'unpackPlayer')
			),
			'eval'		=> array(
				'mandatory'			=> true,
				'fieldType'			=> 'radio',
				'files'				=> true,
				'extensions'		=> 'swf,zip',
				'tl_class'			=> 'clr'
			)
		),
		'stretching' => array (
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['stretching'],
			'default'		=> 'uniform',
			'exclude'		=> true,
			'inputType'		=> 'select',
			'options'		=> array('none', 'exactfit', 'uniform', 'fill'),
			'reference'		=> &$GLOBALS['TL_LANG'][$ns]['stretchingOptions'],
			'eval'			=> array(
				'mandatory'			=> true,
				'tl_class'			=> 'clr w50'
			)
		),
		'smoothing' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['smoothing'],
			'default'		=> 1,
			'exclude'		=> true,
			'inputType'		=> 'checkbox',
			'eval'			=> array(
				'tl_class'			=> 'w50 cbx m12'
			)
		),
		'html5' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['html5'],
			'exclude'		=> true,
			'inputType'		=> 'checkbox',
			'eval'			=> array(
				'tl_class'			=> 'clr w50 cbx'
			)
		),
		
		
		'volume' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['volume'],
			'default'		=> 90,
			'exclude'		=> true,
			'inputType'		=> 'text',
			'eval'			=> array(
				'rgxp'				=> 'prcnt',
				'tl_class'			=> 'clr w50'
			)
		),
		'mute' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['mute'],
			'exclude'		=> true,
			'inputType'		=> 'checkbox',
			'eval'			=> array(
				'tl_class'			=> 'w50 cbx m12'
			)
		),
		'repeatplay' => array (
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['repeatplay'],
			'default'		=> 'none',
			'exclude'		=> true,
			'inputType'		=> 'select',
			'options'		=> array('none', 'list', 'always', 'single'),
			'reference'		=> &$GLOBALS['TL_LANG'][$ns]['repeatplayOptions'],
			'eval'			=> array(
				'mandatory'			=> true,
				'tl_class'			=> 'clr w50'
			)
		),
		'autoplay' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['autoplay'],
			'exclude'		=> true,
			'inputType'		=> 'checkbox',
			'eval'			=> array(
				'tl_class'			=> 'w50 cbx m12'
			)
		),
		
		
		'image' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['image'],
			'exclude'		=> true,
			'inputType'		=> 'fileTree',
			'eval'			=> array(
				'fieldType'			=> 'radio',
				'files'				=> true,
				'filesOnly'			=> true,
				'extensions'		=> 'jpeg,jpg,gif,png',
				'tl_class'			=> 'clr'
			)
		),
		'size' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['size'],
			'exclude'		=> true,
			'inputType'		=> 'text',
			'save_callback'	=> array(
				array('JWPlayerDCA', 'validateSize')
			),
			'eval'			=> array(
				'mandatory'			=> true,
				'multiple'			=> true,
				'size'				=> 2,
				'rgxp'				=> 'digit',
				'tl_class'			=> 'clr w50'
			)
		),
		'skin' => array (
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['skin'],
			'exclude'		=> true,
			'inputType'		=> 'select',
			'options'		=> array('css', 'xml', 'swf'),
			'reference'		=> &$GLOBALS['TL_LANG'][$ns]['skinOptions'],
			'eval'			=> array(
				'submitOnChange'	=> true,
				'includeBlankOption' => true,
				'blankOptionLabel'	=> &$GLOBALS['TL_LANG'][$ns]['skinOptions']['default'],
				'tl_class'			=> 'w50'
			)
		),
		'css' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['css'],
			'exclude'		=> true,
			'inputType'		=> 'text',
			'eval'			=> array(
				'rgxp'				=> 'alnum',
				'tl_class'			=> 'clr w50'
			)
		),
		'skinswf' => array(
			'label'		=> &$GLOBALS['TL_LANG'][$ns]['skinswf'],
			'exclude'	=> true,
			'inputType'	=> 'fileTree',
			'eval'		=> array(
				'mandatory'			=> true,
				'fieldType'			=> 'radio',
				'files'				=> true,
				'filesOnly'			=> true,
				'extensions'		=> 'swf',
				'tl_class'			=> 'clr'
			)
		),
		'skinxml' => array(
			'label'		=> &$GLOBALS['TL_LANG'][$ns]['skinxml'],
			'exclude'	=> true,
			'inputType'	=> 'fileTree',
			'eval'		=> array(
				'mandatory'			=> true,
				'fieldType'			=> 'radio',
				'files'				=> true,
				'filesOnly'			=> true,
				'extensions'		=> 'swf',
				'tl_class'			=> 'clr'
			)
		),
		'dock' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['dock'],
			'default'		=> 1,
			'exclude'		=> true,
			'inputType'		=> 'checkbox',
			'eval'			=> array(
				'tl_class'			=> 'clr w50 cbx'
			)
		),
		'icons' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['icons'],
			'default'		=> 1,
			'exclude'		=> true,
			'inputType'		=> 'checkbox',
			'eval'			=> array(
				'tl_class'			=> 'w50 cbx'
			)
		),
		'controlbar' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['controlbar'],
			'default'		=> 'over',
			'exclude'		=> true,
			'inputType'		=> 'select',
			'options'		=> array('bottom', 'top', 'over', 'none'),
			'reference'		=> &$GLOBALS['TL_LANG'][$ns]['controlbarOptions'],
			'eval'			=> array(
				'submitOnChange'	=> true,
				'tl_class'			=> 'clr w50'
			)
		),
		'controlbarIdlehide' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['controlbarIdlehide'],
			'exclude'		=> true,
			'inputType'		=> 'checkbox',
			'eval'			=> array(
				'tl_class'			=> 'w50 cbx m12'
			)
		),
		'backcolor' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['backcolor'],
			'exclude'		=> true,
			'inputType'		=> 'text',
			'save_callback'	=> array(
				array('JWPlayerDCA', 'validateColor')
			),
			'eval'			=> array(
				'maxlength'			=> 6,
				'rgxp'				=> 'alnum',
				'tl_class'			=> 'clr w50'
			)
		),
		'frontcolor' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['frontcolor'],
			'exclude'		=> true,
			'inputType'		=> 'text',
			'save_callback'	=> array(
				array('JWPlayerDCA', 'validateColor')
			),
			'eval'			=> array(
				'maxlength'			=> 6,
				'rgxp'				=> 'alnum',
				'tl_class'			=> 'w50'
			)
		),
		'lightcolor' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['lightcolor'],
			'exclude'		=> true,
			'inputType'		=> 'text',
			'save_callback'	=> array(
				array('JWPlayerDCA', 'validateColor')
			),
			'eval'			=> array(
				'maxlength'			=> 6,
				'rgxp'				=> 'alnum',
				'tl_class'			=> 'clr w50'
			)
		),
		'screencolor' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['screencolor'],
			'exclude'		=> true,
			'inputType'		=> 'text',
			'save_callback'	=> array(
				array('JWPlayerDCA', 'validateColor')
			),
			'eval'			=> array(
				'maxlength'			=> 6,
				'rgxp'				=> 'alnum',
				'tl_class'			=> 'w50'
			)
		),
		
		
		'logo' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['logo'],
			'exclude'		=> true,
			'inputType'		=> 'checkbox',
			'eval'			=> array(
				'submitOnChange'	=> true,
				'tl_class'			=> 'clr w50 cbx'
			)
		),
		'logoLink' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['logoLink'],
			'exclude'		=> true,
			'inputType'		=> 'checkbox',
			'eval'			=> array(
				'submitOnChange'	=> true,
				'tl_class'			=> 'w50 cbx'
			)
		),
		'logoLinkURL' => array(
			'label'			=> &$GLOBALS['TL_LANG']['MSC']['url'],
			'exclude'		=> true,
			'search'		=> true,
			'inputType'		=> 'text',
			'eval'			=> array(
				'mandatory'			=> true,
				'rgxp'				=> 'url',
				'decodeEntities'	=> true,
				'maxlength'			=> 255,
				'tl_class'			=> 'clr w50 wizard'
			),
			'wizard'		=> array(
				array('JWPlayerDCA', 'pagePicker')
			)
		),
		'logoLinkTarget' => array(
			'label'			=> &$GLOBALS['TL_LANG']['MSC']['target'],
			'default'		=> 1,
			'exclude'		=> true,
			'inputType'		=> 'checkbox',
			'eval'			=> array(
				'tl_class'			=> 'w50 cbx m12'
			)
		),
		'logoFile' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['logoFile'],
			'exclude'		=> true,
			'inputType'		=> 'fileTree',
			'eval'			=> array(
				'fieldType'			=> 'radio',
				'files'				=> true,
				'filesOnly'			=> true,
				'extensions'		=> 'jpeg,jpg,gif,png',
				'tl_class'			=> 'clr'
			)
		),
		'logoMargin' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['logoMargin'],
			'default'		=> 8,
			'exclude'		=> true,
			'inputType'		=> 'text',
			'eval'			=> array(
				'rgxp'				=> 'digit',
				'tl_class'			=> 'clr w50'
			)
		),
		'logoPosition' => array (
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['logoPosition'],
			'default'		=> 'bottom-left',
			'exclude'		=> true,
			'inputType'		=> 'select',
			'options'		=> array('top-left', 'top-right', 'bottom-left', 'bottom-right'),
			'reference'		=> &$GLOBALS['TL_LANG'][$ns]['logoPositionOptions'],
			'eval'			=> array(
				'tl_class'			=> 'w50'
			)
		),
		'logoOver' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['logoOver'],
			'default'		=> 100,
			'exclude'		=> true,
			'inputType'		=> 'text',
			'eval'			=> array(
				'rgxp'				=> 'prcnt',
				'tl_class'			=> 'clr w50'
			)
		),
		'logoOut' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['logoOut'],
			'default'		=> 50,
			'exclude'		=> true,
			'inputType'		=> 'text',
			'eval'			=> array(
				'rgxp'				=> 'prcnt',
				'tl_class'			=> 'w50'
			)
		),
		'logoHide' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['logoHide'],
			'default'		=> 1,
			'exclude'		=> true,
			'inputType'		=> 'checkbox',
			'eval'			=> array(
				'submitOnChange'	=> true,
				'tl_class'			=> 'clr w50 cbx m12'
			)
		),
		'logoTimeout' => array(
			'label'			=> &$GLOBALS['TL_LANG'][$ns]['logoTimeout'],
			'default'		=> 3,
			'exclude'		=> true,
			'inputType'		=> 'text',
			'eval'			=> array(
				'rgxp'				=> 'digit',
				'tl_class'			=> 'w50'
			)
		),
	)
);
	