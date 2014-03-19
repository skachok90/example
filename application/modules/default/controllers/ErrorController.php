<?php
class ErrorController extends Controller_Abstract
{
	public function errorAction()
	{
		$errors = $this->_getParam('error_handler');

		switch ($errors->type)
		{
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
			case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
				$this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
				$errorMsg = 'HTTP/1.1 404 Not Found';
				break;
				
			default:
				$errorMsg = "System error! Please try later!";
				break;
		}

		$this->getResponse()->clearBody();
		$this->view->content = $errorMsg;
	}
}