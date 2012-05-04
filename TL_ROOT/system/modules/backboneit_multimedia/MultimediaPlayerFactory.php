<?php

class MultimediaPlayerFactory extends Controller {
	
	public function getPlayerClassFor(Multimedia $objMM, $strPrefered = null) {
		$arrPlayers = $GLOBALS['BBIT_MM_PLAYERS'];
		if($strPrefered && array_key_exists($strPrefered, $arrPlayers)) {
			$arrPlayers = array_merge(array($strPrefered => ''), $arrPlayers);
		}
		
		foreach($arrPlayers as $strPlayer => $strClass) {
			try {
				$strClass = $this->getClass($strPlayer);
				if(call_user_func(array($strClass, 'canPlay'), $objMM)) {
					return $strClass;
				}
			} catch(Exception $e) {
			}
		}
		
		throw new Exception(sprintf('No compatible player found for multimedia [%s].', $objMM->getID()));
	}
	
	private $arrClasses = array();
	
	public function getClass($strPlayer) {
		if(!isset($this->arrClasses[$strPlayer])) {
			$this->arrClasses[$strPlayer] = $this->findClass($strPlayer);
		}
		
		if(is_string($this->arrClasses[$strPlayer])) {
			return $this->arrClasses[$strPlayer];
			
		} else {
			throw $this->arrClasses[$strPlayer];
		}
	}
	
	protected function findClass($strPlayer) {
		if(!isset($GLOBALS['BBIT_MM_PLAYERS'][$strPlayer])) {
			return new Exception(sprintf('No player class registered for player [%s].', $strPlayer));
		}
		
		$strClass = $GLOBALS['BBIT_MM_PLAYERS'][$strPlayer];
		
		if(!$this->classFileExists($strClass)) {
			return new Exception(sprintf('Class [%s] for player [%s] not found.', $strClass, $strPlayer));
		}
		
		if(!is_subclass_of($strClass, 'MultimediaPlayer')) {
			return new Exception(sprintf('Class [%s] is not of type "MultimediaPlayer".', $strClass));
		}
		
		return $strClass;
	}
	
	protected function __construct() {
		parent::__construct();
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
