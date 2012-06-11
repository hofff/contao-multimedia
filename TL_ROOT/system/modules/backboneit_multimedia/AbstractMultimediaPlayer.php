<?php

abstract class AbstractMultimediaPlayer extends Controller implements MultimediaPlayer {
	
	protected $strSizeMode = MultimediaPlayer::SIZE_PLAYER;
	
	protected $arrSize;
	
	protected function __construct(array $arrSize = array(400, 300)) {
		parent::__construct();
		$this->setSize($arrSize);
	}
		
	public function setSizeMode($strMode) {
		switch($strMode) {
			case MultimediaPlayer::SIZE_ADJUST_HEIGHT:
			case MultimediaPlayer::SIZE_ADJUST_WIDTH:
				$this->strSizeMode = $strMode;
				break;
				
			default:
				$this->strSizeMode = MultimediaPlayer::SIZE_PLAYER;
				break;
		}
	}
		
	public function getSizeMode() {
		return $this->strSizeMode;
	}
		
	public function setSize($arrSize) {
		$arrSize = self::sanitizeSize($arrSize);
		
		if(!$arrSize) {
			throw new Exception('Invalid size given.');
		}
		
		$this->arrSize = $arrSize;
	}
		
	public function getSize() {
		return $this->arrSize;
	}
		
	public function getSizeFor(Multimedia $objMM) {
		switch($this->strSizeMode) {
			case MultimediaPlayer::SIZE_ADJUST_HEIGHT:
				$arrSize = array($this->arrSize[0], $this->arrSize[0] / $objMM->getRatio());
				break;
				
			case MultimediaPlayer::SIZE_ADJUST_WIDTH:
				$arrSize = array($this->arrSize[1] * $objMM->getRatio(), $this->arrSize[1]);
				break;
		}
		
		$arrSize = self::sanitizeSize($arrSize);
		
		return $arrSize ? $arrSize : $this->arrSize;
	}
	
	public static function sanitizeSize($arrSize) {
		if(!$arrSize) {
			return null;
		}
		
		$arrSize = array_map('intval', array_slice(deserialize($arrSize, true), 0, 2));
		
		if($arrSize[0] > 0 && $arrSize[1] > 0) {
			return $arrSize;
		}
	}
	
	private static $blnAutoplayed;
	
	public static function getAutoplay($blnAutoplay) {
		if(!$blnAutoplay || self::$blnAutoplayed) {
			return false;
		} else {
			self::$blnAutoplayed = true;
			return true;
		}
	}
	
}
