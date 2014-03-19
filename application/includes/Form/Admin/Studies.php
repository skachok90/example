<?php
class Form_Admin_Studies extends Form_Abstract
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
		
		$name = new Zend_Form_Element_Text('name', array('label' => 'Name'));
		$name->setRequired(true);
		
		$cancel = Zend_Registry::get('config')->url->base . Zend_Controller_Action_HelperBroker::getStaticHelper('Router')->direct('admin:studies');
			
		$btn = Form_Helper::getSubmitBtnAdmin(array(
			'cancel' => $cancel,
		), 'save');

		$this->addElements(array(
			$id,
			$name,
			$btn,
		));
	}

}
