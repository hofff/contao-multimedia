<?php

$GLOBALS['TL_DCA']['tl_bbit_mm_captions'] = array(

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
			'fields'		=> array('sorting'),
			'panelLayout'	=> 'filter,search,limit',
			'headerFields'	=> array('type', 'title', 'tstamp'),
			'child_record_callback'   => array('MultimediaDCA', 'getCaptionsRecord')
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
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['edit'],
				'href'	=> 'act=edit',
				'icon'	=> 'edit.gif'
			),
			'copy' => array(
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['copy'],
				'href'	=> 'act=paste&amp;mode=copy',
				'icon'	=> 'copy.gif'
			),
			'delete' => array(
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['delete'],
				'href'	=> 'act=delete',
				'icon'	=> 'delete.gif',
				'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array(
				'label'	=> &$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['show'],
				'href'	=> 'act=show',
				'icon'	=> 'show.gif'
			)
		),
	),

	'palettes' => array(
		'default'	=> '{general_legend},title;'
			. '{source_legend},source;'
	),

	'subpalettes' => array(
		'source_local'		=> 'format,local',
		'source_external'	=> 'format,external',
	),

	'fields' => array(

		'title' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['title'],
			'exclude'		=> false,
			'search'		=> true,
			'inputType'		=> 'text',
			'eval'			=> array(
				'maxlength'			=> 255,
				'tl_class'			=> 'clr long'
			)
		),

		'source' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['source'],
			'exclude'		=> false,
			'default'		=> 'local',//'managed',
			'filter'		=> true,
			'inputType'		=> 'select',
			'options'		=> array(/*'managed', */'local', 'external'),
			'reference'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['sourceOptions'],
			'eval'			=> array(
				'mandatory'			=> true,
				'submitOnChange'	=> true,
				'tl_class'			=> 'clr w50'
			)
		),
		'format' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['format'],
			'exclude'		=> false,
			'default'		=> 'auto',
			'filter'		=> true,
			'inputType'		=> 'select',
			'options'		=> array('auto', 'srt', 'ttml'),
			'reference'		=> &$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['formatOptions'],
			'eval'			=> array(
				'mandatory'			=> true,
				'tl_class'			=> 'w50'
			)
		),
		'local' => array (
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['local'],
			'exclude'		=> false,
			'inputType'		=> 'fileTree',
			'eval'			=> array(
				'mandatory'			=> true,
				'fieldType'			=> 'radio',
				'files'				=> true,
				'filesOnly'			=> true,
				'extensions'		=> 'srt,ttml,xml',//srt -> application/x-subrip, application/ttml+xml
				'tl_class'			=> 'clr'
			)
		),
		'external' => array(
			'label'			=> &$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['external'],
			'exclude'		=> false,
			'inputType'		=> 'text',
			'eval'			=> array(
				'mandatory'			=> true,
				'maxlength'			=> 1023,
				'rgxp'				=> 'url',
				'tl_class'			=> 'clr long',
				'decodeEntities'	=> true
			)
		)

	)
);
