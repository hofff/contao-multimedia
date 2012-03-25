<?php

$GLOBALS['TL_LANG']['tl_bbit_mm']['new']	= array('Neues Medium', 'Ein neues Medium konfigurieren');
$GLOBALS['TL_LANG']['tl_bbit_mm']['captions'] = array('Untertitel', 'Die Untertitel des Videos ID %s bearbeiten.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['edit']	= array('Bearbeiten', 'Medium ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_bbit_mm']['copy']	= array('Kopieren', 'Medium ID %s kopieren');
$GLOBALS['TL_LANG']['tl_bbit_mm']['delete']	= array('Löschen', 'Medium ID %s löschen');
$GLOBALS['TL_LANG']['tl_bbit_mm']['show']	= array('Anzeigen', 'Medium ID %s anzeigen');


$GLOBALS['TL_LANG']['tl_bbit_mm']['general_legend']
	= 'Allgemein';
$GLOBALS['TL_LANG']['tl_bbit_mm']['type']
	= array('Medien-Typ', 'Der Medientyp.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['typeOptions'] = array(
	'video'		=> 'Video',
	'audio'		=> 'Audio'
);
$GLOBALS['TL_LANG']['tl_bbit_mm']['title']
	= array('Titel', 'Der Titel des Mediums.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['description']
	= array('Beschreibung', 'Eine Beschreibung des Mediums.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['image']
	= array('Vorschaubild', 'Das Vorschaubild wird angezeigt solange die Medien-Datei noch nicht abgespielt bzw. angezeigt wird oder wenn es sich um ein Audio-Medium handelt.');


$GLOBALS['TL_LANG']['tl_bbit_mm']['source_legend']
	= 'Quelle';
$GLOBALS['TL_LANG']['tl_bbit_mm']['source']
	= array('Quelle', '"Lokal" für ein Medium im TYPOlight-Dateisystem. "Extern" für eine externe Medien-Datei, einen externen Medien-Stream oder "YouTube-Video".');
$GLOBALS['TL_LANG']['tl_bbit_mm']['sourceOptions'] = array(
	'local'		=> 'Lokal',
	'external'	=> 'Extern'
);


$GLOBALS['TL_LANG']['tl_bbit_mm']['video_local']
	= array('Video-Datei auswählen', 'Video\'s: .swf, .flv, .mp4, .m4v, .ogv (nicht von allen Browsern unterstützt)');
$GLOBALS['TL_LANG']['tl_bbit_mm']['video_external']
	= array('Video-URL', 'Eine URL (inkl. "http://") zum externen Video-Datei.');


$GLOBALS['TL_LANG']['tl_bbit_mm']['audio_local']
	= array('Audio-Datei auswählen', 'Audio: .mp3, .aac (nur Flash)');
$GLOBALS['TL_LANG']['tl_bbit_mm']['audio_external']
	= array('Audio-URL', 'Eine URL (inkl. "http://") zur externen Audio-Datei.');


$GLOBALS['TL_LANG']['tl_bbit_mm']['captions_legend']
	= 'Untertitel';
$GLOBALS['TL_LANG']['tl_bbit_mm']['captions_source']
	= array('Quelle', 'Von wo die Untertitel bezogen werden.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['captions_sourceOptions'] = array(
	'video' => 'Im Video eingebettet',
	'external' => 'In separater Datei'
);
$GLOBALS['TL_LANG']['tl_bbit_mm']['captions_labels']
	= array('Namen der Untertitel', 'Die Beschriftung der Titel der Untertitel.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['captions_label']
	= array('Name');


$GLOBALS['TL_LANG']['tl_bbit_mm']['audiodesc_legend']
	= 'Audio-Beschreibung';
$GLOBALS['TL_LANG']['tl_bbit_mm']['audiodesc_source']
	= array('Quelle', 'Von wo die Audio-Beschreibung bezogen werden. "Lokal" für eine Datei im TYPOlight-Dateisystem. "Extern" für eine externe Datei.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['audiodesc_volume']
	= array('Lautstärke (in %)', 'Die Lautstärke im Verhältnis zum Medium. Niedrige Werte regeln die Lautstärke der Audio-Beschreibung leiser.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['audiodesc_local']
	= array('Datei der Audio-Beschreibung', 'Audio: .mp3 (Empfohlen 44,1kHz mit konstanter Bitrate.)');
$GLOBALS['TL_LANG']['tl_bbit_mm']['audiodesc_external']
	= array('URL der Audio-Beschreibung', 'Eine URL (inkl. "http://") zur externen Datei. Empfohlen 44,1kHz mit konstanter Bitrate.');


$GLOBALS['TL_LANG']['tl_bbit_mm']['expert_legend']
	= 'Experten-Einstellungen';
$GLOBALS['TL_LANG']['tl_bbit_mm']['http_startparam']
	= array('Suchparameter des Streamers', 'Der Name des Suchparameter des Streamers, mit dessen Hilfe die gewünschte Abspielposition dem Streamer übergeben wird. (Standardwert "start")');
