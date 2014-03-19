<?php
class Admin_IncomingRequestsController extends Controller_Abstract
{
	public function indexAction()
	{
		$r = new Requests();
		
		$pn = $this->getHelper('PageNavigator');
		$page = $pn->getPage();
		$ipp = $pn->getIpp();

		$list = $r->getList($page, $ipp, self::$config->db->keyEncrypt);
		$totalCnt = $r->getCount();
		
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
		$r = new Requests();
		
		$form = new Form_Admin_Requests(array(
			'id' => $id,
		));
		
		if ($this->_request->isPost() && $form->isValid($this->_params))
		{
			$values = $form->getValues();
			
			$r->update($id, $values, self::$config->db->keyEncrypt);

			$this->_redirect($this->_helper->router('admin:incoming-requests'));
		}

		$form->populate($r->getById($id, self::$config->db->keyEncrypt));
		
		$this->view->assign(array(
			'form' => $form,
		));
	}
	
	public function deleteAction()
	{
		$r = new Requests();
		
		$r->deleteById($this->_params['id']);
		$this->_redirect($this->_helper->router('admin:incoming-requests'));
	}
}
