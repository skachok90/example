<?php
class Decorator_Admin_Multicheckbox extends Zend_Form_Decorator_Abstract
{
	public function render($content)
	{
		$el = $this->getElement();
		$errorMessages = $el->getMessages();
		
		$html = '
				<dt id="' . $el->getId() . '-label">
					<label class="optional" for="all">' . $el->getLabel() . '</label>
				</dt>
				<dd id="' . $el->getId() . '-element">
					<div class="multicheckbox-block">
                      ' . $content . '
                     </div>
				</dd>
		';
		
		return $html;
	}

}
