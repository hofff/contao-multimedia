<?php

class MultimediaVimeo extends AbstractMultimediaVideo {

	protected $vimeoID;

	public function __construct(array $data = null) {
		parent::__construct($data);

		$vimeoID = $this->arrData['vimeo_source'];

		// parse ID from URL
		$matches = null;
		if(preg_match('@/([0-9]+)(?:$|[^=])@i', $vimeoID, $matches)) {
			$vimeoID = $matches[1];
		}

		if(!preg_match('@^[0-9]+$@i', $vimeoID)) {
			throw new Exception(sprintf('[%s] is not a valid Vimeo ID', $this->arrData['vimeo_source']));
		}

		$this->vimeoID = $vimeoID;
	}

	public function getSource() {
		return $this->arrData['vimeo_source'];
	}

	public function isLocalSource() {
		return false;
	}

	public function getVimeoID() {
		return $this->vimeoID;
	}

	public function getVimeoLink() {
		return 'https://vimeo.com/' . $this->vimeoID;
	}

}
