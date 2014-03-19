<?php
class Form_Admin_Login extends Form_Abstract
{
	public function init()
	{
		$this->setName('login')
			->setCustomView('login.tpl');	
			
		$login = new Zend_Form_Element_Text('login', array(
			'label' => 'Login',
			'class' => 'large',
		));
		$login->setRequired(true);
		
		$password = new Zend_Form_Element_Password('password', array(
			'label' => 'Password',
			'class' => 'large',
		));
		$password->setRequired(true);
		
		$btn = Form_Helper::getSubmitBtn(array(
			'label' => 'Sign In',
			'class' => 'right button',
		));
		
		$this->addElements(array(
			$login,
			$password,
			$btn,
		));
	}

}
