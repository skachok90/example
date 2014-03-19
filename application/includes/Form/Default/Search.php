<?php
class Form_Default_Search extends Form_Abstract
{
	public function init()
	{
		$this->setName('search')
			->setCustomView('search.tpl')
			->setMethod('get');
		
		$sex = new Zend_Form_Element_Select('sex', array(
			'label' => 'sex',
		));
		
		$sex->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			))
			->addMultiOptions(array_merge(array(
				'' => 'All'
				), Patients::$sex)
			);
			
		$birthday = new Zend_Form_Element_Text('birthday', array(
			'label' => 'date of birth',
			'class' => 'datepicker',
			'size' => 15,
		));
		$birthday->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			));
		
		$height = new Zend_Form_Element_Text('height', array(
			'label' => 'height',
			'size' => 15,
		));
		$height->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			));
		
		$race = new Zend_Form_Element_Text('race', array(
			'label' => 'race',
			'size' => 15,
		));
		$race->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			));
		
		$firstname_length = new Zend_Form_Element_Text('firstname_length', array(
			'label' => 'Number of letters first name',
			'size' => 15,
		));
		$firstname_length->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			))
			->setValidators(array(
				new Zend_Validate_Digits()
			));
		
		$lastname_length = new Zend_Form_Element_Text('lastname_length', array(
			'label' => 'Number of letters last name',
			'size' => 15,
		));
		$lastname_length->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			))
			->setValidators(array(
				new Zend_Validate_Digits()
			));
		
		$security_id = new Zend_Form_Element_Text('security_id', array(
			'label' => 'last four digits of national ID or Security Number',
			'size' => 15,
			'maxlength' => 4,
		));
		$security_id->setDecorators(array(
				'ViewHelper',
				new Decorator_Input(),
			))
			->setValidators(array(
				new Zend_Validate_Digits()
			));
			
		$hidden = new Zend_Form_Element_Hidden('hidden', array('value' => true));
		$hidden->setDecorators(array(
				'ViewHelper',
			));
		
		$this->setElements(array(
			$sex, 
			$birthday,
			$height,
			$race,
			$firstname_length,
			$lastname_length,
			$security_id,
			$hidden,
		));
	}
}