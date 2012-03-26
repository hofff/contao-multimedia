<?php


$GLOBALS['TL_LANG']['bbit_mm']['types']['localVideo'] = 'Lokales Video';
$GLOBALS['TL_LANG']['bbit_mm']['types']['externalVideo'] = 'Externes Video';
$GLOBALS['TL_LANG']['bbit_mm']['types']['youtubeVideo'] = 'YouTube-Video';
$GLOBALS['TL_LANG']['bbit_mm']['types']['rtmpVideo'] = 'Video via RTMP-Stream (Flash)';
$GLOBALS['TL_LANG']['bbit_mm']['types']['httpVideo'] = 'Video via HTTP-Pseudo-Stream (Flash)';
$GLOBALS['TL_LANG']['bbit_mm']['types']['localAudio'] = 'Lokale Audio-Datei';
$GLOBALS['TL_LANG']['bbit_mm']['types']['externalAudio'] = 'Externe Audio-Datei';

//$GLOBALS['TL_LANG']['bbit_mm']['players']['myplayer'] = 'Mein Player';

// $GLOBALS['TL_LANG'][$ns]['margin'] = array('Abstände (Oben, Rechts, Unten, Links)', 'Die Abstände des Videos bzw. Vorschaubildes zum Text.');
// $GLOBALS['TL_LANG'][$ns]['floating'] = array('Ausrichtung', 'Ausrichtung des Videos bzw. Vorschaubildes zum Text.');


$GLOBALS['TL_LANG']['bbit_mm']['editMediaWizard']
	= 'Medium "%s" (ID %s) bearbeiten';

$GLOBALS['TL_LANG']['bbit_mm']['media_legend']
	= 'Medien Einstellungen';

$GLOBALS['TL_LANG']['bbit_mm']['media']
	= array('Medium', 'Das einzubindende Medium.');
$GLOBALS['TL_LANG']['bbit_mm']['sizing']
	= array('Abmaßung', 'Die Größe des Players. "Player" nimmt eine vom Player gewählte Größe. "Höhe anpassen" oder "Breite anpassen" passt die vom Player gewählte Größe an das Seitenverhältnis des Mediums an. Bei "Medium" wird die Größe des Medium verwendet. "Individuell Maße" erlaubt die explizite Angabe einer Größe.');
$GLOBALS['TL_LANG']['bbit_mm']['sizingOptions'] = array(
	'player'		=> 'Player',
	'adjustHeight'	=> 'Höhe anpassen',
	'adjustWidth'	=> 'Breite anpassen',
	'media'			=> 'Video',
	'custom'		=> 'Individuelle Maße'
);
$GLOBALS['TL_LANG']['bbit_mm']['size']
	= array('Maße (in Pixel)', 'Die Breite und Höhe dieses Elements.');


$GLOBALS['TL_LANG']['bbit_mm']['mediabox_legend']
	= 'Mediabox Einstellungen';

$GLOBALS['TL_LANG']['bbit_mm']['mediabox']
	= array('Medium in der Mediabox anzeigen', 'Öffnet das Medium in der Mediabox.');
$GLOBALS['TL_LANG']['bbit_mm']['linkpreview']
	= array('Vorschaubild verlinken', 'Erzeugt einen Bildlink aus dem Vorschaubild des Mediums, anstatt eines Textlinks.');
$GLOBALS['TL_LANG']['bbit_mm']['link']
	= array('Link-Text', 'Der Text um den der Link gelegt werden soll. Wenn freigelassen wird der Titel oder der Dateiname des Mediums verwendet.');
$GLOBALS['TL_LANG']['bbit_mm']['embedlink']
	= array('Link einbetten', 'Fügt den Link im gegebenen Text an der mit "%s" markierten Stelle ein.');
$GLOBALS['TL_LANG']['bbit_mm']['previewsize']
	= array('Bildgröße (in Pixel)', 'Die Größe des verlinkten Vorschaubildes.');
$GLOBALS['TL_LANG']['bbit_mm']['previewcaption']
	= array('Unterschrift', 'Ein kurzer Text der unterhalb des Vorschaubildes angezeigt wird.');
$GLOBALS['TL_LANG']['bbit_mm']['group']
	= array('Mediabox-Gruppe', 'Der Bezeichner der Mediabox-Gruppe in der das Medium angezeigt werden soll.');


$GLOBALS['TL_LANG']['bbit_mm']['player_legend']
	= 'Player Einstellungen';

$GLOBALS['TL_LANG']['bbit_mm']['player']
	= array('Media-Player', 'Der zu nutzende Media-Player. "Automatisch" versucht einen passenden Player zu finden.');
$GLOBALS['TL_LANG']['bbit_mm']['playerBlankOption']
	= 'Automatisch';
