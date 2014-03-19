<?php
class Form_Admin_PatientsImport extends Form_Abstract
{
	public function init()
	{
		$file = new Zend_Form_Element_File('file', array('label' => 'Input file'));
		$file->setRequired(true)
			->setValidators(array(
				new Validator_ExtensionFile()
			));
			
		$studies = new Zend_Form_Element_Select('studies', array(
			'label' => 'Study',
			'class' => 'default-width',
		));
		$studies->addMultiOptions($this->getParam('studies'));
		
		$name = new Zend_Form_Element_Text('name', array('label' => 'Name'));
		$name->addValidators(array(
			new Validator_ValidName('studies')
		))
		->setAllowEmpty(false);
		
		$cancel = Zend_Registry::get('config')->url->base . $this->getParam('return');
			
		$btn = Form_Helper::getSubmitBtnAdmin(array(
			'cancel' => $cancel,
		), 'save');

		$this->addElements(array(
			$file,
			$studies,
			$name,
			$btn,
		));
	}

}
