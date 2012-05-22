<?php

$this->loadLanguageFile('bbit_mm');

$GLOBALS['TL_DCA']['tl_bbit_mm'] = array(

	'config' => array(
		'dataContainer'		=> 'TableExtended',
		'ctable'			=> array('tl_bbit_mm_captions'),
		'enableVersioning'	=> true,
		'onload_callback'	=> array(
		),
		'onsubmit_callback'	=> array(
			array('MultimediaDCA', 'submitYoutube'),
			array('MultimediaDCA', 'submitVideo'),
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
				'icon'	=> 'article.gif',
				'button_callback' => array('MultimediaDCA', 'renderCaptionsButton'),
			),
			'edit' => array(
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['edit'],
				'href'	=> 'act=edit',
				'icon'	=> 'edit.gif'
			),
			'copy' => array(
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['copy'],
				'href'	=> 'act=copy',
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
		
		'default'	=> '{general_legend},type,title,description,image'
			,
		
		'youtube' => '{general_legend},type,title,description,image'
			. ';{video_legend},youtube_source,ratio'
			. ';{captions_legend},captions_source'
			. ';{audiodesc_legend},audiodesc_source'
			,
		
		'video' => '{general_legend},type,title,description,image'
			. ';{video_legend},video_sourcesLocal,video_sourcesExternal'
			. ',video_sourcesExternalStream,video_sourcesRTMP'
			. ',ratio'
			. ';{captions_legend},captions_source'
			. ';{audiodesc_legend},audiodesc_source'
			,
		
	),
	
	'subpalettes' => array(
		'ratio' => array(
			'custom'	=> 'ratioCustom',
		),
		'captions_source' => array(
			'video'		=> 'captions_labels',
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
			'options'		=> array_keys($GLOBALS['BBIT_MM_TYPES']),
			'reference'		=> &$GLOBALS['TL_LANG']['bbit_mm']['types'],
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
		
		
		'ratio' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['ratio'],
			'search'		=> true,
			'inputType'		=> 'select',
			'options'		=> array('4_3', '16_9', 'custom'),
			'reference'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['ratioOptions'],
			'eval'			=> array(
				'includeBlankOption'=> true,
				'submitOnChange'	=> true,
				'tl_class'			=> 'clr w50'
			)
		),
		'ratioCustom' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['ratioCustom'],
			'search'		=> true,
			'inputType'		=> 'text',
			'eval'			=> array(
				'mandatory'			=> true,
				'multiple'			=> true,
				'size'				=> 2,
				'rgxp'				=> 'digit',
				'maxlength'			=> 50,
				'tl_class'			=> 'w50'
			)
		),
		
		
		'youtube_source' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['youtube_source'],
			'inputType'		=> 'text',
			'eval'			=> array(
				'mandatory'			=> true,
				'maxlength'			=> 1023,
				'rgxp'				=> 'url',
				'tl_class'			=> 'clr long',
				'decodeEntities'	=> true
			)
		),
		
		
		'video_sourcesLocal' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesLocal'],
			'inputType'		=> 'fileTree',
			'eval'			=> array(
				'multiple'			=> true,
				'fieldType'			=> 'checkbox',
				'files'				=> true,
				'filesOnly'			=> true,
				'extensions'		=> implode(',', MultimediaVideoHTTP::getFileExtensions()),
				'decodeEntities'	=> true,
				'tl_class'			=> 'clr'
			),
			'load_callback' => array(
				array('MultimediaDCA', 'loadVideoSourcesLocal'),
			),
			'save_callback' => array(
				array('MultimediaDCA', 'saveVideoSourcesLocal'),
			),
		),
		
		
		'video_sourcesExternal' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesExternal'],
			'inputType'		=> 'multiColumnWizard',
			'eval'			=> array(
				'buttons' => array('up' => false, 'down' => false),
				'columnFields' => array(
					'url' => array(
						'label'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesURL'],
						'inputType'	=> 'text',
						'eval'		=> array(
							'style'			=> 'width: 600px;',
							'decodeEntities'=> true
						)
					),
				),
				'tl_class'			=> 'clr'
			),
			'load_callback' => array(
				array('MultimediaDCA', 'loadVideoSourcesExternal'),
			),
			'save_callback' => array(
				array('MultimediaDCA', 'saveVideoSourcesExternal'),
			),
		),
		
		
		'video_sourcesExternalStream' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesExternalStream'],
			'inputType'		=> 'multiColumnWizard',
			'eval'			=> array(
				'buttons' => array('up' => false, 'down' => false),
				'columnFields' => array(
					'url' => array(
						'label'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesURL'],
						'inputType'	=> 'text',
						'eval'		=> array(
							'style'			=> 'width: 424px;',
							'decodeEntities'=> true
						)
					),
					'startparam' => array(
						'label'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesStartparam'],
						'inputType'	=> 'text',
						'default'	=> 'start',
						'eval'		=> array(
							'mandatory'		=> true,
							'style'			=> 'width: 60px;',
							'decodeEntities'=> true
						)
					),
					'bitrate' => array(
						'label'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesBitrate'],
						'inputType'	=> 'text',
						'eval'		=> array(
							'style'			=> 'width: 40px;',
							'decodeEntities'=> true
						)
					),
					'width' => array(
						'label'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesWidth'],
						'inputType'	=> 'text',
						'eval'		=> array(
							'style'			=> 'width: 40px;',
							'decodeEntities'=> true
						)
					),
				),
				'tl_class'			=> 'clr'
			),
			'load_callback' => array(
				array('MultimediaDCA', 'loadVideoSourcesExternal'),
			),
			'save_callback' => array(
				array('MultimediaDCA', 'saveVideoSourcesExternal'),
			),
		),
		
		
		'video_sourcesRTMP' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesRTMP'],
			'inputType'		=> 'multiColumnWizard',
			'eval'			=> array(
				'buttons' => array('up' => false, 'down' => false),
				'columnFields' => array(
					'url' => array(
						'label'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesURL'],
						'inputType'	=> 'text',
						'eval'		=> array(
							'style'			=> 'width: 424px;',
							'decodeEntities'=> true
						)
					),
					'bitrate' => array(
						'label'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesBitrate'],
						'inputType'	=> 'text',
						'eval'		=> array(
							'style'			=> 'width: 40px;',
							'decodeEntities'=> true
						)
					),
					'width' => array(
						'label'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesWidth'],
						'inputType'	=> 'text',
						'eval'		=> array(
							'style'			=> 'width: 40px;',
							'decodeEntities'=> true
						)
					),
					'subscribe' => array(
						'label'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesSubscribe'],
						'inputType'	=> 'checkbox',
						'eval'		=> array(
							'style'			=> 'width: 27px;',
						)
					),
					'dvr' => array(
						'label'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesDVR'],
						'inputType'	=> 'checkbox',
						'eval'		=> array(
							'style'			=> 'width: 27px;',
						)
					),
				),
				'tl_class'			=> 'clr'
			),
			'load_callback' => array(
				array('MultimediaDCA', 'loadVideoSourcesExternal'),
			),
			'save_callback' => array(
				array('MultimediaDCA', 'saveVideoSourcesExternal'),
			),
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
	)
);
	