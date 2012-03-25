<?php

class MultimediaYoutube extends AbstractMultimedia {
	
	
	public function __construct(array $arrData = null) {
		parent::__construct($arrData);
	}
	
	public function getSource() {
		return $this->arrData['youtube_external'];
	}
	
	public function isLocalSource() {
		return false;
	}

}
