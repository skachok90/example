<?php
class Plugin_Layout extends Zend_Controller_Plugin_Abstract
{
	const LAYOUT			= 'layout';
	const LAYOUT_LOGIN		= 'login';

	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$moduleName = $request->getModuleName();	
		$controllerName = $request->getControllerName();	
		$actionName = $request->getActionName();
		
		switch ($moduleName)
		{
			default:
				$layout = self::LAYOUT;
				break;
			
			case 'admin':
				$layout = self::LAYOUT_LOGIN;
				
				if ($controllerName != 'auth')
				{
					$layout = self::LAYOUT;
				}
				break;
		}
		
		Zend_Layout::getMvcInstance()->setLayout($layout);
	}
}
