<?php

class YouTubeVideo extends System {

	const NS_ATOM = 'http://www.w3.org/2005/Atom';
	const NS_PREFIX_ATOM = 'atom';
	const NS_MEDIA = 'http://search.yahoo.com/mrss/';
	const NS_PREFIX_MEDIA = 'media';
	const NS_GD = 'http://schemas.google.com/g/2005';
	const NS_PREFIX_GD = 'gd';
	const NS_YT = 'http://gdata.youtube.com/schemas/2007';
	const NS_PREFIX_YT = 'yt';

	private static $arrVideos = array();

	public static function create($strID) {
		$objVideo = self::createByURL($strID);
		if($objVideo)
			return $objVideo;
		return self::createByID($strID);
	}

	public static function createByURL($strURL) {
		if(!preg_match('@^http://(?>[^/]+)(?<=youtube\.com)/.*v[=/]([a-z0-9_-]+)(?:$|[^=])@i', $strURL, $arrMatches))
			return;

		return self::createByID($arrMatches[1]);
	}

	public static function createByID($strID) {
		if(!preg_match('@^[A-Za-z0-9_-]+$@', $strID))
			return;

		if(!isset(self::$arrVideos[$strID]))
			self::$arrVideos[$strID] = new self($strID);

		return self::$arrVideos[$strID];
	}

	private $strID;

	private $objDoc = true;

	private $objXPath;

	protected $arrCache = array();

	protected function __construct($strID) {
		parent::__construct();

		if(!is_string($strID) || strlen($strID) < 1)
			throw new Exception('[IllegalArgumentException]');

		$this->strID = $strID;
	}

	public function __get($strKey) {
		switch($strKey) {
			case 'id':
				return $this->strID;
				break;
		}
	}

	public function getDocument() {
		if($this->objDoc === true)
			$this->loadDocument();

		if($this->objDoc === null)
			throw new Exception('Could not load video data from YouTube API for video [' . $this->strID . '].');

		return $this->objDoc;
	}

	private function loadDocument() {
		$objReq = new Request();
		if($objReq->send('http://gdata.youtube.com/feeds/api/videos/' . $this->strID . '?v=2')->error
		|| $objReq->response === '')
			return $this->objDoc = null;

		$this->objDoc = new DOMDocument();
		if(!$this->objDoc->loadXML($objReq->response))
			return $this->objDoc = null;

		return $this->objDoc;
	}

	public function getXPath() {
		if(isset($this->objXPath))
			return $this->objXPath;

		$this->objXPath = new DOMXPath($this->getDocument());
		$this->objXPath->registerNamespace(self::NS_PREFIX_ATOM, self::NS_ATOM);
		$this->objXPath->registerNamespace(self::NS_PREFIX_MEDIA, self::NS_MEDIA);
		$this->objXPath->registerNamespace(self::NS_PREFIX_GD, self::NS_GD);
		$this->objXPath->registerNamespace(self::NS_PREFIX_YT, self::NS_YT);
		return $this->objXPath;
	}


	public function getThumbnail() {
		if(isset($this->arrCache['thumbnail']))
			return $this->arrCache['thumbnail'];

		$objNodes = $this->getXPath()->evaluate('//media:thumbnail[not(@time)]/@url');

		return $this->arrCache['thumbnail'] = $objNodes->length ? $objNodes->item(0)->value : '';
	}

	public function getTitle() {
		if(isset($this->arrCache['title']))
			return $this->arrCache['title'];

		$objNodes = $this->getXPath()->evaluate('//atom:title/text()');

		return $this->arrCache['title'] = $objNodes->length ? $objNodes->item(0)->wholeText : '';
	}

	public function getLink() {
		if(isset($this->arrCache['link']))
			return $this->arrCache['link'];

		$objNodes = $this->getXPath()->evaluate('//atom:link[@type = \'text/html\' and @rel = \'alternate\']/@href');

		return $this->arrCache['link'] = $objNodes->length ? $objNodes->item(0)->value : '';
	}

}
