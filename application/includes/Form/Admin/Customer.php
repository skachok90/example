<?php
class Form_Admin_Customer extends Form_Abstract
{
	public function init()
	{
		
		$id = new Zend_Form_Element_Text('id', array(
			'label' => 'ID',
			'readonly' => true
		));
		$email = new Zend_Form_Element_Text('email', array(
			'label' => 'E-mail',
			'readonly' => true
		));
		$phone = new Zend_Form_Element_Text('phone', array('label' => 'Telephone'));
		$registration_id = new Zend_Form_Element_Text('registration_id', array('label' => 'Registration id'));
		$resp_party = new Zend_Form_Element_Text('resp_party', array('label' => 'Responsible party'));
		$institutional_name = new Zend_Form_Element_Text('institutional_name', array('label' => 'Institutional name'));
		
		$payment_method = new Zend_Form_Element_Select('payment_method', array(
			'label' => 'Payment method',
			'class' => 'default-width',
		));
		$payment_method->addMultiOptions(Users::$payment);
		
		$studies = new Zend_Form_Element_MultiCheckbox('studies', array(
			'label' => 'Studies',
			'class' => 'default-multicheckbox',
		));
		$studies->addMultiOptions($this->getParam('studies'))
			->setDecorators(array(
				'ViewHelper',
				new Decorator_Admin_Multicheckbox(),
			));
		
		$password = new Zend_Form_Element_Password('password', array('label' => 'Password'));
		$password->setValidators(array(new Validator_EqualValues('password_conf')));

		$passwordConf = new Zend_Form_Element_Password('password_conf', array('label' => 'Confirm password'));
		$passwordConf->setValidators(array(new Validator_EqualValues('password')));
		
		$cancel = Zend_Registry::get('config')->url->base . Zend_Controller_Action_HelperBroker::getStaticHelper('Router')->direct('admin:customers');
			
		$btn = Form_Helper::getSubmitBtnAdmin(array(
			'cancel' => $cancel,
		), 'save');

		$this->addElements(array(
			$id,
			$email,
			$phone,
			$registration_id,
			$resp_party,
			$institutional_name,
			$payment_method,
			$studies,
			$password,
			$passwordConf,
			$btn,
		));
	}

}
