<?php

class MultimediaYoutube extends AbstractMultimedia {
	
	const NS_ATOM = 'http://www.w3.org/2005/Atom';
	const NS_MEDIA = 'http://search.yahoo.com/mrss/';
	const NS_GD = 'http://schemas.google.com/g/2005';
	const NS_YT = 'http://gdata.youtube.com/schemas/2007';
	
	protected $strYoutubeID;
	
	public function __construct(array $arrData = null) {
		parent::__construct($arrData);
		
		$strYoutubeID = $this->arrData['youtube'];
		
		// parse ID from URL
		if(preg_match('@v[=/]([a-z0-9_-]+)(?:$|[^=])@i', $strYoutubeID, $arrMatches)) {
			$strYoutubeID = $arrMatches[1];
		}
		
		if(!preg_match('@^[a-z0-9_-]+$@i', $strYoutubeID)) {
			throw new Exception(sprintf('[%s] is not a valid YouTube ID', $this->arrData['youtube']));
		}
		
		$this->strYoutubeID = $strYoutubeID;
	}
	
	public function getSource() {
		return $this->arrData['youtube'];
	}
	
	public function isLocalSource() {
		return false;
	}
	
	protected $strMIMEType = 'x-youtube/x-youtube';
	
	public function getMIMEType($blnBaseTypeOnly = false, $blnUncached = false) {
		return parent::getMIMEType($blnBaseTypeOnly);
	}
	
	public function getYoutubeID() {
		return $this->strYoutubeID;
	}
	
	public function getYoutubeLink() {
		return $this->arrData['youtubeLink'];
	}
	
	public function loadYoutubeData($blnOverwrite = false) {
		$strURL = 'http://gdata.youtube.com/feeds/api/videos/' . $this->strID . '?v=2';
		
		$objReq = new RequestExtendedCached(60 * 60);
		$objReq->send($strURL);
		if($objReq->hasError() || $objReq->response === '') {
			throw new Exception(sprintf('Failed to load Atom entry of youtube ID [%s]', $this->strYoutubeID));
		}
		
		$objDoc = new DOMDocument();
		if(!$objDoc->loadXML($objReq->response)) {
			throw new Exception(sprintf('Failed to parse Atom entry of youtube ID [%s]', $this->strYoutubeID));
		}
		
		$objXPath = new DOMXPath($objDoc);
		$objXPath->registerNamespace('atom', self::NS_ATOM);
		$objXPath->registerNamespace('media', self::NS_MEDIA);
		$objXPath->registerNamespace('gd', self::NS_GD);
		$objXPath->registerNamespace('yt', self::NS_YT);
		
		$this->arrData['title'] || $this->arrData['title'] = $this->fetchTitle($objXPath);
		$this->arrData['description'] || $this->arrData['description'] = $this->fetchDescription($objXPath);
		$this->arrData['image'] || $this->arrData['image'] = $this->fetchPreviewImage($objXPath);
		$this->arrData['youtubeLink'] = $this->fetchYoutubeLink($objXPath);
	}
	
	protected function fetchPreviewImage(DOMXPath $objXPath) {
		$objNodes = $this->getXPath()->evaluate('//media:thumbnail[not(@time)]/@url');
		return $objNodes->length ? $objNodes->item(0)->value : '';
	}
	
	protected function fetchTitle(DOMXPath $objXPath) {
		$objNodes = $this->getXPath()->evaluate('//atom:title/text()');
		return $objNodes->length ? $objNodes->item(0)->wholeText : '';
	}
	
	protected function fetchDescription(DOMXPath $objXPath) {
		$objNodes = $this->getXPath()->evaluate('//media:description/text()');
		return $objNodes->length ? $objNodes->item(0)->wholeText : '';
	}
	
	protected function fetchYoutubeLink(DOMXPath $objXPath) {
		$objNodes = $this->getXPath()->evaluate('//atom:link[@type = \'text/html\' and @rel = \'alternate\']/@href');
		return $objNodes->length ? $objNodes->item(0)->value : '';
	}

}
