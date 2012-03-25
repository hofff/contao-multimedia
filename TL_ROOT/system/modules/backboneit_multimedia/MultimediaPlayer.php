<?php

interface MultimediaPlayer {
	
	static function create(array $arrData = null);
	
	static function canPlay(Multimedia $objMM);
	
	
	function embed(Multimedia $objMM);
	
	
	const SIZE_PLAYER = 'player';
	
	const SIZE_ADJUST_WIDTH = 'adjustWidth';
	
	const SIZE_ADJUST_HEIGHT = 'adjustHeight';
	
	const SIZE_MEDIA = 'media';
	
	function setSizeMode($strMode);
	
	function getSizeMode();
	
	function setSize($arrSize);
	
	function getSize();
	
	function getSizeFor(Multimedia $objMM);
	
}
