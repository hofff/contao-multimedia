<?php

interface MultimediaVideoSource extends Serializable {

	public function getType();

	public function getURL();

	public function isValid($blnCached = true);

	public function validate($blnCached = true);

	public function getBitrate();

	public function getWidth();

}
