<?php
abstract class Controller_Abstract extends Zend_Controller_Action
{
	protected static $auth 				= null;
	protected static $config 			= null;
	protected static $userInfo 			= null;
	
	protected $_params					= array();
	protected $_userParams				= array();
	
	public function init()
	{
		if(!self::$auth)
		{
			self::$auth = Zend_Registry::get('auth');
		}
		
		if(!self::$config)
		{
			self::$config = Zend_Registry::get('config');
		}
		
		if(!self::$userInfo)
		{
			self::$userInfo = Zend_Registry::get('auth')->getUserInfo();
		}
		
		$this->_params = $this->_request->getParams();
		$this->_userParams = $this->_request->getUserParams();
	}
}
