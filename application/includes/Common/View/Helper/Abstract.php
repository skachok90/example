<?php

class View_Helper_Abstract extends Zend_View_Helper_Abstract
{
	protected static $config 			= null;
	protected static $userInfo 			= null;
	
	public function __construct()
	{
		if(!self::$config)
		{
			self::$config = Zend_Registry::get('config');
		}

		if(!self::$userInfo)
		{
			self::$userInfo = Zend_Registry::get('auth')->getUserInfo();
		}
	}
	
	// Return action helper
	protected function actionHelper($name)
	{
		return Zend_Controller_Action_HelperBroker::getStaticHelper($name);
	}
}