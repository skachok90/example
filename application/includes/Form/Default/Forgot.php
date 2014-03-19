<?php
class Form_Default_Forgot extends Form_Abstract
{
	public function init()
	{
		$this->setName('forgot')
			->setCustomView('forgot.tpl');
		
		$email = new Zend_Form_Element_Text('email', array(
			'label' => 'Email',
			'size' => 15,
		));
		$email->setRequired(true)
			->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			))
			->addValidators(array(
				new Zend_Validate_EmailAddress(),
				new Validator_ExistEmail()
			));
		
		$this->setElements(array(
			$email, 
		));
	}
}