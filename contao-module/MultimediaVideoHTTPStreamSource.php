<?php

class MultimediaVideoHTTPStreamSource extends MultimediaVideoHTTPSource {

	private static $arrMIMEs = array(
		'video/mp4'			=> true,
		'video/x-flv'		=> true,
	);

	const DEFAULT_START_PARAM = 'start';

	protected $strStartParam;

	public function __construct($strURL, $strStartParam = self::DEFAULT_START_PARAM) {
		parent::__construct($strURL, 'httpStream');
		$this->setStartParam($strStartParam);
	}

	public function serialize() {
		return serialize(array(
			parent::serialize(),
			$this->strStartParam,
		));
	}

	public function unserialize($strSerialized) {
		list(
			$strParent,
			$this->strStartParam,
		) = unserialize($strSerialized);
		parent::unserialize($strParent);
	}

	public function getStartParam() {
		return $this->strStartParam;
	}

	public function setStartParam($strStartParam = self::DEFAULT_START_PARAM) {
		$this->strStartParam = $strStartParam;
	}

	protected function isValidMIME($strMIME) {
		return isset(self::$arrMIMEs[$strMIME]);
	}

}
