<?php

interface MultimediaVideoSource extends Serializable {
	
	public function getType();
	
	public function getURL();
	
	public function isValid();
	
	public function validate();
	
}
