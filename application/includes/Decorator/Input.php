<?php
class Decorator_Input extends Zend_Form_Decorator_Abstract
{
	public function render($content)
	{
		$el = $this->getElement();
		$type = $el->getType();
		$errorMessages = $el->getMessages();
		
		if ($errorMessages) 
		{
			foreach ($errorMessages as $value)
			{
				$error .= '
	                    <div align="left" class="error">
	                      ' . $value . '
	                    </div>';
				break;
			}
		}
		
		$html = '
			<tr>
				<td width="8%">&nbsp;</td>
				<td width="42%" class="top">' . $el->getLabel() . '<br /><br /></td>
				<td width="37%" class="top">
					<label>
						<div align="left">
							' . $content . '
						</div>
						' . $error .'
					</label>
				</td>
				<td width="13%">&nbsp;</td>
			</tr>
		';
		
		
		return $html;
	}

}
