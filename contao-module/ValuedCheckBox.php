<?php

class ValuedCheckBox extends Widget {

	protected $blnSubmitInput = true;

	protected $strTemplate = 'be_widget_chk';

	public function generate() {
        return sprintf('<div id="ctrl_%s" class="tl_checkbox_single_container %s">'
        	. '<input type="hidden" name="%s" value="%s"><input type="checkbox"'
        	. ' name="%s" id="opt_%s" class="tl_checkbox"'
        	. ' value="%s"%s%s onfocus="Backend.getScrollOffset();"> <label'
        	. ' for="opt_%s">%s</label></div>%s',
        			$this->strId,
					$this->strClass,
        			$this->strName,
					$this->uncheckedValue,
        			$this->strName,
					$this->strId,
					$this->checkedValue,
					$this->varValue == $this->checkedValue ? 'checked="checked"' : '',
					$this->getAttributes(),
					$this->strId,
					$this->strLabel,
					$this->wizard);
	}

}
