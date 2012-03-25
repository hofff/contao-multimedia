<?php

class ContentMultimedia extends ContentElement {
	
	protected $strTemplate = 'ce_multimedia';
	
	protected $objMM;
	
	public function generate() {
		$this->objMM = MultimediaFactory::getInstance()->createByID($this->bbit_mm_media);
		
		if(!$this->objMM) {
			return '';
		}
		
		if(TL_MODE == 'BE') {
			return $this->objMM->generate($this->arrData);
		}
		
		return parent::generate();
	}

	protected function compile() {
		$this->Template->multimedia = $this->objMM->generate($this->arrData);
	}
	
}
