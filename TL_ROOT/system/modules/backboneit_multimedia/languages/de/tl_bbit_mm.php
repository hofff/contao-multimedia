<?php

$GLOBALS['TL_LANG']['tl_bbit_mm']['new']	= array('Neues Medium', 'Ein neues Medium konfigurieren');
$GLOBALS['TL_LANG']['tl_bbit_mm']['captions'] = array('Untertitel', 'Die Untertitel des Videos ID %s bearbeiten.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['edit']	= array('Bearbeiten', 'Medium ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_bbit_mm']['copy']	= array('Kopieren', 'Medium ID %s kopieren');
$GLOBALS['TL_LANG']['tl_bbit_mm']['delete']	= array('Löschen', 'Medium ID %s löschen');
$GLOBALS['TL_LANG']['tl_bbit_mm']['show']	= array('Anzeigen', 'Medium ID %s anzeigen');


$GLOBALS['TL_LANG']['tl_bbit_mm']['tstamp']
	= array('Änderungsdatum');

$GLOBALS['TL_LANG']['tl_bbit_mm']['general_legend']
	= 'Allgemein';
$GLOBALS['TL_LANG']['tl_bbit_mm']['type']
	= array('Medien-Typ', 'Der Typ dieses Mediums.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['title']
	= array('Titel', 'Der Titel des Mediums.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['description']
	= array('Beschreibung', 'Eine Beschreibung des Mediums.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['image']
	= array('Vorschaubild', 'Das Vorschaubild wird angezeigt solange die Medien-Datei noch nicht abgespielt bzw. angezeigt wird oder wenn es sich um ein Audio-Medium handelt.');


$GLOBALS['TL_LANG']['tl_bbit_mm']['video_legend']
	= 'Video';

$strVideoCompat = '<a href="http://en.wikipedia.org/wiki/HTML5_video#Browser_support">Informationen zur Browser-Kompatibilität auf Wikipedia</a>';
$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesLocal']
	= array('Lokale Quellen', '<strong>' . $strVideoCompat . '</strong> - WebM/VP8: .webm - H.264: .mp4, .m4v - Ogg Theora: .ogg, .ogv  - Flash: .flv - Sie können mehrere Quellen in verschiedenen Formaten auswählen um die Browser-Kompatibilität zu erhöhen. Dieses Feature muss vom jeweiligen Player unterstützt werden.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesExternal']
	= array('Externe Quellen', '<strong>' . $strVideoCompat . '</strong> - Die URLs (inkl. "http://") zu den externen Quellen. Sie können mehrere Quellen in verschiedenen Formaten angeben um die Browser-Kompatibilität zu erhöhen. Dieses Feature muss vom jeweiligen Player unterstützt werden.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['video_sourcesExternalURL']
	= array('URL');

$GLOBALS['TL_LANG']['tl_bbit_mm']['youtube_source']
	= array('YouTube-Link/ID', 'Ein Link zu einem Video auf YouTube oder die YouTube-ID eines Videos.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['ratio']
	= array('Seitenverhältnis', 'Das Verhältnis von Breite zu Höhe.');
$GLOBALS['TL_LANG']['tl_bbit_mm']['ratioOptions'] = array(
	'4_3'		=> '4:3',
	'16_9'		=> '16:9',
	'custom'	=> 'Anderes Seitenverhältnis'
);
$GLOBALS['TL_LANG']['tl_bbit_mm']['ratioCustom']
	= array('Anderes Seitenverhältnis', 'Das Verhältnis von Breite zu Höhe.');

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

$GLOBALS['TL_LANG']['tl_bbit_mm']['errNoSource']
	= 'Es muss mindestens eine Quelle angegeben werden.';
$GLOBALS['TL_LANG']['tl_bbit_mm']['warnInvalidSources']
	= 'Folgende Quellen wurden nicht gefunden oder werden mit einem inkompatiblen MIME-Typen ausgeliefert:<br/>%s';
