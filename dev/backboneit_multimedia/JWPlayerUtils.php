<?php

class JWPlayerUtils {
	
	public static function addToTemplate(Template $objTemplate, array $arrData = null) {
		if($arrData === null)
			$arrData = $objTemplate->getData();
			
		if($arrData['backboneit_jwplayer_addvideo']) {
			$objJWPlayer = new JWPlayer($arrData);
			$objTemplate->jwplayer = $objJWPlayer->parse(); 
			$objTemplate->jwplayerAddBefore = $arrData['backboneit_jwplayer_previewfloating'] != 'below';
		}
	}
	
	public static function isPlayable($strURL) {
		$objVideo = YouTubeVideo::create($strURL);
		if($objVideo) {
			try {
				return $objVideo->getDocument() ? true : false;
			} catch(Exception $e) {
				return false;
			}
		}
			
		$objReq = new Request();
		$objReq->method = 'HEAD';
		$objReq->send($strURL);
		
		if($objReq->hasError())
			return false;
			
		foreach($objReq->headers as $strHeader => $strValue) {
			if(strcasecmp('Content-type', $strHeader) === 0) {
				$strValue = trim($strValue);
				if(strncasecmp($strValue, 'video/', 6) === 0
				|| strncasecmp($strValue, 'audio/', 6) === 0
				|| strncasecmp($strValue, 'image/', 6) === 0)
					return true;				
			}
		}
		return false;
	}
	
	public static function fetchImage($strURL, $blnUncached = false) {
		$strFile = 'system/html/' . md5($strURL);
		
		if(!$blnUncached) {
			if(is_file(TL_ROOT . '/' . $strFile . '.jpg'))
				return $strFile . '.jpg';
			if(is_file(TL_ROOT . '/' . $strFile . '.gif'))
				return $strFile . '.gif';
			if(is_file(TL_ROOT . '/' . $strFile . '.png'))
				return $strFile . '.png';
		}
		
		$objReq = new Request();
		$objReq->send($strURL);
		
		if($objReq->hasError())
			return;
			
		foreach($objReq->headers as $strHeader => $strValue) {
			if(strcasecmp('Content-type', $strHeader) === 0) {
				switch(strtolower(trim($strValue))) {
					case 'image/jpeg':	$strFile .= '.jpg'; break;
					case 'image/gif':	$strFile .= '.gif'; break;
					case 'image/png':	$strFile .= '.png'; break;
					default:			return; break;
				}
				break;
			}
		}
		
		if(is_file(TL_ROOT . '/' . $strFile)) {
			$objFile = new File($strFile);
			$objFile->delete();
			unset($objFile);
		}
		
		$objFile = new File($strFile);
		$objFile->write($objReq->response);
		unset($objFile);
		
		return $strFile;
	}
	
	public static function isDownloadExtensionActive() {
		if(!isset(self::$arrCache['backboneit_download']))
			self::$arrCache['backboneit_download'] = in_array('backboneit_download', Config::getInstance()->getActiveModules());
			
		return self::$arrCache['backboneit_download'];
	}
	
	protected static $arrCache;
	
	protected function __construct() {
	}
	
}
