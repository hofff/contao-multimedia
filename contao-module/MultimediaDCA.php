<?php

class MultimediaDCA extends Backend {

	public function renderCaptionsButton($row, $href, $label, $title, $icon, $attributes) {
		$objMM = MultimediaFactory::getInstance()->create($row);

		if(!is_a($objMM, 'MultimediaFeatureCaptions')) {
			return '';
		}
		if(!$objMM->hasCaptions() || $objMM->isCaptionsEmbedded()) {
			return '';
		}

		return sprintf(
			'<a href="%s" title="%s"%s>%s</a> ',
			$this->addToUrl($href . '&id=' . $row['id']),
			$title,
			$attributes,
			$this->generateImage($icon, $label)
		);
	}

	public function renderCaptionsRecord($arrRow) {
		return $arrRow['title'];
	}

	public function submitYoutube($objDC) {
		if($objDC->activeRecord->type != 'youtube') {
			return;
		}

		try {
			$objMM = new MultimediaYoutube($objDC->activeRecord->row());
			$objMM->loadYoutubeData();
			$this->Database->prepare(
				'UPDATE tl_bbit_mm %s WHERE id = ?'
			)->set(array(
				'title' => $objMM->getTitle(),
				'description' => $objMM->getDescription(),
				'youtube_image' => $objMM->getYoutubeImage()
			))->execute($objDC->id);

		} catch(Exception $e) {
			$this->addErrorMessage($e->getMessage());
		}
	}

	public function submitVimeo($objDC) {
		if($objDC->activeRecord->type != 'vimeo') {
			return;
		}

		try {
			new MultimediaVimeo($objDC->activeRecord->row());

		} catch(Exception $e) {
			$this->addErrorMessage($e->getMessage());
		}
	}

	private $sources;

	private $localSourcesSaved;

	public function submitVideo($objDC) {
		$objMM = $this->getMultimedia($objDC);
		if(!($objMM instanceof MultimediaVideo)) {
			return;
		}

		$sources = (array) $this->sources[$objDC->id];
		if(!$this->localSourcesSaved[$objDC->id]) {
			$sources = array_merge($sources, $objMM->getSourceByClass('MultimediaVideoLocalSource'));
		}
		$objMM->setSource($sources);

		if(!$objMM->getSource()) {
			$this->addErrorMessage($GLOBALS['TL_LANG']['tl_bbit_mm']['errNoSource']);
			return;
		}

		$arrInvalid = $objMM->validateSource(false);
		if($arrInvalid) {
			$arrError = array();
			foreach($arrInvalid as $objSource) {
				$arrError[] = $objSource->getURL();
			}
			$_SESSION['TL_INFO'][] = sprintf(
				$GLOBALS['TL_LANG']['tl_bbit_mm']['warnInvalidSources'],
				implode('<br />', $arrError)
			);
		}

		$this->Database->prepare(
			'UPDATE tl_bbit_mm %s WHERE id = ?'
		)->set(array(
			'video_source' => $objMM->getSource(),
		))->execute($objDC->id);
	}

	public function loadVideoSourcesLocal($varValue, $objDC) {
		$arrSources = array();
		foreach($this->getMultimedia($objDC)->getSourceByClass('MultimediaVideoLocalSource') as $objSource) {
			$arrSources[] = $objSource->getLocalPath();
		}
		return $arrSources;
	}

	public function saveVideoSourcesLocal($varValue, $objDC) {
		$arrSources = array();
		foreach(deserialize($varValue, true) as $strURL) {
			$this->sources[$objDC->id][] = new MultimediaVideoLocalSource($strURL);
		}
		$this->localSourcesSaved[$objDC->id] = true;
		return null;
	}

	public function loadVideoSourcesExternal($varValue, $objDC) {
		$arrSources = array();
		foreach($this->getMultimedia($objDC)->getSourceByClass('MultimediaVideoHTTPSource') as $objSource) {
			$arrSources[] = array('url' => $objSource->getURL());
		}
		return $arrSources;
	}

	public function saveVideoSourcesExternal($varValue, $objDC) {
		$arrSources = array();
		foreach(deserialize($varValue, true) as $arrSource) if(strlen($arrSource['url'])) {
			$this->sources[$objDC->id][] = new MultimediaVideoHTTPSource($arrSource['url']);
		}
		return null;
	}

	public function loadVideoSourcesExternalStream($varValue, $objDC) {
		$arrSources = array();
		foreach($this->getMultimedia($objDC)->getSourceByClass('MultimediaVideoHTTPStreamSource') as $objSource) {
			$arrSources[] = array(
				'url'			=> $objSource->getURL(),
				'startparam'	=> $objSource->getStartParam(),
				'bitrate'		=> $objSource->getBitrate(),
				'width'			=> $objSource->getWidth(),
			);
		}
		return $arrSources;
	}

