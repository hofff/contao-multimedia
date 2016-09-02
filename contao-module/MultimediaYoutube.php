<?php

class MultimediaYoutube extends AbstractMultimediaVideo {

	protected $strYoutubeID;

	public function __construct(array $arrData = null) {
		parent::__construct($arrData);

		$strYoutubeID = $this->arrData['youtube_source'];

		// parse ID from URL
		if(preg_match('@v[=/]([a-z0-9_-]+)(?:$|[^=])@i', $strYoutubeID, $arrMatches)) {
			$strYoutubeID = $arrMatches[1];
		}

		if(!preg_match('@^[a-z0-9_-]+$@i', $strYoutubeID)) {
			throw new Exception(sprintf('[%s] is not a valid YouTube ID', $this->arrData['youtube']));
		}

		$this->strYoutubeID = $strYoutubeID;
	}

	public function getSource() {
		return $this->arrData['youtube_source'];
	}

	public function isLocalSource() {
		return false;
	}

	public function getPreviewImage() {
		$strImage = parent::getPreviewImage();
		return $strImage ? $strImage : $this->getYoutubeImage();
	}

	public function getYoutubeID() {
		return $this->strYoutubeID;
	}

	public function getYoutubeLink() {
		return 'https://www.youtube.com/watch?v=' . $this->strYoutubeID;
	}

	public function getYoutubeImage() {
		return $this->arrData['youtube_image'];
	}

	public function loadYoutubeData($overwrite = false) {
		if(!$GLOBALS['TL_CONFIG']['bbit_mm_youtube_apikey']) {
			return;
		}

		$client = new \Google_Client;
		$client->setDeveloperKey($GLOBALS['TL_CONFIG']['bbit_mm_youtube_apikey']);

		$youtube = new \Google_Service_YouTube($client);

		$list = $youtube->videos->listVideos('snippet', array('id' => $this->strYoutubeID));
		if(!count($list)) {
			throw new \Exception(sprintf('No data for YouTube video with ID %s available', $this->strYoutubeID));
		}
		/* @var $video \Google_Service_YouTube_Video */
		$video = $list[0];

		if($overwrite || !strlen($this->arrData['title'])) {
			$this->arrData['title'] = $video->getSnippet()->getTitle();
		}
		if($overwrite || !strlen($this->arrData['description'])) {
			$this->arrData['description'] = $video->getSnippet()->getDescription();
		}
		if($overwrite || !strlen($this->arrData['youtube_image'])) {
			$this->arrData['youtube_image'] = $video->getSnippet()->getThumbnails()->getMaxres()->getUrl();
		}
	}

}
