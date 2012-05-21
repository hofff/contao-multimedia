<?php

class MultimediaDCA extends Backend {
	
	public function renderCaptionsButton($row, $href, $label, $title, $icon, $attributes) {
		$objMM = MultimediaFactory::getInstance()->create($row);
		
		if(!($objMM instanceof MultimediaFeatureCaptions)) {
			return '';
		}
		if($objMM->isCaptionsEmbedded()) {
			return '';
		}
		
		return sprintf(
			'<a href="%s" title="%s"%s>%s</a> ',
			$this->addToUrl($href . '&id=' . $row['id']),
			$title,
			$attributes,
			$label
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
				'youtube_source' => $objMM->getYoutubeLink(),
				'youtube_image' => $objMM->getYoutubeImage()
			))->execute($objDC->id);
			
		} catch(Exception $e) {
			$objDC->addError($e->getMessage(), 'youtube_source');
		}
	}
	
	public function submitVideo($objDC) {
		$objMM = $this->getMultimedia($objDC);
		if(!($objMM instanceof MultimediaVideoHTTP)) {
			return;
		}
		
		if(!$objMM->getSource()) {
			$objDC->addError($GLOBALS['TL_LANG']['tl_bbit_mm']['errNoSource']);
			return;
		}
		
		$arrInvalid = $objMM->validateSources();
		if($arrInvalid) {
			$arrError = array();
			foreach($arrInvalid as $arrSource) {
				$arrError[] = $arrSource['url'];
			}
			$GLOBALS['TL_INFO'][] = sprintf(
				$GLOBALS['TL_LANG']['tl_bbit_mm']['warnInvalidSources'],
				implode(',', $arrError)
			);
			return;
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
	
	public function loadVideoSourcesExternal($varValue, $objDC) {
		$arrSources = array();
		foreach($this->getMultimedia($objDC)->getSourceByClass('MultimediaVideoHTTPSource') as $objSource) {
			$arrSources[] = $objSource->getURL();
		}
		return $arrSources;
	}
	
	public function saveVideoSourcesLocal($varValue, $objDC) {
		$arrSources = array();
		foreach(deserialize($varValue, true) as $strURL) {
			$arrSources[] = new MultimediaVideoLocalSource($strURL);
		}
		$this->getMultimedia($objDC)->replaceSourceByClass($arrSources);
		return null;
	}
	
	public function saveVideoSourcesExternal($varValue, $objDC) {
		$arrSources = array();
		foreach(deserialize($varValue, true) as $arrSource) {
			strlen($arrSource['url']) && $arrSources[] = new MultimediaVideoHTTPSource($arrSource['url']);
		}
		$this->getMultimedia($objDC)->replaceSourceByClass($arrSources);
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
