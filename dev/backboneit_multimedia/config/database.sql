-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************

CREATE TABLE `tl_backboneit_video_jwplayer` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `fallback` char(1) NOT NULL default '',
  `jwplayer` varchar(255) NOT NULL default '',
  `stretching` char(10) NOT NULL default 'uniform',
  `smoothing` char(1) NOT NULL default '1',
  `html5` char(1) NOT NULL default '',
  `volume` smallint(5) NOT NULL default '90',
  `mute` char(1) NOT NULL default '',
  `repeatplay` char(10) NOT NULL default 'none',
  `autoplay` char(1) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `size` varchar(255) NOT NULL default '',
  `skin` char(10) NOT NULL default '',
  `css` varchar(255) NOT NULL default '',
  `skinxml` varchar(255) NOT NULL default '',
  `skinswf` varchar(255) NOT NULL default '',
  `dock` char(1) NOT NULL default '1',
  `icons` char(1) NOT NULL default '1',
  `controlbar` varchar(255) NOT NULL default 'over',
  `controlbarIdlehide` char(1) NOT NULL default '',
  `backcolor` varchar(6) NOT NULL default '',
  `frontcolor` varchar(6) NOT NULL default '',
  `lightcolor` varchar(6) NOT NULL default '',
  `screencolor` varchar(6) NOT NULL default '',
  `logo` char(1) NOT NULL default '',
  `logoLink` char(1) NOT NULL default '',
  `logoLinkURL` varchar(255) NOT NULL default '',
  `logoLinkTarget` char(1) NOT NULL default '1',
  `logoFile` varchar(255) NOT NULL default '',
  `logoMargin` smallint(5) NOT NULL default '8',
  `logoPosition` char(12) NOT NULL default 'bottom-left',
  `logoOver` smallint(5) NOT NULL default '100',
  `logoOut` smallint(5) NOT NULL default '50',
  `logoHide` char(1) NOT NULL default '1',
  `logoTimeout` smallint(5) NOT NULL default '3',
  PRIMARY KEY  (`id`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `tl_backboneit_video_jwplayer_plugins` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `plugin` varchar(255) NOT NULL default '',
  `params` blob NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `tl_layout` (
  `backboneit_video_jwplayer` int(10) unsigned NOT NULL default '0',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
