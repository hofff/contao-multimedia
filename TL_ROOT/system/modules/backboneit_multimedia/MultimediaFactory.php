<?php

class MultimediaFactory extends Controller {

	public function createByID($intID) {
		$intID = intval($intID);
		if($intID < 1) {
			return null;
		}

		$objResult = $this->Database->prepare(
			'SELECT * FROM tl_bbit_mm WHERE id = ?'
		)->execute($intID);

		if(!$objResult->numRows) {
			return null;
		}

		return $this->create($objResult->row());
	}

	public function create(array $arrData) {
		try {
			$strClass = $this->getClass($arrData['type']);
// 			return call_user_func(array($strClass, 'create'), $arrData);
			return new $strClass($arrData);
		} catch(Exception $e) {
			if($GLOBALS['TL_CONFIG']['debug']) {
				throw $e;
			}
			return null;
		}
	}

	private $arrClasses = array();

	public function getClass($strType) {
		if(!isset($this->arrClasses[$strType])) {
			$this->arrClasses[$strType] = $this->findClass($strType);
		}

		if(is_string($this->arrClasses[$strType])) {
			return $this->arrClasses[$strType];

		} else {
			throw $this->arrClasses[$strType];
		}
	}

	protected function findClass($strType) {
		if(!isset($GLOBALS['BBIT_MM_TYPES'][$strType])) {
			return new Exception(sprintf('No multimedia class registered for multimedia type [%s].', $strType));
		}

		$strClass = $GLOBALS['BBIT_MM_TYPES'][$strType];

		if(!$this->classFileExists($strClass)) {
			return new Exception(sprintf('Class [%s] for multimedia type [%s] not found.', $strClass, $strType));
		}

		$objClass = new ReflectionClass($strClass);
		if(!$objClass->isSubclassOf('Multimedia')) {
			return new Exception(sprintf('Class [%s] is not of type "Multimedia".', $strClass));
		}
// 		if(!is_subclass_of($strClass, 'Multimedia')) {
// 			return new Exception(sprintf('Class [%s] is not of type "Multimedia".', $strClass));
// 		}

		return $strClass;
	}

	protected function __construct() {
		parent::__construct();
		$this->import('Database');
	}

	private function __clone() {
	}

	private static $objInstance;

	public static function getInstance() {
		if(!isset(self::$objInstance)) {
			return self::$objInstance = new self();
		}
		return self::$objInstance;
	}

}
