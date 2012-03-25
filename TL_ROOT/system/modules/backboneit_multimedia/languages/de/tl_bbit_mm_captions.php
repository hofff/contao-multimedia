<?php

$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['new']	= array('Neue Untertitel', 'Neue Untertitel erstellen');
$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['edit']	= array('Bearbeiten', 'Untertitel ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['copy']	= array('Kopieren', 'Untertitel ID %s kopieren');
$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['delete']= array('Löschen', 'Untertitel ID %s löschen');
$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['show']	= array('Anzeigen', 'Untertitel ID %s anzeigen');


$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['general_legend']
	= 'Allgemein';
$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['title']
	= array('Titel', 'Der Anzeigename des Untertitels.');


$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['source_legend']
	= 'Quelle';
$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['source']
	= array('Quelle', 'Gibt an von wo die Untertitel bezogen werden. CMS: Die Untertitel werden im CMS gepflegt. Lokal: Eine Datei im "Contao"-Dateisystem. Extern: Eine Datei im Internet. Video: Untertitel sind in der Video-Datei eingebettet.');
$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['sourceOptions'] = array(
	'managed'	=> 'CMS',
	'local'		=> 'Lokal',
	'external'	=> 'Extern',
	'embedded'	=> 'Video'
);
$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['format']
	= array('Format', 'Das Format in dem die Untertitel gespeichert sind. Bei automatisch wird versucht das Format aus dem MIME-Type oder der Dateiendung zu bestimmen.');
$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['formatOptions'] = array(
	'auto'		=> 'Automatisch',
	'srt'		=> 'SRT (SubRip)',
	'ttml'		=> 'DFXP (W3C TimedText)'
);
$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['local']
	= array('Lokale Datei', '');
$GLOBALS['TL_LANG']['tl_bbit_mm_captions']['external']
	= array('Externe Datei', '');
	