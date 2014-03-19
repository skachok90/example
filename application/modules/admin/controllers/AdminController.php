<?php
class Admin_AdminController extends Controller_Abstract
{
	public function indexAction()
	{
		$this->view->assign(array(
			'userInfo' => self::$userInfo,
		));
	}
	
	public function profileAction()
	{
		$id = $userInfo['id'];
		$au = new Admin_Users();
		$form = new Form_Admin_Profile();
		
		if ($this->_request->isPost() && $form->isValid($this->_params))
		{
			$values = $form->getValues();
			
			if ($values['password'])
			{
				$values['password'] = $this->_helper->routines->cryptPassword($values['password']);
			}
			else
			{
				unset($values['password']);
			}
			
			$au->update($id, $values);

			$this->_redirect($this->_helper->router('admin:profile'));
		}
		
		$form->populate(self::$userInfo);
		
		$this->view->assign(array(
			'form' => $form,
		));
	}
}