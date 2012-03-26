<?php

abstract class MultimediaAudio extends AbstractMultimedia {
	
	public function __construct(array $arrData = null) {
		parent::__construct($arrData);
	}
	
	public function getSize() {
		return array(0, 0);
	}
		
}
