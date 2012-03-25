<?php

interface VideoPlayer {
	
	const FEATURE_SUBTITLE = 'subtitle';
	const FEATURE_SIGN_LANGUAGE = 'signLanguage';
	const FEATURE_AUDIO_DESCRIPTION = 'audioDescription';
	const FEATURE_HTML5 = 'html5';
	const FEATURE_FLASH = 'flash';
	const FEATURE_PLAYLISTS = 'playlists';
	
	public function embedPlaylist(VideoPlaylist $objPlaylist);
	
	public function embedVideo(Video $objVideo);
	
	public function canPlay(Video $objVideo);
	
	public function getPlayableTypes();
	
	public function setConfig(array $arrConfig);
	
	public function getConfig();
	
	public function getFeatures();
	
	public function hasFeature($strFeature);
	
}
