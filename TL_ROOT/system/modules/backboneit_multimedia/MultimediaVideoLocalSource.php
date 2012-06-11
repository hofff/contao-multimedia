<?php

class MultimediaVideoLocalSource extends MultimediaVideoHTTPSource {
	
	public function __construct($strURL) {
		parent::__construct($strURL);
	}
	
	public function getURL() {
		return Environment::getInstance()->base . parent::getURL();
	}
	
	public function getLocalPath() {
		return parent::getURL();
	}

}
