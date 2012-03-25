<?php

class MultimediaVideo extends AbstractMultimedia {
	
	public function __construct(array $arrData = null) {
		parent::__construct($arrData);
	}
	
	public function getSource() {
		return $this->isLocalSource() ? $this->arrData['video_local'] : $this->arrData['video_external'];
	}
	
	public function isLocalSource() {
		return $this->arrData['video_source'] == 'local';
	}
		
}
