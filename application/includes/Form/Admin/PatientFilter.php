<?php
class Form_Admin_PatientFilter extends Form_Abstract
{
	public function init()
	{
		$this->setCustomView('patient-filter.tpl');
		$this->setAttrib('id', 'patient-filter');
		$this->setAttrib('method', 'get');
		
		$sex = new Zend_Form_Element_Select('sex', array(
			'title' => 'Sex', 
			'class' => 'placeholder'
		));
		$sex->setDecorators(array('ViewHelper'))
			->addMultiOptions(array_merge(array(
			'' => ''
		), Patients::$sex));
		
		$name = new Zend_Form_Element_Text('name', array('title' => 'Firstname or lastname', 'class' => 'placeholder normal'));
		$name->setDecorators(array('ViewHelper'));
		
		$submit = new Zend_Form_Element_Submit('submit', array('label' => 'Filter', 'class' => 'button blue'));
		$submit->setDecorators(array('ViewHelper'));
		
		$this->addElements(array(
			$sex,
			$name,
			$submit,
		));
	}
}