<?php

class MultimediaLocalVideo extends MultimediaVideo {
	
	public function __construct(array $arrData) {
		parent::__construct($arrData);
	}
	
	public function getSource() {
		return $this->arrData['localVideo_source'];
	}
	
	public function isLocalSource() {
		return true;
	}
	
}
