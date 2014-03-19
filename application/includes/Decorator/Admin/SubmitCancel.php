<?php
class Decorator_Admin_SubmitCancel extends Zend_Form_Decorator_Abstract
{
	public function render($content)
	{
		return '<dt>&nbsp;</dt><dd class="form-buttons">' . $content . '<a href="' . $this->getOption('href') . '" class="button">Cancel</a></dd>';
	}

}
