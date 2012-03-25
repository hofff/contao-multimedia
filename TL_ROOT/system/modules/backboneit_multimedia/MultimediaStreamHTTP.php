<?php

class MultimediaStreamHTTP extends AbstractMultimedia {
	
	const DEFAULT_START_PARAM = 'start';
	
	public function __construct(array $arrData = null) {
		parent::__construct($arrData);
	}
	
	public function getSource() {
// 				if(JWPlayerUtils::isDownloadExtensionActive()) {
// 					$this->import('Download');
// 					$this->Download->process($this->backboneit_jwplayer_local);
// 					$this->Download->setConfig($this->arrData);
// 					$this->Download->referer = 'no';
// 					$this->Download->invalidate = 'ttl';
// 					$this->Download->bind = 'creation';
// 					$this->Download->setStartParam(self::DEFAULT_START_PARAM);
// 					$arrConfig['file'] = $this->Download->getURL($this->backboneit_jwplayer_local);
		return $this->isLocalSource() ? $this->arrData['video_local'] : $this->arrData['video_external'];
	}
	
	public function isLocalSource() {
		return $this->arrData['video_source'] == 'local';
	}
	
	public function getStartParam() {
		return self::DEFAULT_START_PARAM;
	}
	
	public static function isDownloadExtensionActive() {
		return false;
		// 		if(!isset(self::$arrCache['backboneit_download']))
			// 			self::$arrCache['backboneit_download'] = in_array('backboneit_download', Config::getInstance()->getActiveModules());
			
			// 		return self::$arrCache['backboneit_download'];
	}
	
}
