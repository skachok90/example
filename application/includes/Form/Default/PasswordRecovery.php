<?php
class Form_Default_PasswordRecovery extends Form_Abstract
{
	public function init()
	{
		$this->setName('password-recovery')
			->setCustomView('password-recovery.tpl');
			
		$password = new Zend_Form_Element_Password('password', array(
			'label' => 'Password',
			'size' => 15,
			'autocomplete' => 'off',
		));
		$password->setRequired()
			->setDecorators(array(
					'ViewHelper',
					new Decorator_Input(),
				))
			->addValidators(array(
				new Validator_EqualValues('confirm'),
			));
		
		$confirm = new Zend_Form_Element_Password('confirm', array(
			'label' => 'Confirm',
			'size' => 15,
			'autocomplete' => 'off',
		));
		$confirm->setRequired()
			->setDecorators(array(
					'ViewHelper',
					new Decorator_Input(),
				))
			->addValidators(array(
				new Validator_EqualValues('password'),
			));
		
		$this->setElements(array(
			$password, 
			$confirm, 
		));
	}
}