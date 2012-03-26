<?php

class MultimediaExternalAudio extends MultimediaAudio {
	
	public function __construct(array $arrData) {
		parent::__construct($arrData);
	}
	
	public function getSource() {
		return $this->arrData['externalAudio_source'];
	}
	
	public function isLocalSource() {
		return false;
	}
	
}
