<?php

interface MultimediaFeatureCaptions extends Multimedia {

	function hasCaptions();

	function getCaptions();

	function getCaptionsCount();

	function isCaptionsEmbedded();

}
