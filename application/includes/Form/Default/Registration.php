<?php
class Form_Default_Registration extends Form_Abstract
{
	public function init()
	{
		$this->setName('registration')
			->setCustomView('registration.tpl');
		
		$registration_id = new Zend_Form_Element_Text('registration_id', array(
			'label' => 'Clinical trial registration #',
			'size' => 15,
		));
		$registration_id->setRequired(true)
			->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			));
		
		$resp_party = new Zend_Form_Element_Text('resp_party', array(
			'label' => 'Responsible party',
			'size' => 15,
		));
		$resp_party->setRequired(true)
			->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			));
		
		$institutional_name = new Zend_Form_Element_Text('institutional_name', array(
			'label' => 'Institutional name',
			'size' => 15,
		));
		$institutional_name->setRequired(true)
			->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			));
		
		$phone = new Zend_Form_Element_Text('phone', array(
			'label' => 'Telephone',
			'size' => 15,
		));
		$phone->setRequired(true)
			->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			));
		
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
				new Validator_NotExistEmail()
			));
		
		$password = new Zend_Form_Element_Password('password', array(
			'label' => 'Password',
			'size' => 15,
			'autocomplete' => 'off',
		));
		$password->setRequired(true)
			->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			))
			->addValidators(array(
				new Validator_EqualValues('confirm')
			));
		
		$confirm = new Zend_Form_Element_Password('confirm', array(
			'label' => 'Confirm',
			'size' => 15,
			'autocomplete' => 'off',
		));
		$confirm->setRequired(true)
			->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			))
			->addValidators(array(
				new Validator_EqualValues('password')
			));
		
		$payment_method = new Zend_Form_Element_Radio('payment_method', array('label' => 'Payment method'));
		$payment_method->setMultiOptions(array(
				Users::$payment[0],
				Users::$payment[1],
				Users::$payment[2],
			))
			->setValue(Users::$payment[0])
			->setDecorators(array(
				'ViewHelper',
				new Decorator_Radio(),
			));
		
		$this->setElements(array(
			$registration_id, 
			$resp_party, 
			$institutional_name, 
			$phone, 
			$email, 
			$password, 
			$confirm,
			$payment_method,
		));
	}
}