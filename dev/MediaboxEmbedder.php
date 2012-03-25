<?php

class MediaboxEmbedder extends Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function generate(array $arrConfig = null) {
		$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/backboneit_multimedia/js/mb.js';
		return $this->buildMediaboxTemplate($arrConfig)->parse();
	}
	
	public function buildTemplate(array $arrConfig = null) {
		$objTemplate = new FrontendTemplate('bbit_mm_mediabox');
	
		$objTemplate->id		= 'bbit_mm_' . $this->id . '_' . self::getUID();
		// TODO the size of the mediabox to open
		$objTemplate->lightbox	= trim($arrConfig['bbit_mm_group'] . ' 400 300');// . ' ' . $arrSize[0] . ' ' . $arrSize[1]);
		$objTemplate->title		= $this->getTitle();
	
		if($arrConfig['bbit_mm_linkpreview'] && $arrConfig['bbit_mm_preview']) {
			$objTemplate->caption = $arrConfig['bbit_mm_previewcaption'];
			$this->addImageToTemplate($objTemplate, array(
				'singleSRC'		=> $this->getPreviewImage(),
				'size'			=> $arrConfig['bbit_mm_previewsize'],
				'imagemargin'	=> $arrConfig['bbit_mm_margin'],
				'floating'		=> $arrConfig['bbit_mm_floating']
			));
	
		} else {
			$objTemplate->link = $arrConfig['bbit_mm_link'] ? $arrConfig['bbit_mm_link'] : $objTemplate->title;
			list($objTemplate->beforeLink, $objTemplate->afterLink) = explode('%s', $arrConfig['bbit_mm_embedlink'], 2);
		}
	
		return $objTemplate;
	}
	
}
