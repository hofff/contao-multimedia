<?php

class Captions extends Controller {
	
	const TYPE_SRT	= 'application/x-subrip';
	const TYPE_TTML	= 'application/ttml+xml';
	
	public static function createByID($intID) {
		Database::getInstance()->prepare(
			'SELECT * FROM tl_'
		)->execute();
	}
	
// 	public static function createFromFile() {
		
// 	}
	
// 	public static function createFromString($strLabel, $strCaptions, $strType = TYPE_SRT) {
		
// 	}
	
	private $strLabel;
	
	private function __construct() {
		parent::__construct();
	}
	
	public function generate($strPlayer = null, array $arrPlayerConfig = null) {
		return '';
	}
	
	public function getPlayer($strPlayer = null, array $arrPlayerConfig = null) {
		$strClass = MultimediaFactory::getPlayerClass($strPlayer);
		
		$strClass::canPlay($strPlayer, $arrPlayerConfig);
		
		$strClass::create();
	}
	
	public static function getTypeFromFileExtension($strExtension) {
		switch($strExtension) {
			case 'srt':
				return self::TYPE_SRT;
				break;
				
			case 'ttml':
				return self::TYPE_TTML;
				break;
		}
	}
	
}
