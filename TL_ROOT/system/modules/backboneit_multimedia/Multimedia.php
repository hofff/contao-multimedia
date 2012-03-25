<?php

interface Multimedia {
	
	function generate(array $arrConfig = null, $strPlayer = null);
	
	function getData();
	
	function getSize();
	
	function getSource();
	
	function getMIMEType();
	
	function getID();
	
	function getTitle();
	
	function getDescription();
	
	function getPreviewImage();
	
}
