<?php

class MultimediaExternalVideo extends MultimediaVideo {
	
	public function __construct(array $arrData) {
		parent::__construct($arrData);
	}
	
	public function getSource() {
		return $this->arrData['externalVideo_source'];
	}
	
	public function isLocalSource() {
		return false;
	}
	
}
