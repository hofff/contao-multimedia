<?php

abstract class AbstractMultimediaVideoSource implements MultimediaVideoSource {

	private $strType;

	private $strURL;

	protected $intBitrate;

	protected $intWidth;

	protected function __construct($strURL, $strType) {
		$this->strURL = $strURL;
		$this->strType = $strType;
	}

	public function serialize() {
		return serialize(array(
			$this->strType,
			$this->strURL,
			$this->intBitrate,
			$this->intWidth,
		));
	}

	public function unserialize($strSerialized) {
		list(
			$this->strType,
			$this->strURL,
			$this->intBitrate,
			$this->intWidth,
		) = unserialize($strSerialized);
	}

	public function getType() {
		return $this->strType;
	}

	public function getURL() {
		return $this->strURL;
	}

	public function isValid($blnCached = true) {
		try {
			$this->validate($blnCached);
			return true;
		} catch(Exception $e) {
			return false;
		}
	}

	public function getBitrate() {
		return $this->intBitrate;
	}

	public function setBitrate($intBitrate) {
		$this->intBitrate = $intBitrate;
	}

	public function getWidth() {
		return $this->intWidth;
	}

	public function setWidth($intWidth) {
		$this->intWidth = $intWidth;
	}

}
