<?php

abstract class MultimediaUtils {
	
	public static function fetchMIME($strURL, $intCache = 3600) {
		if($intCache) {
			$objReq = new RequestExtendedCached($intCache); // bugged see #2991 FIXED
		} else {
			$objReq = new RequestExtended();
		}
		$objReq->send($strURL, false, 'HEAD');
		
		if($objReq->hasError()) {
			throw new Exception(sprintf('Source request responded with error: [%s]', $objReq->error), $objReq->code);
		}
		
		list($strMIME) = explode(';', $objReq->getResponseHeader('Content-Type'), 2);
		return $strMIME ? $strMIME : 'application/octet-stream';
	}
	
}
