<?php

class MultimediaVideoLocalSource extends MultimediaVideoHTTPSource {

	public function __construct($strURL) {
		parent::__construct($strURL);
	}

	public function getURL() {
		$url = parent::getURL();
		$file = \FilesModel::findByUuid($url);
		$file && $url = $file->path;
		return \Environment::getInstance()->base . $url;
	}

	public function getLocalPath() {
		return parent::getURL();
	}

}
