<?php

class MultimediaVideoHTTPSource extends AbstractMultimediaVideoSource {

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

	public function validate($blnCached = true) {
		if(!$this->isValidMIME($this->getMIME($blnCached))) {
			throw new Exception(sprintf('[%s] does not respond with a valid internet video MIME', $this->getURL()));
		}
	}

	public function getMIME($blnCached = true) {
		return $blnCached && $this->strMIME ? $this->strMIME : $this->strMIME = MultimediaUtils::fetchMIME($this->getURL());
	}

	protected function isValidMIME($strMIME) {
		return isset(self::$arrMIMEs[$strMIME]);
	}

}
