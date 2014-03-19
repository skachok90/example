<?php
class Admin_AuthAdapter extends Zend_Auth_Adapter_DbTable
{
	const COOKIE_ADMIN			= 'admin';
	const COOKIE_PASSWD			= 'hash';
	const COOKIE_EXPIRE			= 2592000;	// 30 days
	const COOKIE_PATH			= '/';
	
	public function __construct()
	{
		$db = Zend_Registry::get('db');
		parent::__construct($db);
		
		$this->setTableName(Model_Abstract::TBL_ADMIN_USERS);
		$this->setIdentityColumn('login');
		$this->setCredentialColumn('password');
		Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session(Zend_Auth_Storage_Session::NAMESPACE_DEFAULT . 'Admin'));
	}
	
	public function saveCookieAuth($login, $passwordHash)
	{
		$expTs = time() + self::COOKIE_EXPIRE;
		setcookie(self::COOKIE_ADMIN, $login, $expTs, self::COOKIE_PATH);
		setcookie(self::COOKIE_PASSWD, $passwordHash, $expTs, self::COOKIE_PATH);
	}
	
	public function clearCookieAuth()
	{
		setcookie(self::COOKIE_ADMIN, '', 0, self::COOKIE_PATH);
		setcookie(self::COOKIE_PASSWD, '', 0, self::COOKIE_PATH);
	}
	
	public function login($login, $passwordHash, $keepLogin = false)
	{
		if (!$login || !$passwordHash) 
		{
			return false;
		}
		
		if($keepLogin)
		{
			$this->saveCookieAuth($login, $passwordHash);
		}
		
		$this->setIdentity($login);
		$this->setCredential($passwordHash);
		
		$isValid = Zend_Auth::getInstance()->authenticate($this)->isValid() && $this->_resultRow['login'];
		
		if($isValid)
		{
			$this->setUserInfo($this->_resultRow);
		}
		
		return $isValid;
	}
	
	public function logout()
	{
		$session = Zend_Registry::get('session');
		$session->userInfo = null;
		Zend_Auth::getInstance()->clearIdentity();
		$this->clearCookieAuth();
	}
	
	public function validUser()
	{
		if(!Zend_Auth::getInstance()->hasIdentity())
		{
			if($_COOKIE[self::COOKIE_ADMIN] && $_COOKIE[self::COOKIE_PASSWD])
			{
				return $this->login($_COOKIE[self::COOKIE_ADMIN], $_COOKIE[self::COOKIE_PASSWD], true);
			}
			
			return false;
		}
		
		return true;
	}
	
	public function getUserInfo()
	{
		$session = Zend_Registry::get('session');
		return $session->userInfo;
	}
	
	public function setUserInfo($userInfo)
	{
		$session = Zend_Registry::get('session');
		$session->userInfo = array_merge((array)$session->userInfo, $userInfo);
	}
	
	public function getRole()
	{
		if($this->validUser())
		{
			return Admin_Users::ROLE_ADMIN;
		}
		
		return Users::ROLE_GUEST;
	}
}