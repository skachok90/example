<?php
class Decorator_Admin_Submit extends Zend_Form_Decorator_Abstract
{
	public function render($content)
	{
		if ($this->getOption('no_dt'))
		{
			$str = '<dd class="form-buttons">' . $content . '</dd>';
		}
		else 
		{
			$str = '<dt>&nbsp;</dt><dd class="form-buttons">' . $content . '</dd>';
		}
		
		return $str;
	}

}
