<?php
class Resource_Acl extends Zend_Application_Resource_ResourceAbstract
{
	public function init()
	{
		$controller = Zend_Controller_Front::getInstance();	
			
		$options = $this->getOptions();
		$auth = new AuthAdapter();
		Zend_Registry::set('auth', $auth);
		
		require ($options['acl']);
		Zend_Registry::set('acl', $acl);
	}
}