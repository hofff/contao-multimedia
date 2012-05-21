<?php

class AbstractMultimediaVideoSource implements MultimediaVideoSource {
	
	private $strType;
	
	private $strURL;
	
	protected function __construct($strURL, $strType) {
		$this->strURL = $strURL;
		$this->strType = $strType;
	}
	
	public function serialize() {
		return serialize(array(
			$this->strType,
			$this->strURL,
		));
	}
	
	public function unserialize($strSerialized) {
		list(
			$this->strType,
			$this->strURL,
		) = unserialize($strSerialized);
	}
	
	public function getType() {
		return $this->strType;
	}
	
	public function getURL() {
		return $this->strURL;
	}
	
	public function isValid() {
		try {
			$this->validate();
			return true;
		} catch(Exception $e) {
			return false;
		}
	}
	
}
