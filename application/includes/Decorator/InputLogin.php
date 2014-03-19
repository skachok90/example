<?php
class Decorator_InputLogin extends Zend_Form_Decorator_Abstract
{
	public function render($content)
	{
		$el = $this->getElement();
		$type = $el->getType();
		$errorMessages = $el->getMessages();
		
		$html = '
			 <tr>
                <td width="9%"><div align="left"></div></td>
                <td width="81%"><div align="left">' . $el->getLabel() . '</div></td>
                <td width="10%"><div align="left"></div></td>
              </tr>
              <tr>
                <td width="9%"><div align="left"></div></td>
                <td><label>
                    <div align="left">
                      ' . $content . '
                    </div>
                  </label></td>
                <td><div align="left"></div></td>
              </tr>
		';
		
		if ($errorMessages) 
		{
			foreach ($errorMessages as $value)
			{
				$html .= '<tr>
	                <td width="9%"><div align="left"></div></td>
	                <td><label>
	                    <div align="left" class="error">
	                      ' . $value . '
	                    </div>
	                  </label></td>
	                <td><div align="left"></div></td>
	              </tr>';
				
				break;
			}
		}
		
		return $html;
	}

}
