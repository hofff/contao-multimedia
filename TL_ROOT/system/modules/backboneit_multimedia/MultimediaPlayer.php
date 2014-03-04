<?php

interface MultimediaPlayer {

	static function create(array $arrData = null);

	static function canPlay(Multimedia $objMM);


	function embed(Multimedia $objMM);


	const SIZE_PLAYER = 'bbit_mm_player';

	const SIZE_ADJUST_WIDTH = 'bbit_mm_adjustWidth';

	const SIZE_ADJUST_HEIGHT = 'bbit_mm_adjustHeight';

	function setSizeMode($strMode);

	function getSizeMode();

	function setSize($arrSize);

	function getSize();

	function getSizeFor(Multimedia $objMM);

}
