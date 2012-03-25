<?php

class MultimediaStreamRTMP extends AbstractMultimedia {
	
	public function __construct(array $arrData = null) {
		parent::__construct($arrData);
	}
	
	public function getSource() {
		return $this->arrData['rtmp_external'];
	}
	
	public function isLocalSource() {
		return false;
	}
	
	public function getStreamer() {
		if($this->arrData['rtmp_streamer']) {
			return $this->arrData['rtmp_streamer'];
		} else {
			list($strURL, $strQuery) = explode('?', $this->getSource(), 2);
			return $strURL;
		}
	}
	
	public function isLoadbalanced() {
		return $this->arrData['rtmp_loadbalanced'] ? true : false;
	}
	
	public function isDVRStream() {
		return $this->arrData['rtmp_dvr'] ? true : false;
	}
	
	public function isSubscriptionStream() {
		return $this->arrData['rtmp_subscription'] ? true : false;
	}

}
