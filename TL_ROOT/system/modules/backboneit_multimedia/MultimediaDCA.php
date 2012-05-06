<?php

class MultimediaDCA extends Backend {
	
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
	
	public function renderCaptionsButton($row, $href, $label, $title, $icon, $attributes) {
		if($row['captions_source'] != 'external') {
			return '';
		}
		
		try {
			$strClass = MultimediaFactory::getInstance()->getClass($row['type']);
		} catch(Exception $e) {
			return '';
		}
		
		$objClass = new ReflectionClass($strClass);
		if(!$objClass->isSubclassOf('MultimediaFeatureCaptions')) {
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
	
	public function saveExternalVideoSource($varValue, $objDC) {
		$arrSources = deserialize($varValue);
		$arrMIMEs = array_flip($GLOBALS['TL_DCA'][$objDC->table]['fields'][$objDC->field]['eval']['columnFields']['mime']['options']);
		
		foreach($arrSources as &$arrSource) {
			if($arrSource['mime']) {
				continue;
			}
			if(strncasecmp($arrSource['url'], 'http://', 7) === 0) {
// 				$objReq = new RequestExtendedCached(7 * 24 * 60 * 60); // bugged see #2991
				$objReq = new RequestExtended();
				$objReq->send($arrSource['url'], false, 'HEAD');
				if(!$objReq->hasError()) {
					list($strMIMEType) = explode(';', $objReq->headers['Content-Type'], 2);
					if(isset($arrMIMEs[$strMIMEType])) {
						$arrSource['mime'] = $strMIMEType;
						continue;
					}
				}
			}
			$blnMissingMIME = true;
		}
		
		if($blnMissingMIME && count($arrSources) > 1) {
			throw new Exception($GLOBALS['TL_LANG']['tl_bbit_mm']['errMIME']);
		}
		
		return $varValue;
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
