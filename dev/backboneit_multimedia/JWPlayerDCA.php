<?php

class JWPlayerDCA extends Backend {
	
	protected function __construct() {
		parent::__construct();
	}
	
	public function unpackPlayer($strPath) {
		if(!is_file(TL_ROOT . '/' . $strPath) || substr($strPath, -4) !== '.zip')
			return $strPath;
		
		$strTempDir = JWPlayerUtils::unzipPlayer($strPath);
		
		if(!is_file(TL_ROOT . '/' . $strTempDir . '/player.swf')
		|| !is_file(TL_ROOT . '/' . $strTempDir . '/jwplayer.js'))
			throw new Exception($GLOBALS['TL_LANG']['tl_backboneit_video_jwplayer']['unpackError']);
		
		return $strPath;
	}
	
	public function validateURL($strURL) {
		//if(http_build_url($strURL))
			return $strURL;
		//throw new Exception(sprintf($GLOBALS['TL_LANG']['tl_backboneit_video_jwplayer']['urlError'], $strURL));
	}
	
	public function validateColor($strColor) {
		if(!$strColor)
			return $strColor;
		if(!preg_match('/^([0-9a-f]{3})([0-9a-f]{3})?$/', strtolower($strColor), $arrGroups))
			throw new Exception(sprintf($GLOBALS['TL_LANG']['tl_backboneit_video_jwplayer']['colorError'], $strColor));
		if(!$arrGroups[2])
			return preg_replace('/(.)/', '$1$1', $strColor);
			
		return $strColor;
	}
	
	public function validateSize($strSize) {
		$arrSize = deserialize($strSize, true);
		
		if($arrSize[0] == '' && $arrSize[1] == '')
			return;
			
		if(!preg_match('/^[0-9]*$/', $arrSize[0])
		|| !preg_match('/^[0-9]*$/', $arrSize[1]))
			throw new Exception($GLOBALS['TL_LANG']['tl_backboneit_video_jwplayer']['sizeError']);
		
		return $strSize;
	}
	
	public function pagePicker(DataContainer $objDC) {
		$strField = 'ctrl_' . $objDC->inputName;
		return ' ' . $this->generateImage('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top; cursor:pointer;" onclick="Backend.pickPage(\'' . $strField . '\')"');
	}
	
	public function getJWPlayers() {
		$objResult = $this->Database->execute(
			'SELECT id, title FROM tl_backboneit_video_jwplayer ORDER BY title'
		);
		
		$arrOptions = array();
		while($objResult->next())
			$arrOptions[$objResult->id] = $objResult->title;
			
		return $arrOptions;
	}

	public function getEditJWPlayerWizard(DataContainer $objDC) {
		if($objDC->value < 1)
			return '';
			
		$objResult = $this->Database->prepare(
			'SELECT title FROM tl_backboneit_video_jwplayer WHERE id = ?'
		)->execute($objDC->value);
		if(!$objResult->numRows)
			return '';
		
		$strTitle = sprintf(specialchars($GLOBALS['TL_LANG'][$objDC->strTable]['backboneit_video_editJWPlayerWizard']), $objResult->title, $objDC->value);
		return sprintf(
			' <a href="contao/main.php?do=backboneit_video_jwplayer&amp;table=tl_backboneit_video_jwplayer&amp;act=edit&amp;id=%s" title="%s" style="padding-left:3px;">%s</a>',
			$objDC->value,
			$strTitle,
			$this->generateImage('alias.gif', $strTitle, 'style="vertical-align:top;"')
		);
	}
	
	private static $objInstance;
	
	public static function getInstance() {
		if(!isset(self::$objInstance))
			self::$objInstance = new self();
		return self::$objInstance;
	}
	
}
