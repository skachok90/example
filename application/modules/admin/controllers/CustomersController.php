<?php
class Admin_CustomersController extends Controller_Abstract
{
	public function indexAction()
	{
		$u = new Users();
		
		$pn = $this->getHelper('PageNavigator');
		$page = $pn->getPage();
		$ipp = $pn->getIpp();

		$list = $u->getList($page, $ipp, $this->_params['sort']);
		$totalCnt = $u->getCount();
		
		foreach ($list as &$value)
		{
			$value['payment_method'] = Users::$payment[$value['payment_method']];
		}
		
		$this->view->assign(array(
			'list' => $list,
			'paginator' => $pn->getNavigator($totalCnt, $page, $ipp)
		));
	}
	
	public function editAction()
	{
		$id = $this->_params['id'];
		$u = new Users();
		$us = new User_Studies();
		$s = new Studies();
		
		$studies = $s->getAll();
		
		$mass_studies['all'] = 'All';
		
		foreach ($studies as $value)
		{
			$mass_studies[$value['id']] = $value['name'];
		}
		
		$form = new Form_Admin_Customer(array('studies' => $mass_studies));

		if ($this->_request->isPost() && $form->isValid($this->_params))
		{
			$values = $form->getValues();
			
			$us->deleteByUserId($id);
			
			if ($values['password'])
			{
				$values['password'] = $this->_helper->routines->cryptPassword($values['password']);
			}
			else
			{
				unset($values['password']);
			}
			
			if (in_array('all', $values['studies']))
			{
				$values['all'] = 1;
			}
			else 
			{
				$values['all'] = 0;
			}
			
			$u->update($id, $values);
			
			foreach ($values['studies'] as $value)
			{
				if ($value != 'all')
				{
					$user_studies['user_id'] = $id;
					$user_studies['study_id'] = $value;
					$us->insert($user_studies);
				}
			}

			$this->_redirect($this->_helper->router('admin:customers'));
		}
		
		$user = $u->getById($id);
		$studies = $u->getStudiesById($id);
		
		foreach ($studies as $value)
		{
			$user['studies'][] = $value['id'];
		}
		
		$user['studies']['all'] = $user['all'] ? 'all' : '';
		
		$form->populate($user);
		
		$this->view->assign(array(
			'form' => $form,
		));
	}
	
	public function deleteAction()
	{
		$u = new Users();
		$u->deleteById($this->_params['id']);
		$this->_redirect($this->_helper->router('admin:customers'));
	}
}
