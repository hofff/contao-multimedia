<?php

class MultimediaVideoRTMPSource extends AbstractMultimediaVideoSource {
	
	protected $strStreamer;
	
	public function __construct($strStreamer, $strFile) {
		$strFile = ltrim($strFile, '/ ');
		parent::__construct($strFile, 'rtmp');
		$this->setStreamer($strStreamer);
	}
	
	public function serialize() {
		return serialize(array(
			parent::serialize(),
			$this->strStreamer,
		));
	}
	
	public function unserialize($strSerialized) {
		list(
			$strParent,
			$this->strStreamer,
		) = unserialize($strSerialized);
		parent::unserialize($strParent);
	}
	
	public function getURL() {
		return $this->getStreamer() . $this->getFile();
	}
	
	public function validate($blnCached = true) {
		$strStreamer = $this->getStreamer();
		if(0 !== strncmp($strStreamer, 'rtmp://', 7)) {
			throw new Exception(sprintf('[%s] is not an RTMP source', $strStreamer));
		}
	}
	
	public function getStreamer() {
		return $this->strStreamer;
	}
	
	public function setStreamer($strStreamer) {
		$this->strStreamer = rtrim($strStreamer, '/ ') . '/';
	}
	
	public function getFile() {
		return parent::getURL();
	}
	
}
