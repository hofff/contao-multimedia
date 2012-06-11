<?php

class MultimediaVideoSMILSource extends AbstractMultimediaVideoSource {
	
	private $blnValid;
	
	public function __construct($strURL) {
		parent::__construct($strURL, 'smil');
	}
	
	public function serialize() {
		return serialize(array(
			parent::serialize(),
			$this->blnValid,
		));
	}
	
	public function unserialize($strSerialized) {
		list(
			$strParent,
			$this->blnValid,
		) = unserialize($strSerialized);
		parent::unserialize($strParent);
	}
	
	public function validate($blnCached = true) {
		if(!$blnCached || !isset($this->blnValid)) {
			$strURL = $this->getURL();
			$this->blnValid = strncmp($strURL, 'http://', 7)
				&& 'application/smil' == MultimediaUtils::fetchMIME($strURL);
		}
		if(!$this->blnValid) {
			throw new Exception(sprintf('[%s] is not a SMIL file', $strURL));
		}
	}
	
}
