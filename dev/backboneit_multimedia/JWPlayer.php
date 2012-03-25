<?php

class JWPlayer extends Template {

	const DEFAULT_START_PARAM = 'start';
	
	protected static $blnAutoplayed;
	
	public function __construct(array $arrData) {
		parent::__construct('backboneit_jwplayer');
		
		$this->setData($arrData);
	}
	
	public function setData($arrData) {
		if(!is_array($arrData))
			return;
			
		if($arrData['backboneit_jwplayer_player']) {
			foreach(JWPlayerUtils::getGlobalConfig() as $strOption => $varValue)
				if(is_empty($arrData[$strOption]))
					$arrData[$strOption] = $varValue;
					
		} else {
			$strPreview = $arrData['backboneit_jwplayer_preview'];
			
			foreach(JWPlayerUtils::getGlobalConfig() as $strOption => $varValue)
				$arrData[$strOption] = $varValue;
				
			if(!is_empty($strPreview))
				$arrData['backboneit_jwplayer_preview'] = $strPreview;
		}
		
		$this->arrData = $arrData;
	}
	
	public function parse() {
		if(!JWPlayerUtils::getPlayerPath() || !JWPlayerUtils::getEmbedderPath()) {
			$this->log('Error while creating JWPlayer. Missing player file.', 'JWPlayer::parse()', TL_ERROR);
			return '';
		}
		
		try {
			$this->compile();
		} catch(Exception $e) {
			$this->log($e->getMessage(), 'JWPlayer::parse()', TL_ERROR);
			return '';
		}
			
		$this->setAutoplay();

		$GLOBALS['TL_CSS'][] = 'system/modules/backboneit_jwplayer/css/jwplayer.css';
		$GLOBALS['TL_JAVASCRIPT'][] = JWPlayerUtils::getEmbedderPath();
		if($this->backboneit_jwplayer_mediabox)
			$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/backboneit_jwplayer/js/mbjwplayer.js';
			
		return parent::parse();
	}
	
	protected function compile() {
		$this->id = 'jwplayer' . str_replace('.', '', microtime(true));
		$this->backboneit_jwplayer_preview = $this->getPreviewImage();
		
		$arrSize = deserialize($this->backboneit_jwplayer_size);
		$arrConfig = array(
			'wmode' => 'opaque',
			'players' => array(
				array('type' => 'flash', 'src' => JWPlayerUtils::getPlayerPath()),
				array('type' => 'html5')
			),
			
			'volume' => $this->backboneit_jwplayer_volume,
			'mute' => intval($this->backboneit_jwplayer_mute),
			'autostart' => $this->getAutoplay(),
			'repeat' => $this->backboneit_jwplayer_repeat,
			'width' => $arrSize[0],
			'height' => $arrSize[1],
			'controlbar' => $this->backboneit_jwplayer_cbpos,
			'backcolor' => $this->backboneit_jwplayer_back,
			'frontcolor' => $this->backboneit_jwplayer_front,
			'lightcolor' => $this->backboneit_jwplayer_light,
			'screencolor' => $this->backboneit_jwplayer_screen,
			'image' => $this->backboneit_jwplayer_preview
		);
			
		switch($this->backboneit_jwplayer_type) {
			case 'local':
				if(!is_file(TL_ROOT . '/' . $this->backboneit_jwplayer_local))
					throw new Exception("[IllegalArgumentException] File [$this->backboneit_jwplayer_local] not found.");
				
				if(JWPlayerUtils::isDownloadExtensionActive()) {
					$this->import('Download');
					$this->Download->process($this->backboneit_jwplayer_local);
					$this->Download->setConfig($this->arrData);
					$this->Download->referer = 'no';
					$this->Download->invalidate = 'ttl';
					$this->Download->bind = 'creation';
					$this->Download->setStartParam(self::DEFAULT_START_PARAM);
					$arrConfig['file'] = $this->Download->getURL($this->backboneit_jwplayer_local);
				} else {
					$arrConfig['file'] = $this->backboneit_jwplayer_local;
				}
				
				$objFile = new File($this->backboneit_jwplayer_local);
				switch(substr($objFile->mime, 0, 6)) {
					case 'audio/':
						$arrConfig['provider'] = 'sound';
						break;
					case 'image/':
						$arrConfig['provider'] = 'image';
						break;
					case 'video/':
						if(JWPlayerUtils::isDownloadExtensionActive() && $this->backboneit_jwplayer_stream && $objFile->extension == 'flv') {
							$arrConfig['provider'] = 'http';
							$arrConfig['http.startparam'] = self::DEFAULT_START_PARAM;
						} else {
							$arrConfig['provider'] = 'video';
						}
						break;
					default:
						$arrConfig['provider'] = 'file';
						break;
				}
				
				$arrConfig['netstreambasepath'] = $this->Environment->base;
				break;
			
			case 'extern': 
				if($this->backboneit_jwplayer_stream) {
					if($this->backboneit_jwplayer_streamer) {
						$strBase = $arrConfig['streamer'] = $this->backboneit_jwplayer_streamer;
					} else {
						$strBase = $this->backboneit_jwplayer_url;
					}
					
					if(strncmp($strBase, 'rtmp://', 7) === 0) {
						$arrConfig['provider'] = 'rtmp';
					} else {
						$arrConfig['provider'] = 'http';
						if(strlen($this->backboneit_jwplayer_startparam))
							$arrConfig['http.startparam'] = $this->backboneit_jwplayer_startparam;
					}
				} else {
					$arrConfig['provider'] = 'file';
				}
				$arrConfig['file'] = $this->backboneit_jwplayer_url;
				break;
				
			case 'youtube':
				if(!$objVideo = YouTubeVideo::create($this->backboneit_jwplayer_url))
					throw new Exception("[IllegalArgumentException] [$this->backboneit_jwplayer_url] does not contain a valid YouTube-ID.");
				
				$arrConfig['provider'] = 'youtube';
				$arrConfig['file'] = 'http://www.youtube.com/watch?v=' . $objVideo->id; //fix for older jwplayer versions;
				break;
		}
		
		if(is_file(TL_ROOT . '/' . $this->backboneit_jwplayer_skin))
			$arrConfig['skin'] = $this->backboneit_jwplayer_skin;
		
		if($this->backboneit_jwplayer_html5 == 'html5') {
			$var = $arrConfig['players'][0];
			$arrConfig['players'][0] = $arrConfig['players'][1];
			$arrConfig['players'][1] = $var;
		}
		
		$this->config = $arrConfig;
	
		if($this->backboneit_jwplayer_mediabox) {
			$this->compileMediabox($arrSize);
		} else {
			if($this->backboneit_jwplayer_floating == 'left'
			|| $this->backboneit_jwplayer_floating == 'right') {
				$this->floatClass = ' float_' . $this->backboneit_jwplayer_floating;
				$this->float = ' float:' . $this->backboneit_jwplayer_floating . ';';
			}
			$this->margin = $this->generateMargin(deserialize($this->backboneit_jwplayer_margin, true), 'padding');
		}
	}
	