	public function saveVideoSourcesExternalStream($varValue, $objDC) {
		$arrSources = array();
		foreach(deserialize($varValue, true) as $arrSource) if(strlen($arrSource['url'])) {
			$startparam = strlen($arrSource['startparam']) ? $arrSource['startparam'] : 'start';
			$objSource = new MultimediaVideoHTTPStreamSource($arrSource['url'], $startparam);
			$objSource->setBitrate($arrSource['bitrate']);
			$objSource->setWidth($arrSource['width']);
			$this->sources[$objDC->id][] = $objSource;
		}
		return null;
	}

	public function loadVideoSourcesRTMP($varValue, $objDC) {
		$arrSources = array();
		foreach($this->getMultimedia($objDC)->getSourceByClass('MultimediaVideoRTMPSource') as $objSource) {
			$arrSources[] = array(
				'streamer'		=> $objSource->getStreamer(),
				'url'			=> $objSource->getFile(),
				'bitrate'		=> $objSource->getBitrate(),
				'width'			=> $objSource->getWidth(),
			);
		}
		return $arrSources;
	}

	public function saveVideoSourcesRTMP($varValue, $objDC) {
		$arrSources = array();
		foreach(deserialize($varValue, true) as $arrSource) if(strlen($arrSource['url'])) {
			$objSource = new MultimediaVideoRTMPSource($arrSource['streamer'], $arrSource['url']);
			$objSource->setBitrate($arrSource['bitrate']);
			$objSource->setWidth($arrSource['width']);
			$this->sources[$objDC->id][] = $objSource;
		}
		return null;
	}

	public function loadVideoSourcesSMIL($varValue, $objDC) {
		$arrSources = array();
		foreach($this->getMultimedia($objDC)->getSourceByClass('MultimediaVideoSMILSource') as $objSource) {
			$arrSources[] = array('url' => $objSource->getURL());
		}
		return $arrSources;
	}

	public function saveVideoSourcesSMIL($varValue, $objDC) {
		$arrSources = array();
		foreach(deserialize($varValue, true) as $arrSource) if(strlen($arrSource['url'])) {
			$this->sources[$objDC->id][] = new MultimediaVideoSMILSource($arrSource['url']);
		}
		return null;
	}

	public function saveURL($strURL) {
		//if(http_build_url($strURL))
		return $strURL;
		//throw new Exception(sprintf($GLOBALS['TL_LANG']['tl_backboneit_video_jwplayer']['urlError'], $strURL));
	}

	public function saveSize($strSize, $objDC) {
		$arrSize = deserialize($strSize, true);
		$arrSize = array_map('trim', $arrSize);

		if(!$GLOBALS['TL_DCA'][$objDC->table]['fields'][$objDC->field]['eval']['mandatory']
		&& !array_filter($arrSize, 'strlen')) {
			return;
		}

		if(!preg_match('/^[0-9]*$/', $arrSize[0])
		|| !preg_match('/^[0-9]*$/', $arrSize[1])) {
			throw new Exception($GLOBALS['TL_LANG']['tl_bbit_mm']['errSize']);
		}

		return $strSize;
	}

	public function getEditMediaWizard(DataContainer $objDC) {
		if($objDC->value < 1) {
			return '';
		}

		$objResult = $this->Database->prepare(
			'SELECT title FROM tl_bbit_mm WHERE id = ?'
		)->execute($objDC->value);

		if(!$objResult->numRows) {
			return '';
		}

		$strTitle = $GLOBALS['TL_LANG']['bbit_mm']['editMediaWizard'];

		return sprintf(
			' <a href="contao/main.php?do=bbit_mm&amp;table=tl_bbit_mm&amp;act=edit&amp;id=%s" title="%s" style="padding-left:3px;">%s</a>',
			$objDC->value,
			specialchars(sprintf($strTitle, $objResult->title, $objDC->value)),
			$this->generateImage('alias.gif', $strTitle, 'style="vertical-align:top;"')
		);
	}

	private $arrMultimedia = array();

	public function getMultimedia($objDC) {
		if(!isset($this->arrMultimedia[$objDC->id])) {
			$this->arrMultimedia[$objDC->id] = MultimediaFactory::getInstance()->create($objDC->activeRecord->row());
		}
		return $this->arrMultimedia[$objDC->id];
	}

	protected function __construct() {
		parent::__construct();
	}

	private static $objInstance;

	public static function getInstance() {
		if(!isset(self::$objInstance)) {
			self::$objInstance = new self();
		}
		return self::$objInstance;
	}

}
