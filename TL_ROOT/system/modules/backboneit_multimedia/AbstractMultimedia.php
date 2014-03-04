<?php

abstract class AbstractMultimedia extends Controller implements Multimedia {

	protected $arrData;

	protected function __construct(array $arrData = null) {
		parent::__construct();
		$this->arrData = (array) $arrData;
	}

	public function generate(array $arrConfig = null, $strPlayer = null) {
		$strClass = MultimediaPlayerFactory::getInstance()->getPlayerClassFor($this, $strPlayer);
		$objPlayer = call_user_func(array($strClass, 'create'), $arrConfig);

		$objPlayer->setSizeMode($arrConfig['bbit_mm_sizing']);
		$arrConfig['bbit_mm_sizing'] == 'custom' && $objPlayer->setSize($arrConfig['bbit_mm_size']);

		$objTemplate = $this->buildTemplate($arrConfig);
		$objTemplate->embed = $objPlayer->embed($this);

		return $objTemplate->parse();
	}

	protected function buildTemplate(array $arrConfig = null) {
		$objTemplate = new FrontendTemplate('bbit_mm');

		if($arrConfig['bbit_mm_floating'] == 'left') {
			$objTemplate->floatClass = ' float_left';
			$objTemplate->float = ' float: left;';

		} elseif($arrConfig['bbit_mm_floating'] == 'right') {
			$objTemplate->floatClass = ' float_right';
			$objTemplate->float = ' float: right;';
		}

		if($arrConfig['bbit_mm_margin']) {
			$objTemplate->margin = $this->generateMargin(deserialize($arrConfig['bbit_mm_margin'], true), 'padding');
		}

		return $objTemplate;
	}

	public function getData() {
		return $this->arrData;
	}

	public function getID() {
		return $this->arrData['id'];
	}

	public function getTitle() {
		if(strlen($this->arrData['title'])) {
			return $this->arrData['title'];
		} elseif($this->isLocalSource()) {
			return ucfirst(str_replace('_', ' ', basename($this->getSource())));
		} else {
			return $this->getSource();
		}
	}

	public function getDescription() {
		return $this->arrData['description'];
	}

	public function getPreviewImage() {
		$image = $this->arrData['image'];
		$file = \FilesModel::findByUuid($image);
		$file && $image = $file->path;
		return $image;
	}

	private static $intUID = 0;

	public function getUID() {
		return 'bbit_mm_' . $this->getID() . '_' . self::$intUID++;
	}

}
