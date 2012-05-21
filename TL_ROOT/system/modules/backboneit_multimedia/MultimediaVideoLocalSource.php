<?php

class MultimediaVideoLocalSource implements MultimediaVideoHTTPSource {
	
	public function __construct($strURL) {
		parent::__construct($strURL, 'local');
	}
	
	public function getURL() {
		return Environment::getInstance()->base . parent::getURL();
	}
	
	public function getLocalPath() {
		return parent::getURL();
	}

}