	protected function compileMediabox(array $arrSize) {
		$this->strTemplate = 'backboneit_jwplayer_mediabox';
		$this->lightbox = sprintf('lightbox[%s %s %s]',
			$this->backboneit_jwplayer_group ? $this->backboneit_jwplayer_group : $this->id,
			$arrSize[0],
			$arrSize[1]
		);
		
		if($this->backboneit_jwplayer_linkpreview && $this->backboneit_jwplayer_preview) {
			$this->addImageToTemplate($this, array(
				'singleSRC' => $this->backboneit_jwplayer_preview,
				'size' => $this->backboneit_jwplayer_previewsize,
				'imagemargin' => $this->backboneit_jwplayer_margin,
				'floating' => $this->backboneit_jwplayer_floating
			));
		} else {
			if($this->backboneit_jwplayer_link) {
				$this->link = $this->backboneit_jwplayer_link;
			} elseif($this->backboneit_jwplayer_title) {
				$this->link = $this->backboneit_jwplayer_title;
			} elseif($this->backboneit_jwplayer_type == 'local') {
				$this->link = ucfirst(str_replace('_', ' ', basename($this->backboneit_jwplayer_local)));
			} else {
				$this->link = $this->backboneit_jwplayer_url;
			}
			
			if($this->backboneit_jwplayer_embedlink && $intPos = strpos($this->backboneit_jwplayer_embedlink, '%s')) {
				$this->beforeLink = substr($this->backboneit_jwplayer_embedlink, 0, $intPos);
				$this->afterLink = substr($this->backboneit_jwplayer_embedlink, $intPos + 2);
			}
		}
	}
	
	protected function getPreviewImage() {
		if(strncmp($this->backboneit_jwplayer_preview, '!YT!/', 5) === 0) // old style
			return $this->backboneit_jwplayer_type == 'youtube'
				? substr($this->backboneit_jwplayer_preview, 5)
				: '';
		
		if(strncmp($this->backboneit_jwplayer_preview, 'http://', 7) === 0) // new style
			return $this->backboneit_jwplayer_type == 'youtube'
				? JWPlayerUtils::fetchImage($this->backboneit_jwplayer_preview)
				: '';
			
		// normal image in the TL_ROOT (could be a fetched youtube image, or an image in the tl_files dir)
		return $this->backboneit_jwplayer_preview;
	}
	
	protected function getAutoplay() {
		return self::$blnAutoplayed && !$this->backboneit_jwplayer_mediabox ? 0 : intval($this->backboneit_jwplayer_autoplay, 10);
	}
	
	protected function setAutoplay() {
		if(self::$blnAutoplayed)
			return;
		
		self::$blnAutoplayed = !$this->backboneit_jwplayer_mediabox && intval($this->backboneit_jwplayer_autoplay, 10);
	}

	protected function generateMargin($arrValues, $strType='margin')
	{
		$top = $arrValues['top'];
		$right = $arrValues['right'];
		$bottom = $arrValues['bottom'];
		$left = $arrValues['left'];

		// Try to shorten definition
		if (strlen($top) && strlen($right) && strlen($bottom) && strlen($left))
		{
			if ($top == $right && $top == $bottom && $top == $left)
			{
				return $strType . ':' . $top . $arrValues['unit'] . ';';
			}

			elseif ($top == $bottom && $right == $left)
			{
				return $strType . ':' . $top . $arrValues['unit'] . ' ' . $left . $arrValues['unit'] . ';';
			}

			else
			{
				return $strType . ':' . $top . $arrValues['unit'] . ' ' . $right . $arrValues['unit'] . ' ' . $bottom . $arrValues['unit'] . ' ' . $left . $arrValues['unit'] . ';';
			}
		}

		$arrDir = array
		(
			'top'=>$top,
			'right'=>$right,
			'bottom'=>$bottom,
			'left'=>$left
		);

		$return = array();

		foreach ($arrDir as $k=>$v)
		{
			if (strlen($v))
			{
				$return[] = $strType . '-' . $k . ':' . $v . $arrValues['unit'] . ';';
			}
		}

		return implode(' ', $return);
	}
	
}
