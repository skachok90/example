<?php
class Decorator_Radio extends Zend_Form_Decorator_Abstract
{
	public function render($content)
	{
		$el = $this->getElement();
		$type = $el->getType();
		
		$html = '
			<tr>
				<td width="8%">&nbsp;</td>
				<td width="42%">' . $el->getLabel() . '<br /><br /></td>
				<td width="37%">
					' . $content . '
				</td>
				<td width="13%">&nbsp;</td>
			</tr>
		';
		
		return $html;
	}

}
