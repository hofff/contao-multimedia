<?php

abstract class AbstractMultimediaVideo extends AbstractMultimedia implements MultimediaFeatureCaptions, MultimediaFeatureAudiodesc {

	public function __construct(array $arrData) {
		parent::__construct($arrData);
	}



	public function getRatio() {
		switch($this->arrData['ratio']) {
			case '4_3': return 4 / 3; break;
			case '16_9': return 16 / 9; break;
			default: return 0; break;
			case 'custom':
				$this->arrData['ratioCustom'] = deserialize($this->arrData['ratioCustom'], true);
				return max(0, $this->arrData['ratioCustom'][0] / $this->arrData['ratioCustom'][1]);
				break;
		}
		return null;
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
				$this->import('Database');

				$objResult = $this->Database->prepare(
					'SELECT * FROM tl_bbit_mm_captions WHERE pid = ?'
				)->execute($this->getID());

				while($objResult->next()) {
					$arrCaptions[$objResult->title] = $objResult->source == 'local'
						? $objResult->local
						: $objResult->external;
				}

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
