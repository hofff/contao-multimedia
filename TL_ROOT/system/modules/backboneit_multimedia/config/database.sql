-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************

CREATE TABLE `tl_bbit_mm` (

  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',

  `type` varchar(255) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `description` text NULL,
  `image` varchar(1022) NOT NULL default '',

  `ratio` varchar(255) NOT NULL default '',
  `ratioCustom` varchar(255) NOT NULL default '',

  `youtube_source` varchar(1022) NOT NULL default '',
  `youtube_image` varchar(1022) NOT NULL default '',

  `video_source` blob NULL,

  `audio_source` blob NULL,

  `captions_source` varchar(255) NOT NULL default '',
  `captions_labels` blob NULL,

  `audiodesc_source` varchar(255) NOT NULL default '',
  `audiodesc_volume` smallint(5) NOT NULL default '90',
  `audiodesc_external` varchar(1022) NOT NULL default '',
  `audiodesc_local` varchar(1022) NOT NULL default '',

  PRIMARY KEY  (`id`),
  KEY `title` (`title`),

) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `tl_bbit_mm_captions` (

  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',

  `title` varchar(255) NOT NULL default '',

  `source` varchar(255) NOT NULL default '',
  `format` varchar(255) NOT NULL default '',
  `external` varchar(1022) NOT NULL default '',
  `local` varchar(1022) NOT NULL default '',

  `startparam` varchar(255) NOT NULL default '',

  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`, `title`),

) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `tl_content` (

  `bbit_mm_media` int(10) unsigned NOT NULL default '0',
  `bbit_mm_sizing` varchar(255) NOT NULL default '',
  `bbit_mm_size` varchar(255) NOT NULL default '',

  `bbit_mm_mediabox` varchar(255) NOT NULL default '',
  `bbit_mm_linkpreview` varchar(255) NOT NULL default '',
  `bbit_mm_link` varchar(255) NOT NULL default '',
  `bbit_mm_embedlink` varchar(1023) NOT NULL default '',
  `bbit_mm_previewsize` varchar(255) NOT NULL default '',
  `bbit_mm_previewcaption` varchar(255) NOT NULL default '',
  `bbit_mm_group` varchar(255) NOT NULL default '',

  `bbit_mm_player` varchar(255) NOT NULL default '',

) ENGINE=MyISAM DEFAULT CHARSET=utf8;
