<?php
class Admin_AuthController extends Controller_Abstract
{
	public function indexAction()
	{
		$form = new Form_Admin_Login();
		$auth = self::$auth;
		
		if ($auth->validUser())
		{
			$this->_redirect($this->_helper->router('admin'));
		}
		
		if($this->_request->isPost()) 
		{
			if ($form->isValid($this->_params))
			{
				$values = $form->getValues();
				
				if($auth->login($values['login'], $this->getHelper('Routines')->cryptPassword($values['password'])))  
				{
					$this->_redirect($this->_helper->router('admin'));
				}
				
				$error = true;
			}
		}
		
		$this->view->assign(array(
			'form' => $form,
			'error' => $error,
		));
	}
	
	public function logoutAction()
	{
		$auth = self::$auth;
		$auth->logout();
		
		$this->_redirect($this->_helper->router('admin'));
	}
}
