<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'AbstractMultimedia'              => 'system/modules/hofff_multimedia/AbstractMultimedia.php',
	'AbstractMultimediaPlayer'        => 'system/modules/hofff_multimedia/AbstractMultimediaPlayer.php',
	'AbstractMultimediaVideo'         => 'system/modules/hofff_multimedia/AbstractMultimediaVideo.php',
	'AbstractMultimediaVideoSource'   => 'system/modules/hofff_multimedia/AbstractMultimediaVideoSource.php',
	'ContentMultimedia'               => 'system/modules/hofff_multimedia/ContentMultimedia.php',
	'Multimedia'                      => 'system/modules/hofff_multimedia/Multimedia.php',
	'MultimediaDCA'                   => 'system/modules/hofff_multimedia/MultimediaDCA.php',
	'MultimediaFactory'               => 'system/modules/hofff_multimedia/MultimediaFactory.php',
	'MultimediaFeatureAudiodesc'      => 'system/modules/hofff_multimedia/MultimediaFeatureAudiodesc.php',
	'MultimediaFeatureCaptions'       => 'system/modules/hofff_multimedia/MultimediaFeatureCaptions.php',
	'MultimediaModel'                 => 'system/modules/hofff_multimedia/MultimediaModel.php',
	'MultimediaPlayer'                => 'system/modules/hofff_multimedia/MultimediaPlayer.php',
	'MultimediaPlayerFactory'         => 'system/modules/hofff_multimedia/MultimediaPlayerFactory.php',
	'MultimediaUtils'                 => 'system/modules/hofff_multimedia/MultimediaUtils.php',
	'MultimediaVideo'                 => 'system/modules/hofff_multimedia/MultimediaVideo.php',
	'MultimediaVideoHTTPSource'       => 'system/modules/hofff_multimedia/MultimediaVideoHTTPSource.php',
	'MultimediaVideoHTTPStreamSource' => 'system/modules/hofff_multimedia/MultimediaVideoHTTPStreamSource.php',
	'MultimediaVideoLocalSource'      => 'system/modules/hofff_multimedia/MultimediaVideoLocalSource.php',
	'MultimediaVideoRTMPSource'       => 'system/modules/hofff_multimedia/MultimediaVideoRTMPSource.php',
	'MultimediaVideoSMILSource'       => 'system/modules/hofff_multimedia/MultimediaVideoSMILSource.php',
	'MultimediaVideoSource'           => 'system/modules/hofff_multimedia/MultimediaVideoSource.php',
	'MultimediaVimeo'                 => 'system/modules/hofff_multimedia/MultimediaVimeo.php',
	'MultimediaYoutube'               => 'system/modules/hofff_multimedia/MultimediaYoutube.php',
	'ValuedCheckBox'                  => 'system/modules/hofff_multimedia/ValuedCheckBox.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'bbit_mm'          => 'system/modules/hofff_multimedia/templates',
	'bbit_mm_mediabox' => 'system/modules/hofff_multimedia/templates',
	'ce_multimedia'    => 'system/modules/hofff_multimedia/templates',
));
