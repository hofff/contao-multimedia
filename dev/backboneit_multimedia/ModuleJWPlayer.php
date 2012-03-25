<?php

class ModuleJWPlayer extends Module {
	
	protected $strTemplate = 'mod_jwplayer';
	
	public function generate() {
		
		if(TL_MODE == 'BE') {
			$this->loadLanguageFile('backboneit_jwplayer');
			
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### JW-Player ### '
					. $GLOBALS['TL_LANG']['backboneit_jwplayer']['backboneit_jwplayer_types'][$this->backboneit_jwplayer_type] . ': '
					. ($this->backboneit_jwplayer_type == 'local' ? $this->backboneit_jwplayer_local : $this->backboneit_jwplayer_url);
			if(!JWPlayerUtils::getPlayerPath())
				$objTemplate->headline = $GLOBALS['TL_LANG']['backboneit_jwplayer']['noplayer'];
			$objTemplate->id = $this->id;

			return $objTemplate->parse();
		}
		
		if(!JWPlayerUtils::getPlayerPath())
			return '';
		
		return parent::generate();
	}

	protected function compile() {
		$objJWPlayer = new JWPlayer($this->arrData);
		$this->Template->jwplayer = $objJWPlayer->parse();
	}
	
}
