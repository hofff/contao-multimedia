<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Backboneit_multimedia
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'AbstractMultimedia'              => 'system/modules/backboneit_multimedia/AbstractMultimedia.php',
	'AbstractMultimediaPlayer'        => 'system/modules/backboneit_multimedia/AbstractMultimediaPlayer.php',
	'AbstractMultimediaVideo'         => 'system/modules/backboneit_multimedia/AbstractMultimediaVideo.php',
	'AbstractMultimediaVideoSource'   => 'system/modules/backboneit_multimedia/AbstractMultimediaVideoSource.php',
	'ContentMultimedia'               => 'system/modules/backboneit_multimedia/ContentMultimedia.php',
	'Multimedia'                      => 'system/modules/backboneit_multimedia/Multimedia.php',
	'MultimediaDCA'                   => 'system/modules/backboneit_multimedia/MultimediaDCA.php',
	'MultimediaFactory'               => 'system/modules/backboneit_multimedia/MultimediaFactory.php',
	'MultimediaFeatureAudiodesc'      => 'system/modules/backboneit_multimedia/MultimediaFeatureAudiodesc.php',
	'MultimediaFeatureCaptions'       => 'system/modules/backboneit_multimedia/MultimediaFeatureCaptions.php',
	'MultimediaModel'                 => 'system/modules/backboneit_multimedia/MultimediaModel.php',
	'MultimediaPlayer'                => 'system/modules/backboneit_multimedia/MultimediaPlayer.php',
	'MultimediaPlayerFactory'         => 'system/modules/backboneit_multimedia/MultimediaPlayerFactory.php',
	'MultimediaUtils'                 => 'system/modules/backboneit_multimedia/MultimediaUtils.php',
	'MultimediaVideo'                 => 'system/modules/backboneit_multimedia/MultimediaVideo.php',
	'MultimediaVideoHTTPSource'       => 'system/modules/backboneit_multimedia/MultimediaVideoHTTPSource.php',
	'MultimediaVideoHTTPStreamSource' => 'system/modules/backboneit_multimedia/MultimediaVideoHTTPStreamSource.php',
	'MultimediaVideoLocalSource'      => 'system/modules/backboneit_multimedia/MultimediaVideoLocalSource.php',
	'MultimediaVideoRTMPSource'       => 'system/modules/backboneit_multimedia/MultimediaVideoRTMPSource.php',
	'MultimediaVideoSMILSource'       => 'system/modules/backboneit_multimedia/MultimediaVideoSMILSource.php',
	'MultimediaVideoSource'           => 'system/modules/backboneit_multimedia/MultimediaVideoSource.php',
	'MultimediaYoutube'               => 'system/modules/backboneit_multimedia/MultimediaYoutube.php',
	'ValuedCheckBox'                  => 'system/modules/backboneit_multimedia/ValuedCheckBox.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'bbit_mm'          => 'system/modules/backboneit_multimedia/templates',
	'bbit_mm_mediabox' => 'system/modules/backboneit_multimedia/templates',
	'ce_multimedia'    => 'system/modules/backboneit_multimedia/templates',
));
