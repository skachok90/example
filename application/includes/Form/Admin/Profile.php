<?php
class Form_Admin_Profile extends Form_Abstract
{
	public function init()
	{
		$login = new Zend_Form_Element_Text('login', array(
			'label' => 'Login',
			'readonly' => true,
		));

		$password = new Zend_Form_Element_Password('password', array('label' => 'Password'));
		$password->setValidators(array(new Validator_EqualValues('password_conf')));

		$passwordConf = new Zend_Form_Element_Password('password_conf', array('label' => 'Confirm password'));
		$passwordConf->setValidators(array(new Validator_EqualValues('password')));
		
		$btn = Form_Helper::getSubmitBtnAdmin(array(), 'save');

		$this->addElements(array(
			$id,
			$login,
			$password,
			$passwordConf,
			$btn,
		));
	}

}
