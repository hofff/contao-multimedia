<?php

class MultimediaVideoHTTPSource implements AbstractMultimediaVideoSource {
	
	private static $arrMIMEs = array(
		'application/ogg'	=> true,
		'video/ogg'			=> true,
		'video/webm'		=> true,
		'video/mp4'			=> true,
		'video/x-flv'		=> true,
	);
	
	private $strMIME;
	
	public function __construct($strURL, $strType = 'http') {
		parent::__construct($strURL, $strType);
	}
	
	public function serialize() {
		return serialize(array(
			parent::serialize(),
			$this->strMIME,
		));
	}
	
	public function unserialize($strSerialized) {
		list(
			$strParent,
			$this->strMIME,
		) = unserialize($strSerialized);
		parent::unserialize($strParent);
	}
	
	public function validate() {
		if(!isset(self::$arrMIMEs[$this->getMIME()])) {
			throw new Exception(sprintf('[%s] does not respond with a valid internet video MIME', $this->getURL()));
		}
	}
	
	public function getMIME() {
		return $this->strMIME ? $this->strMIME : $this->strMIME = $this->fetchMIME();
	}

	protected function fetchMIME() {
//		$objReq = new RequestExtendedCached(60 * 60); // bugged see #2991
		$objReq = new RequestExtended();
		$objReq->send($this->getURL(), false, 'HEAD');
		
		if($objReq->hasError()) {
			throw new Exception(sprintf('Source request responded with error: [%s]', $objReq->error), $objReq->code);
		}
		
		list($strMIME) = explode(';', $objReq->headers['Content-Type'], 2);
		return $strMIME ? $strMIME : 'application/octet-stream';
	}
	
}
