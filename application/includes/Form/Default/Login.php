<?php
class Form_Default_Login extends Form_Abstract
{
	public function init()
	{
		$this->setName('login')
			->setCustomView('login.tpl');
		
		$email = new Zend_Form_Element_Text('email', array('label' => 'Email'));
		$email->setRequired(true)
			->setDecorators(array(
				'ViewHelper',
				new Decorator_InputLogin(),
			))
			->addValidators(array(
				new Zend_Validate_EmailAddress()
			));
		
		$password = new Zend_Form_Element_Password('password', array('label' => 'Password'));
		$password->setRequired(true)
			->setDecorators(array(
				'ViewHelper',
				new Decorator_InputLogin(),
			));
		
		$this->setElements(array(
			$email, 
			$password, 
		));
	}
}