<?php
class Form_Admin_Patients extends Form_Abstract
{
	public function init()
	{
		if ($this->getParam('id'))
		{
			$id = new Zend_Form_Element_Text('id', array(
				'label' => 'ID',
				'readonly' => true
			));
		}
		
		$firstname = new Zend_Form_Element_Text('firstname', array('label' => 'Firstname'));
		$firstname->setRequired(true);
		
		$lastname = new Zend_Form_Element_Text('lastname', array('label' => 'Lastname'));
		$lastname->setRequired(true);
		
		$sex = new Zend_Form_Element_Select('sex', array(
			'label' => 'Sex',
			'class' => 'default-width',
		));
		$sex->setRequired()
		->addMultiOptions(array_merge(array(
			'' => ''
		), Patients::$sex));
		
		$birthday = new Zend_Form_Element_Text('birthday', array(
			'label' => 'Birthday',
			'class' => 'datepicker',
			'style' => 'width: 140px',
		));
		
		$height = new Zend_Form_Element_Text('height', array('label' => 'Height'));
		
		$race = new Zend_Form_Element_Text('race', array('label' => 'Race'));
		
		$security_id = new Zend_Form_Element_Text('security_id', array(
			'label' => 'Last four digits of national ID or Security Number',
			'maxlength' => 4,
		));
		$security_id->setValidators(array(
			new Zend_Validate_Digits()
		));
		
		$cancel = Zend_Registry::get('config')->url->base . Zend_Controller_Action_HelperBroker::getStaticHelper('Router')->direct('admin:patients', array('study-id' => $this->getParam('study_id')));
			
		$btn = Form_Helper::getSubmitBtnAdmin(array(
			'cancel' => $cancel,
		), 'save');

		$this->addElements(array(
			$id,
			$firstname,
			$lastname,
			$sex,
			$birthday,
			$height,
			$race,
			$security_id,
			$btn,
		));
	}

}
