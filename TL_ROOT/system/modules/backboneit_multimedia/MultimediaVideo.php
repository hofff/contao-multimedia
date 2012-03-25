<?php

class MultimediaVideo extends AbstractMultimedia implements MultimediaFeatureCaptions, MultimediaFeatureAudiodesc {
	
	public function __construct(array $arrData) {
		parent::__construct($arrData);
	}
	
	
	
	public function getSize() {
		return $this->arrData['size'] ? deserialize($this->arrData['size'], true) : null;
	}
	
	public function getSource() {
		return $this->isLocalSource() ? $this->arrData['video_local'] : $this->arrData['video_external'];
	}
	
	public function isLocalSource() {
		return $this->arrData['video_source'] == 'local';
	}
	
	
	
	public function hasCaptions() {
		return $this->arrData['captions_source'] != '';
	}
	
	public function getCaptions() {
		$this->buildCaptions();
		return $this->arrCaptions;
	}
	
	public function getCaptionsCount() {
		$this->buildCaptions();
		return $this->arrCaptions ? count($this->arrCaptions) : null;
	}
	
	public function isCaptionsEmbedded() {
		return $this->arrData['captions_source'] == 'video';
	}
	
	protected $arrCaptions;
	
	protected function buildCaptions() {
		if(isset($this->arrCaptions)) {
			return;
		}
		if(!$this->hasCaptions()) {
			return;
		}
		
		$arrCaptions = array();
		
		switch($this->arrData['captions_source']) {
			case 'video':
				foreach(deserialize($this->arrData['captions_labels'], true) as $arrLabel) {
					$arrCaptions[$arrLabel['label']] = true;
				}
				break;
		
			case 'external':
				break;
		}
		
		$this->arrCaptions = $arrCaptions;
	}
	
	
	
	public function hasAudiodesc() {
		return $this->arrData['audiodesc_source'] != '';
	}
	
	public function getAudiodesc() {
		return $this->hasAudiodesc()
			? $this->arrData['audiodesc_source'] == 'local'
				? $this->arrData['audiodesc_local']
				: $this->arrData['audiodesc_external']
			: null;
	}
	
	public function getAudiodescVolume() {
		return $this->arrData['audiodesc_volume'];
	}
	
}
