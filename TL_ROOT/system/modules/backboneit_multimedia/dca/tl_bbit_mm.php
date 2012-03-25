<?php

$GLOBALS['TL_DCA']['tl_bbit_mm'] = array(

	'config' => array(
		'dataContainer'		=> 'TableExtended',
		'ctable'			=> array('tl_bbit_mm_captions'),
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
			'captions' => array(
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['captions'],
				'href'	=> 'table=tl_bbit_mm_captions',
				'icon'	=> 'article.gif'
			),
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
		'__selector__' => array('type'),
		
		'default'	=> '{general_legend},type,title,description,image;',
		
		'video'		=> '{general_legend},type,title,description,image'
			. ';{source_legend},video_source'
			. ';{video_legend},size'
			. ';{captions_legend},captions_source'
			. ';{audiodesc_legend},audiodesc_source'
// 			. ';{expert_legend},startparam'
			,
		
		'audio'		=> '{general_legend},type,title,description,image'
			. ';{source_legend},audio_source'
			,
		
	),
	
	'subpalettes' => array(
		'video_source'	=> array(
			'local'		=> 'video_local',
			'external'	=> 'video_external'
		),
		'audio_source'	=> array(
			'local'		=> 'audio_local',
			'external'	=> 'audio_external'
		),
		'captions_source' => array(
			'video'		=> 'captions_labels'
		),
		'audiodesc_source' => array(
			'local'		=> 'audiodesc_local',
			'external'	=> 'audiodesc_external',
		)
	),
	
	'fields' => array(
	
		'type' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['type'],
			'filter'		=> true,
			'inputType'		=> 'select',
			'default'		=> 'video',
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
				'mandatory'			=> true,
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
		
		
		'video_source' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['source'],
			'default'		=> 'local',
			'inputType'		=> 'select',
			'options'		=> array('local', 'external'),
			'reference'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['sourceOptions'],
			'eval'			=> array(
				'mandatory'			=> true,
				'submitOnChange'	=> true,
				'tl_class'			=> 'clr w50'
			)
		),
		'video_local' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_local'],
			'inputType'		=> 'fileTree',
			'eval'			=> array(
				'fieldType'			=> 'radio',
				'files'				=> true,
				'filesOnly'			=> true,
				'extensions'		=> 'flv,mp4,m4v,ogv',
				'mandatory'			=> true,
				'decodeEntities'	=> true,
				'tl_class'			=> 'clr'
			)
		),
		'video_external' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_external'],
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
		
		
		'audio_source' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['source'],
			'default'		=> 'local',
			'inputType'		=> 'select',
			'options'		=> array('local', 'external'),
			'reference'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['sourceOptions'],
			'eval'			=> array(
				'mandatory'			=> true,
				'submitOnChange'	=> true,
				'tl_class'			=> 'clr w50'
			)
		),
		'audio_local' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['audio_local'],
			'inputType'		=> 'fileTree',
			'eval'			=> array(
				'fieldType'			=> 'radio',
				'files'				=> true,
				'filesOnly'			=> true,
				'extensions'		=> 'mp3,aac',
				'mandatory'			=> true,
				'decodeEntities'	=> true,
				'tl_class'			=> 'clr'
			)
		),
		'audio_external' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['audio_external'],
			'inputType'		=> 'text',
			'eval'			=> array(
				'mandatory'			=> true,
				'maxlength'			=> 1023,
				'rgxp'				=> 'url',
				'tl_class'			=> 'clr long',
				'decodeEntities'	=> true
			)
		),
		
		
		'captions_source' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['captions_source'],
			'inputType'		=> 'select',
			'options'		=> array('video', 'external'),
			'reference'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['captions_sourceOptions'],
			'eval'			=> array(
				'submitOnChange'	=> true,
				'includeBlankOption'=> true,
				'blankOptionLabel'	=> &$GLOBALS['TL_LANG']['MSC']['blankOption'],
				'tl_class'			=> 'clr w50'
			)
		),
		'captions_labels' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['captions_labels'],
			'inputType'		=> 'multiColumnWizard',
			'eval'			=> array(
				'columnFields' => array(
					'label' => array(
						'label'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['captions_label'],
						'inputType'	=> 'text',
						'eval'		=> array(
							'mandatory'		=> true,
							'style'			=> 'width: 300px;',
							'decodeEntities'=> true
						)
					)
				),
				'tl_class'			=> 'clr'
			)
		),
		
		
		'audiodesc_source' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['audiodesc_source'],
			'inputType'		=> 'select',
			'options'		=> array('local', 'external'),
			'reference'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['sourceOptions'],
			'eval'			=> array(
				'submitOnChange'	=> true,
				'includeBlankOption'=> true,
				'blankOptionLabel'	=> &$GLOBALS['TL_LANG']['MSC']['blankOption'],
				'tl_class'			=> 'clr w50'
			)
		),
		'audiodesc_volume' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['audiodesc_volume'],
			'exclude'		=> true,
			'inputType'		=> 'text',
			'default'		=> 90,
			'eval'			=> array(
				'mandatory'			=> true,
				'nospace'			=> true,
				'rgxp'				=> 'prcnt',
				'tl_class'			=> 'w50'
			),
		),
		'audiodesc_local' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['audiodesc_local'],
			'inputType'		=> 'fileTree',
			'eval'			=> array(
				'fieldType'			=> 'radio',
				'files'				=> true,
				'filesOnly'			=> true,
				'extensions'		=> 'mp3',
				'mandatory'			=> true,
				'decodeEntities'	=> true,
				'tl_class'			=> 'clr'
			)
		),
		'audiodesc_external' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['audiodesc_external'],
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
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['http_startparam'],
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
	