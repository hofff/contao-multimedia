<?php

class MultimediaLocalAudio extends MultimediaAudio {
	
	public function __construct(array $arrData) {
		parent::__construct($arrData);
	}
	
	public function getSource() {
		return $this->arrData['localAudio_source'];
	}
	
	public function isLocalSource() {
		return true;
	}
	
}
