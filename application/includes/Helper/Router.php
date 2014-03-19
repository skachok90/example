<?php
class Helper_Router extends Zend_Controller_Action_Helper_Abstract
{
	public function direct($router, array $params = array(), $absoluteUrl = false, $secure = false)
	{
		$url = Zend_Registry::get('router')->getRoute($router)->assemble($params);
		
		if (strrpos($url, 'http') === false)
		{
			// $url = Zend_Registry::get('config')->url->base . $url;
			
			if ($absoluteUrl)
			{
				$server = Zend_Controller_Front::getInstance()->getRequest()->getServer();
				$url = 'http' . ($secure ? 's' : '') . '://' . $server['HTTP_HOST'] . Zend_Registry::get('config')->url->base . $url;
			}
		}	
		
		if (!$url)
		{
			$url = Zend_Registry::get('config')->url->base;
		}

		return $url;
	}

}
