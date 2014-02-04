<?php

$ns = 'tl_backboneit_video_jwplayer';

$GLOBALS['TL_LANG'][$ns]['new']					= array('Neue Konfiguration', 'Eine neue JW-Player Konfiguration erstellen.');
$GLOBALS['TL_LANG'][$ns]['edit']				= array('Bearbeiten', 'Konfiguration ID %s bearbeiten');
$GLOBALS['TL_LANG'][$ns]['plugins']				= array('Plugins bearbeiten', 'Plugins der Konfiguration ID %s bearbeiten');
$GLOBALS['TL_LANG'][$ns]['copy']				= array('Kopieren', 'Konfiguration ID %s kopieren');
$GLOBALS['TL_LANG'][$ns]['delete']				= array('Löschen', 'Konfiguration ID %s löschen');
$GLOBALS['TL_LANG'][$ns]['show']				= array('Anzeigen', 'Konfiguration ID %s anzeigen');

$GLOBALS['TL_LANG'][$ns]['general_legend']		= 'Allgemein';
$GLOBALS['TL_LANG'][$ns]['title']				= array('Titel', 'Der Titel dieser Konfiguration zur Verwendung als Label im Backend.');
$GLOBALS['TL_LANG'][$ns]['fallback']			= array('Standardkonfiguration', 'Diese Einstellung als globle Standardkonfiguration verwenden. Diese wird dann verwendet, wenn keine passendere für den jeweiligen Kontext gefunden wurde. (Einstellungen werden nicht vererbt.)');

