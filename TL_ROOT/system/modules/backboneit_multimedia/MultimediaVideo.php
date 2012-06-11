<?php

class MultimediaVideo extends AbstractMultimediaVideo {
	
	protected static $arrMIMEs = array(
		'application/ogg'	=> array('ogg', 'ogv', 'ogm'),
		'video/ogg'			=> array('ogg', 'ogv', 'ogm'),
		'video/webm'		=> array('webm'),
		'video/mp4'			=> array('mp4', 'm4v', 'f4v'),
		'video/x-flv'		=> array('flv'),
	);
	
	public static function getFileExtensions() {
		$arrExt = array();
		foreach(self::$arrMIMEs as $arrExtByMIME) {
			foreach($arrExtByMIME as $strExt) {
				$arrExt[$strExt] = true;
			}
		}
		return array_keys($arrExt);
	}
	
	public function __construct(array $arrData) {
		parent::__construct($arrData);
	}
	
	public function getSource() {
		$this->arrData['video_source'] = deserialize($this->arrData['video_source'], true);
		return $this->arrData['video_source'];
	}
	
	public function setSource(array $arrSources) {
		unset($this->arrTypeMap);
		$this->arrData['video_source'] = $arrSources;
	}
	
	public function validateSource($blnCached = true) {
		$arrInvalid = array();
		foreach($this->getSource() as $objSource) if(!$objSource->isValid($blnCached)) {
			$arrInvalid[] = $objSource;
		}
		return $arrInvalid;
	}
	
	public function getSourceByType($strType = null) {
		if(!strlen($strType)) {
			return $this->getSource();
		}
		if(!isset($this->arrTypeMap)) {
			$this->buildTypeMap();
		}
		return (array) $this->arrTypeMap[$strType];
	}
	
	public function getSourceByClass() {
		$arrClasses = array_flip(func_get_args());
		
		if(!$arrClasses) {
			return $this->getSource();
		}
		
		$arrSources = array();
		foreach($this->getSource() as $objSource) {
			isset($arrClasses[get_class($objSource)]) && $arrSources[] = $objSource;
		}
		
		return $arrSources;
	}
	
	public function replaceSourceByClass(array $arrSources) {
		$arrTypes = array();
		foreach($arrSources as $objSource) {
			$arrTypes[get_class($objSource)] = true;
		}
		foreach($this->getSource() as $objSource) if(!isset($arrTypes[get_class($objSource)])) {
			$arrSources[] = $objSource;
		}
		$this->setSource($arrSources);
	}
	
	protected function buildTypeMap() {
		$this->arrTypeMap = array();
		foreach($this->getSource() as $objSource) {
			$this->arrTypeMap[$objSource->getType()][] = $objSource;
		}
	}
	
}
