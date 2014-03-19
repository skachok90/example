<?php
class Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
	private $acl = null;
	
	public function __construct()
	{
		$this->acl = Zend_Registry::get('acl');
	}
	
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$controller = $request->getControllerName();
		$priv = $request->getActionName();
		$module = $request->getModuleName();
		
		$resource = ($module != 'default' ? $module . ':' : '') . $controller;
		
		switch ($module)
		{
			case 'admin':
				$auth = new Admin_AuthAdapter();	
				Zend_Registry::set('auth', $auth);
				break;
			
			default:
				$auth = Zend_Registry::get('auth');
				break;
		}
		
		$role = $auth->getRole();
		
		Zend_View_Helper_Navigation_HelperAbstract::setDefaultAcl(Zend_Registry::get('acl'));
		Zend_View_Helper_Navigation_HelperAbstract::setDefaultRole($role);
		
		try
		{
			if (!$this->acl->isAllowed($role, $resource, $priv))
			{
				switch ($module)
				{
					case 'admin':
						if ($auth->validUser())
						{
							if ($resource == 'auth' && $priv == 'index')
							{
								return;
							}
								
							$request->setControllerName('index')->setActionName('index');
						}
						else
						{
							$request->setControllerName('auth')->setActionName('index');
						}
						break;
						
					default:
						if ($auth->validUser())
						{
							if ($resource == 'auth' && $priv == 'index')
							{
								return;
							}
								
							$request->setControllerName('index')->setActionName('index');
						}
						else
						{
							$request->setControllerName('index')->setActionName('index');
						}
						break;
				}	
			}
		}
		catch(Zend_Acl_Exception $e)
		{
		}
	}

}
