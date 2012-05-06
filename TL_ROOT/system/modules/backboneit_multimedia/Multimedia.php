<?php

interface Multimedia {
	
	function generate(array $arrConfig = null, $strPlayer = null);
	
	function getData();
	
	function getSource();
	
	function getID();
	
	function getTitle();
	
	function getDescription();
	
	function getPreviewImage();
	
}
