<?php

class JWPlayerConfiguration extends System {
	
	public static function createByID($intID, $blnUncached = false) {
		$strMethod = $blnUncached ? 'executeUncached' : 'execute';
		
		$objConfig = Database::getInstance()->prepare(
			'SELECT * FROM tl_backboneit_video_jwplayer WHERE id = ?'
		)->$strMethod($intID);
		if(!$objConfig->numRows)
			return null;
			
		$arrConfig = $objConfig->row();
		
		$objPlugins = Database::getInstance()->prepare(
			'SELECT plugin, params FROM tl_backboneit_video_jwplayer_plugins WHERE pid = ?'
		)->$strMethod($intID);
		
		$arrConfig['plugins'] = $objPlugins->fetchAllAssoc();
		
		return new self($arrConfig);
	}
	
	protected $arrConfig;
	
	private $strPlayerPath;
	
	private $strEmbedderPath;
	
	private $blnYouTubePlayable;
	
	public function __construct($arrConfig) {
		parent::__construct();
	} 

	public function getPlayerPath($blnRecreate = false) {
		if(!isset($this->strPlayerPath)) {
			$strPath = $arrConfig['player'];
			
			if(is_dir(TL_ROOT . '/' . $strPath)) {
				$strPath = $strPath . '/player.swf';
				
			} elseif(!is_file(TL_ROOT . '/' . $strPath)) {
				
				
			} elseif(substr($strPath, -4) === '.zip') {
				$strTempPath = 'system/html/jwplayer-' . substr(md5($strPath), 0, 8);
			
				if($blnRecreate && is_dir(TL_ROOT . '/' . $strTempPath)) {
					$objTempDir = new Folder($strTempPath);
					$objTempDir->delete();
					unset($objTempDir);
				}
				
				if(!is_dir(TL_ROOT . '/' . $strTempPath)) {
					$arrFiles = array(
						'player.swf'	=> true,
						'yt.swf'		=> true,
						'jwplayer.js'	=> true
					);
					
					$objZip = new ZipReader($strPath);
					$objZip->first();
					do {
						$strFile = basename($objZip->file_name);
						if(isset($arrFiles[$strFile])) {
							$objFile = new File($strTempPath . '/' . $strFile);
							try {
								$objFile->write($objZip->unzip());
								unset($objFile); // finally statement missing in PHP...
							} catch(Exception $e) {
								unset($objFile); // finally statement missing in PHP...
								throw new Exception(sprintf('Error while unzipping JW Player from file.', $strFile));
							}
						}
					} while($objZip->next());
				}
				
				$strPath = $strTempPath . '/player.swf';
			}
	
			$this->strPlayerPath = $strPath && is_file(TL_ROOT . '/' . $strPath) ? $strPath : '';
		}
		
		if(!$this->strPlayerPath)
			throw new Exception('JW Player not available.');
			
		return $this->strPlayerPath;
	}
	
	public function getEmbedderPath() {
		if(!isset($this->strEmbedderPath)) {
			$strPath = dirname($this->getPlayerPath()) . '/jwplayer.js';
			$this->strEmbedderPath = $strPath && is_file(TL_ROOT . '/' . $strPath) ? $strPath : '';
		}
		
		if(!$this->strEmbedderPath)
			throw new Exception('JW Embedder not available.');
			
		return $this->strEmbedderPath;
	}
	
	public function isYouTubePlayable() {
		if(!isset($this->blnYouTubePlayable)) {
			try {
				$this->blnYouTubePlayable = is_file(TL_ROOT . '/' . dirname($this->getPlayerPath()) . '/yt.swf');
			} catch(Exception $e) {
				$this->blnYouTubePlayable = false;
			}
		}
			
		return $this->blnYouTubePlayable;
	}
	
}
