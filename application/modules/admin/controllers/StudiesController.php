<?php
class Admin_StudiesController extends Controller_Abstract
{
	public function indexAction()
	{
		$s = new Studies();
		
		$pn = $this->getHelper('PageNavigator');
		$page = $pn->getPage();
		$ipp = $pn->getIpp();

		$list = $s->getList($page, $ipp, $this->_params['sort']);
		$totalCnt = $s->getCount();
		
		$this->view->assign(array(
			'list' => $list,
			'paginator' => $pn->getNavigator($totalCnt, $page, $ipp)
		));
	}
	
	public function editAction()
	{
		$id = $this->_params['id'];
		$s = new Studies();
		$form = new Form_Admin_Studies(array('id' => $id));

		if ($this->_request->isPost() && $form->isValid($this->_params))
		{
			$values = $form->getValues();
			
			if ($id)
			{
				$s->update($id, $values);
			}
			else
			{
				$s->insert($values);
			}

			$this->_redirect($this->_helper->router('admin:studies'));
		}
		
		$info = $s->getById($id);
		$form->populate($info ? $info : array());
		
		$this->view->assign(array(
			'form' => $form,
		));
	}
	
	public function deleteAction()
	{
		$s = new Studies();
		
		if (!$this->_params['again'] && $this->_params['delete_all'])
		{
			$p =  new Patients();
			$p->deleteByStudyId($this->_params['id']);
			$s->deleteById($this->_params['id']);
			
			$this->_redirect($this->_helper->router('admin:studies'));
		}
	
		if (!$this->_params['again']) {
			try
			{
				$s->deleteById($this->_params['id']);
				
				$this->_redirect($this->_helper->router('admin:studies'));
			}
			catch (Exception $e)
			{
				if ($e->getCode() == 23000)
				{
					$this->_redirect($this->_helper->router('admin:delete-study') . '?again=true');
				}
			}
		}
		
		$this->view->assign(array(
			'id' => $this->_params['id'],
		));
	}
}
