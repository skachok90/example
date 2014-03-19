<?php
class AuthController extends Controller_Abstract
{
	public function indexAction()
	{
	}
	
	public function loginAction()
	{
		$form = new Form_Default_Login();
		
		$auth = self::$auth;
		
		if($this->_request->isPost() && !self::$userInfo) 
		{
			if ($form->isValid($this->_params))
			{
				$values = $form->getValues();
				
				if($auth->login($values['email'], $this->getHelper('Routines')->cryptPassword($values['password'])))  
				{
					$this->_redirect($this->_helper->router('index'));
				}
				else
				{
					$form->setErrorMessages(array(
						'notAuth'
					));
				}
			}
		}
		
		$this->view->assign(array(
			'form' => $form,
			'success' => $success,
		));
	}
	
	public function logoutAction()
	{
		$auth = self::$auth;
		$auth->logout();
		$this->redirect($this->_helper->router('index'));
	}
	
	public function registrationAction()
	{
		$form = new Form_Default_Registration();
		$u = new Users();
		
		$auth = self::$auth;
		
		if($this->_request->isPost() && !self::$userInfo) 
		{
			if ($form->isValid($this->_params))
			{
				$values = $form->getValues();
				$values['password'] = $this->getHelper('Routines')->cryptPassword($values['password']);
				
				$u->insert($values);
				
				$this->_helper->Mailer(Helper_Mailer::TPL_REGISTRATION, array(
						'email' => $values['email'],
					)
					,array(
						'email' => $values['email']
					)
				);
				
				$this->_helper->Mailer(Helper_Mailer::TPL_REGISTRATION_ADMIN_NOTIFICATION, array(
						'email' => self::$config->email->support,
					),array(
						'email' => $values['email']
					)
				);
				
				if($auth->login($values['email'], $values['password']))  
				{
					$this->_redirect($this->_helper->router('index'));
				}
			}
		}
		
		$this->view->assign(array(
			'form' => $form,
		));
	}
	
	public function forgotAction()
	{
		$form = new Form_Default_Forgot();
		$u = new Users();
		
		if($this->_request->isPost() && !self::$userInfo) 
		{
			if ($form->isValid($this->_params))
			{
				$values = $form->getValues();
				$user = $u->getByEmail($values['email']);
				
				$secretCode = $this->_helper->Routines->getSecretCode($user);
				
				$link = $this->_helper->Router('default:password-recovery', array(), true) . '?' . http_build_query(array(
					'email' => $user['email'],
					'code' => $secretCode,
				));
				
				$this->_helper->Mailer(Helper_Mailer::TPL_PASSWORD_RECOVERY, array(
					'email' => $user['email'],
				), array(
					'link' => $link,
				));
				
				$success = true;
			}
		}
		
		$this->view->assign(array(
			'form' => $form,
			'success' => $success,
		));
	}
	
	public function passwordRecoveryAction()
	{
		$u = new Users();
		$form = new Form_Default_PasswordRecovery();
		$auth = self::$auth;
		
		if ($this->_params['email'] && $this->_params['code'])
		{
			$user = $u->getByEmail($this->_params['email']);
			$secretCode = $this->_helper->Routines->getSecretCode($user);
			
			if ($this->_params['code'] == $secretCode)
			{
				
				if($this->_request->isPost() && $form->isValid($this->_params))
				{
					$values = $form->getValues();
					
					$passwordHash =  $this->_helper->routines->cryptPassword($values['password']);
					
					$u->update($user['id'], array(
						'password' => $passwordHash,
					));
					
					if($auth->login($user['email'], $passwordHash))  
					{
						$this->_redirect($this->_helper->router('index'));
					}
				}
			}
			else
			{
				$form->setErrorMessages(array(
					'codeError'
				));
			}
		}
		
		$this->view->assign(array(
			'form' => $form,
		));
	}
}
