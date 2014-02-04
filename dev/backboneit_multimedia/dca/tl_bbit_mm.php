<?php

$GLOBALS['TL_DCA']['tl_bbit_mm'] = array(

	'config' => array(
		'dataContainer'		=> 'TableExtended',
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
//			'label_callback' => array('MultimediaDCA', 'renderLabel'),
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
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['edit'],
				'href'	=> 'act=edit',
				'icon'	=> 'edit.gif'
			),
			'copy' => array(
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['copy'],
				'href'	=> 'act=paste&amp;mode=copy',
				'icon'	=> 'copy.gif'
			),
			'delete' => array(
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['delete'],
				'href'	=> 'act=delete',
				'icon'	=> 'delete.gif',
				'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array(
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['show'],
				'href'	=> 'act=show',
				'icon'	=> 'show.gif'
			)
		),
	),

	'palettes' => array(
		'default'		=> '{general_legend},type,title,description,image;',
		'video'		=> '{general_legend},type,title,description,image;'
			. '{source_legend},source;'
			. '{expert_legend},startparam',
		'audio'		=> '{general_legend},type,title,description,image;'
			. '{source_legend},source;',
	),

	'subpalettes' => array(
		'source'	=> array(
			'local'		=> 'local',
			'external'	=> 'url'
		)
	),

	'fields' => array(

		'type' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['type'],
			'exclude'		=> false,
			'default'		=> 'video',
			'filter'		=> true,
			'inputType'		=> 'select',
			'options'		=> array('video', 'audio'),
			'reference'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['typeOptions'],
			'eval'			=> array(
				'mandatory'			=> true,
				'submitOnChange'	=> true,
				'tl_class'			=> 'clr'
			)
		),
		'title' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['title'],
			'search'		=> true,
			'inputType'		=> 'text',
			'eval'			=> array(
				'maxlength'			=> 255,
				'tl_class'			=> 'clr long'
			)
		),
		'description' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['description'],
			'search'		=> true,
			'inputType'		=> 'textarea',
			'eval'			=> array(
				'cols'				=> 40,
				'rows'				=> 4,
				'tl_class'			=> 'clr',
				'style'				=> 'height: 65px; width: 657px'
			)
		),
		'image' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['image'],
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

		'source' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['source'],
			'exclude'		=> false,
			'default'		=> 'local',
			'filter'		=> true,
			'inputType'		=> 'select',
			'options'		=> array('local', 'external'),
			'reference'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['sourceOptions'],
			'eval'			=> array(
				'mandatory'			=> true,
				'submitOnChange'	=> true,
				'tl_class'			=> 'clr w50'
			)
		),
		'local' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['local'],
			'exclude'		=> false,
			'inputType'		=> 'fileTree',
			'eval'			=> array(
				'fieldType'			=> 'radio',
				'files'				=> true,
				'filesOnly'			=> true,
				'extensions'		=> 'flv,mp4,m4v,ogv,mp3,aac,jpg,jpeg,gif,png',
				'tl_class'			=> 'clr'
			)
		),
		'url' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['url'],
			'exclude'		=> false,
			'inputType'		=> 'text',
			'save_callback'	=> array(
// 				array('JWPlayerDCA', 'checkYouTube')
			),
			'eval'			=> array(
				'mandatory'			=> true,
				'maxlength'			=> 1023,
				'rgxp'				=> 'url',
				'tl_class'			=> 'clr long',
				'decodeEntities'	=> true
			)
		),

		'startparam' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['startparam'],
			'exclude'		=> true,
			'inputType'		=> 'text',
			'eval'			=> array(
				'maxlength'			=> '50',
				'rgxp'				=> 'alnum',
				'decodeEntities'	=> true,
				'tl_class'			=> 'clr w50'
			)
		)
	)
);
	