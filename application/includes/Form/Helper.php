<?php
class Form_Helper
{
	public static function getSubmitBtn($options = array(), $name = 'btn')
	{
		if ($second_button = $options['second_button'])
		{
			unset($options['second_button']);
		}
		
		$defaults = array(
			'label' => 'Submit',
			'ignore' => true,
			'class' => 'right button orange',
		);

		$btn = new Zend_Form_Element_Submit($name, array_merge($defaults, $options));
		$btn->setDecorators(array(
			'ViewHelper',
		));
		
		if ($second_button)
		{
			$btn->addDecorator(new Decorator_RegisterSingIn(array(
				'href' => $second_button,
			)));
		}

		return $btn;
	}
	
	public static function getSubmitBtnAdmin($options = array(), $name = 'btn')
	{
		if ($cancel = $options['cancel'])
		{
			unset($options['cancel']);
		}	
			
		$options = array_merge(array(
			'label' => 'Submit',
			'type' => 'submit',
			'ignore' => true,
			'class' => 'blue',
		), $options);

		$btn = new Zend_Form_Element_Button($name, $options);
		$btn->setDecorators(array(
			'ViewHelper',
		));
		
		if ($cancel)
		{
			$btn->addDecorator(new Decorator_Admin_SubmitCancel(array(
				'href' => $cancel,
			)));
		}
		else
		{
			$btn->addDecorator(new Decorator_Admin_Submit(array('no_dt' => $options['no_dt'])));
		}

		return $btn;
	}

}
