<?php

class MultimediaLocalVideo extends AbstractMultimediaVideo {

	public function __construct(array $arrData) {
		parent::__construct($arrData);
	}

	public function getSource() {
		$arrSources = array();

		foreach(deserialize($this->arrData['localVideo_source'], true) as $strSource) {
			$objFile = new File($strSource);
			$arrSources[] = array(
				'url' => $strSource,
				'mime' => $objFile->mime
			);
		}

		return $arrSources;
	}

}
