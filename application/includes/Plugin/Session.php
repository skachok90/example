<?php
class Plugin_Session extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$module = $request->getModuleName();
		
		if ($module == 'admin')
		{
			$namespace = Zend_Registry::get('session')->getNamespace();
			$session = new Zend_Session_Namespace($module . '-' . $namespace);
			Zend_Registry::set('session', $session);
		}
	}

}
