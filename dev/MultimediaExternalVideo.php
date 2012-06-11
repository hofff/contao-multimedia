<?php

class MultimediaExternalVideo extends AbstractMultimediaVideo {
	
	public function __construct(array $arrData) {
		parent::__construct($arrData);
	}
	
	public function getSource() {
		return deserialize($this->arrData['externalVideo_source'], true);
	}
	
}
