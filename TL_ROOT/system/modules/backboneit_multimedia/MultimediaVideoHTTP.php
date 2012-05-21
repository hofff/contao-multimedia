<?php

class MultimediaVideoHTTP extends AbstractMultimediaVideo {
	
	protected static $arrMIMEs = array(
		'application/ogg'	=> array('ogg', 'ogv', 'ogm'),
		'video/ogg'			=> array('ogg', 'ogv', 'ogm'),
		'video/webm'		=> array('webm'),
		'video/mp4'			=> array('mp4', 'm4v', 'f4v'),
		'video/x-flv'		=> array('flv'),
	);
	
	public static function getFileExtensions() {
		$arrExt = array();
		foreach(self::$arrMIMEs as $arrExtByMIME) {
			foreach($arrExtByMIME as $strExt) {
				$arrExt[$strExt] = true;
			}
		}
		return array_keys($arrExt);
	}
	
	public function __construct(array $arrData) {
		parent::__construct($arrData);
	}
	
	public function getSource() {
		$this->arrData['video_source'] = deserialize($this->arrData['video_source'], true);
		return $this->arrData['video_source'];
	}
	
	public function validateSources() {
		$this->arrData['video_source'] = deserialize($this->arrData['video_source'], true);
		$arrInvalid = array();
		foreach($this->arrData['video_source'] as &$arrSource) {
			try {
				$arrSource['mime'] = self::fetchMIME($arrSource);
				if(!isset(self::$arrMIMEs[$arrSource['mime']])) {
					$arrInvalid[] = $arrSource;
				}
			} catch(Exception $e) {
				$arrInvalid[] = $arrSource;
			}
		}
		
		return $arrInvalid;
	}
	
	public function setSource(array $arrSources) {
		$this->arrData['video_source'] = $arrSources;
	}
	
	public function replaceLocalSources(array $arrSources) {
		$this->setSource(array_merge($arrSources, $this->getExternalSources()));
	}
	
	public function replaceExternalSources(array $arrSources) {
		$this->setSource(array_merge($arrSources, $this->getLocalSources()));
	}
	
	public function getLocalSources() {
		return array_filter($this->getSource(), array(__CLASS__, 'isLocalSource'));
	}
	
	public function getExternalSources() {
		return array_filter($this->getSource(), array(__CLASS__, 'isExternalSource'));
	}
	
	public static function fetchMIME(array &$arrSource) {
		$strURL = self::isLocalSource($arrSource) ? Environment::getInstance()->base . $arrSource['url'] : $arrSource['url'];
		
//		$objReq = new RequestExtendedCached(60 * 60); // bugged see #2991
		$objReq = new RequestExtended();
		$objReq->send($strURL, false, 'HEAD');
		
		if($objReq->hasError()) {
			throw new Exception(sprintf('Source request responded with error: [%s]', $objReq->error), $objReq->code);
		}
		
		list($strMIME) = explode(';', $objReq->headers['Content-Type'], 2);
		return $strMIME ? $strMIME : 'application/octet-stream';
	}
	
	public static function isLocalSource(array $arrSource) {
		return $arrSource['local'];
	}
	
	public static function isExternalSource(array $arrSource) {
		return !$arrSource['local'];
	}
	
}