$GLOBALS['TL_LANG'][$ns]['player_legend']		= 'JW-Player';
$GLOBALS['TL_LANG'][$ns]['jwplayer']			= array('JW-Player Applikation (Version 5.3 oder höher)',
	'<strong><a href="http://www.longtailvideo.com/players/" title="JW-Player auf longtailvideo.com"
	onclick="window.open(this.href); return false;">JW-Player Download</a></strong> -
	Aufgrund von lizenzrechtlichen Bestimmungen darf der JW-Player nicht in dieser
	Contao-Erweiterung enthalten sein. Sie müssen eine Kopie des Players von der
	Herstellerseite herunterladen und das Archiv in der Contao-Dateiverwaltung hochladen.
	Wählen Sie anschließend in dieser Einstellung die Archiv-Datei aus (wird automatisch
	entpackt).');
$GLOBALS['TL_LANG'][$ns]['stretching']			= array('Größenanpassung', 'Bestimmt wie ein Video an die Bühnengröße angepasst wird, wenn dessen Größe nicht mit dieser übereinstimmt. In Klammern werden die Effekt der Methode anzeigt, die eintreten <strong>können</strong>.');
$GLOBALS['TL_LANG'][$ns]['stretchingOptions']	= array(
	'none'		=> 'Nicht anpassen ("Schwarze Balken", Zuschnitt)',
	'exactfit'	=> 'Exakt anpassen (Verzerrung, Hochskalierung)',
	'uniform'	=> 'Einpassen ("Schwarze Balken", Hochskalierung)',
	'fill'		=> 'Füllend (Zuschnitt, Hochskalierung)'
);
$GLOBALS['TL_LANG'][$ns]['smoothing']			= array('Weichzeichnen (nur Flash)', 'Aktiviert das Weichzeichnen des Bilder, wenn das Video hochskaliert wird, um Blockbildung zu verhindern. Funktioniert nur im Flashmodus.');
$GLOBALS['TL_LANG'][$ns]['html5']				= array('HTML5 Einbindung bevorzugen', 'Diese Einstellung wird noch nicht empfohlen, da die Unterstützung der Video-Formate von Browser zu Browser stark abweicht.');

$GLOBALS['TL_LANG'][$ns]['behavior_legend']		= 'Verhalten';
$GLOBALS['TL_LANG'][$ns]['volume']				= array('Voreingestellte Lautstärke (in %)', 'Die anfängliche Lautstärke des Players.');
$GLOBALS['TL_LANG'][$ns]['mute']				= array('Stumm einbinden', 'Legt fest, ob der Player anfänglich stumm geschaltet werden soll.');
$GLOBALS['TL_LANG'][$ns]['repeatplay']			= array('Wiederholtes Abspielen', 'Legt fest was passiert nachdem ein Medium vollständig abgespielt wurde.');
$GLOBALS['TL_LANG'][$ns]['repeatplayOptions']	= array(
	'none'		=> 'Nach jedem Medium stoppen',
	'list'		=> 'Einmal gesamte Abspielliste',
	'always'	=> 'Gesamte Abspielliste wiederholen',
	'single'	=> 'Einzelnes Medium wiederholen'
);
$GLOBALS['TL_LANG'][$ns]['autoplay']			= array('Automatisches Abspielen', 'Abspiellisten, Audio- und Video-Medien werden automatisch gestartet.');

$GLOBALS['TL_LANG'][$ns]['appearence_legend']	= 'Aussehen';
$GLOBALS['TL_LANG'][$ns]['image']				= array('Standardvorschaubild', 'Das Vorschaubild wird angezeigt solange die Medien-Datei noch nicht abgespielt bzw. angezeigt wird.');
$GLOBALS['TL_LANG'][$ns]['size']				= array('Größe der Bühne (in Pixeln)', 'Die Breite und Höhe der Bühne (inkl. Bedienleiste).');
$GLOBALS['TL_LANG'][$ns]['skin']				= array('Skintyp', 'Die Art des zu verwendenden Skins.');
$GLOBALS['TL_LANG'][$ns]['skinOptions']			= array(
	'default'	=> 'Standard (kein Skin)',
	'css'		=> 'CSS Styling',
	'xml'		=> 'XML Skin',
	'swf'		=> 'Flashskin (veraltet)'
);
$GLOBALS['TL_LANG'][$ns]['css']					= array('CSS Klasse', 'Eine CSS Klasse die dem Mediencontainer hinzugefügt wird.');
$GLOBALS['TL_LANG'][$ns]['skinswf']				= array('Skin-SWF-Datei', 'Die SWF-Datei, welche den Skin enthält.');
$GLOBALS['TL_LANG'][$ns]['skinxml']				= array('Skin-XML-Datei', 'Die XML-Datei, welche den Skin enthält.');
$GLOBALS['TL_LANG'][$ns]['dock']				= array('Plugins in der Leinwand anzeigen', 'Wenn aktiviert, werden Plugin Schaltflächen über der Leinwand angezeigt, sonst in einem DropDown-Menü in der Bedienleiste.');
$GLOBALS['TL_LANG'][$ns]['icons']				= array('Leinwand-Icons', 'Legt fest, ob die Icons für "Abspielen" und "Ladend" über dem Video in der Leinwand angezeigt werden.');
$GLOBALS['TL_LANG'][$ns]['controlbar']			= array('Position der Bedienleiste', 'Verschiebt die Bedienleiste an die gewünschte Position innerhalb der Bühne.');
$GLOBALS['TL_LANG'][$ns]['controlbarOptions']	= array(
	'bottom'	=> 'Unten',
	'top'		=> 'Oben',
	'over'		=> 'Darüber liegend',
	'none'		=> 'nicht anzeigen'
);
$GLOBALS['TL_LANG'][$ns]['controlbarIdlehide']	= array('Bedienleiste ausblenden, wenn Inaktiv', 'Die Bedienleiste ausgeblendet lassen, wenn ein Medium pausiert oder gestoppt wurde.');
$GLOBALS['TL_LANG'][$ns]['backcolor']			= array('Hintergrundfarbe (in "RGB-Hex")', 'In RGB Hexadezimalnotation, zum Beispiel "ff0000" für rot. Es wird auch die kurzschreibweise mit 3 Zeichen unterstützt.');
$GLOBALS['TL_LANG'][$ns]['frontcolor']			= array('Vordergrundfarbe (in "RGB-Hex")', 'In RGB Hexadezimalnotation, zum Beispiel "00ff00" für grün. Es wird auch die kurzschreibweise mit 3 Zeichen unterstützt.');
$GLOBALS['TL_LANG'][$ns]['lightcolor']			= array('Highlight-Farbe (in "RGB-Hex")', 'In RGB Hexadezimalnotation, zum Beispiel "0000ff" für blau. Es wird auch die kurzschreibweise mit 3 Zeichen unterstützt.');
$GLOBALS['TL_LANG'][$ns]['screencolor']			= array('Leinwandfarbe (in "RGB-Hex")', 'In RGB Hexadezimalnotation, zum Beispiel "000000" für schwarz. Es wird auch die kurzschreibweise mit 3 Zeichen unterstützt.');

$GLOBALS['TL_LANG'][$ns]['logo_legend']			= 'Logo';
$GLOBALS['TL_LANG'][$ns]['logo']				= array('Logo hinzufügen', 'Diese Option funktioniert nur mit einem lizensierten JW-Player. Fügt ein Logo (meist als Wasserzeichen) in den Player (über dem Video) ein, welches optional verlinkt werden kann.');
$GLOBALS['TL_LANG'][$ns]['logoLink']			= array('Logo verlinken', 'Das Logo mit einem Link belegen.');
$GLOBALS['TL_LANG'][$ns]['logoFile']			= array('Bilddatei', 'Die Datei die ein Bild des Logos beinhaltet. Empfohlen wird ein Bild im PNG-Format.');
$GLOBALS['TL_LANG'][$ns]['logoMargin']			= array('Abstand (in Pixeln)', 'Der Abstand des Logos zum Rand des Players bzw. zur Bedienleiste.');
$GLOBALS['TL_LANG'][$ns]['logoPosition']		= array('Position', 'Die relative Position des Logos im Player.');
$GLOBALS['TL_LANG'][$ns]['logoPositionOptions']	= array(
	'top-left'		=> 'Oben links',
	'top-right'		=> 'Oben rechts',
	'bottom-left'	=> 'Unten links',
	'bottom-right'	=> 'Unten rechts'
);
$GLOBALS['TL_LANG'][$ns]['logoOver']			= array('MouseOver-Transparenz (in %)', 'Die Transparenz des Logos, während man mit der Maus darüber fährt.');
$GLOBALS['TL_LANG'][$ns]['logoOut']				= array('MouseOut-Transparenz (in %)', 'Die Transparenz des Logos, wenn sich der Mauszeigen nicht über dem Logo befindet.');
$GLOBALS['TL_LANG'][$ns]['logoHide']			= array('Logo ausblenden', 'Das Logo nach einer gegebenen Zeit ausblenden.');
$GLOBALS['TL_LANG'][$ns]['logoTimeout']			= array('Ausblendverzögerung (in Sekunden)', 'Die Verzögerung bis das Logo ausgeblendet wird, nach dem der Abspielvorgang gestartet wurde.');
