<?php
class Zend_View_Helper_CustomUrl  
{  
	public function customUrl($url = '', array $add = array())
	{
		$requestUri = new Zend_Controller_Request_Http();
		
		return $url . '?' . http_build_query(array_merge($requestUri->getParams(), $add));
	}
}