<?php

class MultimediaDCA extends Backend {
	
	public function getCaptionsButton($row, $href, $label, $title, $icon, $attributes) {
		try {
			$strClass = MultimediaFactory::getInstance()->getClass($row['type']);
		} catch(Exception $e) {
			return '';
		}
		
		$blnHasCaptions = is_subclass_of($strClass, 'MultimediaFeatureCaptions');
		if(!$blnHasCaptions || $row['captions_source'] != 'external') {
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
	
	public function getCaptionsRecord($arrRow) {
		return $arrRow['title'];
	}
	
	public function validateURL($strURL) {
		//if(http_build_url($strURL))
		return $strURL;
		//throw new Exception(sprintf($GLOBALS['TL_LANG']['tl_backboneit_video_jwplayer']['urlError'], $strURL));
	}
	
	public function validateSize($strSize, $objDC) {
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
