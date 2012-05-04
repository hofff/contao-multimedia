<?php

$this->loadLanguageFile('bbit_mm');

$GLOBALS['TL_DCA']['tl_bbit_mm_video'] = array(

	'config' => array(
		'dataContainer'		=> 'Table',
		'ptable'			=> 'tl_bbit_mm',
		'enableVersioning'	=> true,
		'onload_callback'	=> array(
		),
		'onsubmit_callback'	=> array(
		),
	),
	
	'list' => array(
		'sorting' => array(
			'mode'			=> 4,
			'flag'			=> 1,
			'fields'		=> array('id'),
			'panelLayout'	=> 'filter,limit;search,sort',
			'headerFields'	=> array('title', 'type'),
			'disableGrouping' => true,
			'child_record_callback'=> array('MultimediaDCA', 'renderSourcesRecord')
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
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['edit'],
				'href'	=> 'act=edit',
				'icon'	=> 'edit.gif'
			),
			'copy' => array(
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['copy'],
				'href'	=> 'act=paste&amp;mode=copy',
				'icon'	=> 'copy.gif'
			),
			'delete' => array(
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['delete'],
				'href'	=> 'act=delete',
				'icon'	=> 'delete.gif',
				'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array(
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['show'],
				'href'	=> 'act=show',
				'icon'	=> 'show.gif'
			)
		),
	),
	
	'palettes' => array(
		'__selector__' => array('type'),
		'default'	=> 'type',
		'local'		=> 'type,localSource',
		'external'	=> 'type,externalSource',
		'rtmp'		=> 'type,rtmpSource',
		'http'		=> 'type,httpSource,httpStartparam',
	),
	
	'subpalettes' => array(
	),
	
	'fields' => array(
		
		'type' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['type'],
			'filter'		=> true,
			'inputType'		=> 'select',
			'default'		=> 'local',
			'options'		=> array('local', 'external', 'youtube'),//array_keys($GLOBALS['BBIT_MM_TYPES']),
			'reference'		=> &$GLOBALS['TL_LANG']['bbit_mm']['types'],
			'eval'			=> array(
				'mandatory'			=> true,
				'submitOnChange'	=> true,
				'tl_class'			=> 'clr'
			)
		),
		
		'source' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['source'],
			'inputType'		=> 'text',
			'eval'			=> array(
				'mandatory'			=> true,
				'maxlength'			=> 1023,
				'rgxp'				=> 'url',
				'tl_class'			=> 'clr long',
				'decodeEntities'	=> true
			)
		),
		
		'localVideo_source' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['localVideo_source'],
			'inputType'		=> 'fileTree',
			'eval'			=> array(
				'fieldType'			=> 'radio',
				'files'				=> true,
				'filesOnly'			=> true,
				'extensions'		=> 'webm,ogv,ogg,mp4,m4v,flv',
				'mandatory'			=> true,
				'decodeEntities'	=> true,
				'tl_class'			=> 'clr'
			)
		),
		
		
		'externalVideo_source' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['externalVideo_source'],
			'inputType'		=> 'text',
			'eval'			=> array(
				'mandatory'			=> true,
				'maxlength'			=> 1023,
				'rgxp'				=> 'url',
				'tl_class'			=> 'clr long',
				'decodeEntities'	=> true
			)
		),
		
		
		'youtubeVideo_source' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['youtubeVideo_source'],
			'inputType'		=> 'text',
			'eval'			=> array(
				'mandatory'			=> true,
				'maxlength'			=> 1023,
				'rgxp'				=> 'url',
				'tl_class'			=> 'clr long',
				'decodeEntities'	=> true
			)
		),
		
		
		'rtmpVideo_source' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['rtmpVideo_source'],
			'inputType'		=> 'text',
			'eval'			=> array(
				'mandatory'			=> true,
				'maxlength'			=> 1023,
				'rgxp'				=> 'url',
				'tl_class'			=> 'clr long',
				'decodeEntities'	=> true
			)
		),
		
		
		'httpVideo_source' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['httpVideo_source'],
			'inputType'		=> 'text',
			'eval'			=> array(
				'mandatory'			=> true,
				'maxlength'			=> 1023,
				'rgxp'				=> 'url',
				'tl_class'			=> 'clr long',
				'decodeEntities'	=> true
			)
		),
		'http_startparam' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['http_startparam'],
			'exclude'		=> true,
			'inputType'		=> 'text',
			'eval'			=> array(
				'maxlength'			=> '50',
				'rgxp'				=> 'alnum',
				'decodeEntities'	=> true,
				'tl_class'			=> 'clr w50'
			)
		),
		
		
		'localAudio_source' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['localAudio_source'],
			'inputType'		=> 'fileTree',
			'eval'			=> array(
				'fieldType'			=> 'radio',
				'files'				=> true,
				'filesOnly'			=> true,
				'extensions'		=> 'webm,oga,ogg,mp3,mp4,m4a,m4b,m4p,m4r,aac',
				'mandatory'			=> true,
				'decodeEntities'	=> true,
				'tl_class'			=> 'clr'
			)
		),
		
		
		'externalAudio_source' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_video']['externalAudio_source'],
			'inputType'		=> 'text',
			'eval'			=> array(
				'mandatory'			=> true,
				'maxlength'			=> 1023,
				'rgxp'				=> 'url',
				'tl_class'			=> 'clr long',
				'decodeEntities'	=> true
			)
		),
	)
);
	