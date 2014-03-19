<?php
class IndexController extends Controller_Abstract
{
	public function indexAction()
	{
	}
	
	public function searchAction()
	{
		$form = new Form_Default_Search();
		$p = new Patients();
		$r = new Requests();
		
		if($this->_request->isGet() && $this->_params['hidden']) 
		{
			if ($form->isValid($this->_params))
			{
				$values = $form->getValues();
				
				$r->insert($values, self::$config->db->keyEncrypt);
				
				$query = http_build_query($values);
				
				list($title, $countFields) = $this->buildTitleArray($values);
				
				$pn = $this->getHelper('PageNavigator');
				$ipp = $pn->getIppSearch();
				
				$data['perfect']['match'] = $p->getMatch($values, self::$config->db->keyEncrypt, $countFields, 1, $ipp, self::$userInfo, true);
				$data['perfect']['totalCnt'] = $p->getCounMath($values, self::$config->db->keyEncrypt, $countFields, self::$userInfo, true);
				$data['partial']['match'] = $p->getMatch($values, self::$config->db->keyEncrypt, $countFields, 1, $ipp, self::$userInfo);
				$data['partial']['totalCnt'] = $p->getCounMath($values, self::$config->db->keyEncrypt, $countFields, self::$userInfo);
				$search = true;
			}
		}
		
		$this->view->assign(array(
			'form' => $form,
			'data' => $data,
			'title' => $title,
			'countFields' => $countFields,
			'query' => $query,
			'search' => $search,
		));
	}
	
	public function termsAction() 
	{
	}
	
	public function showPerfectMatchAction()
	{
		$p = new Patients();
		
		if($this->_request->isGet()) 
		{
			$values['sex'] = $this->_params['sex'];
			$values['birthday'] = $this->_params['birthday'];
			$values['height'] = $this->_params['height'];
			$values['race'] = $this->_params['race'];
			$values['firstname_length'] = $this->_params['firstname_length'];
			$values['lastname_length'] = $this->_params['lastname_length'];
			$values['security_id'] = $this->_params['security_id'];
			$values['hidden'] = $this->_params['hidden'];
			
			$query = http_build_query($values);
			
			list($title, $countFields) = $this->buildTitleArray($values);
			
			$pn = $this->getHelper('PageNavigator');
			$page = $pn->getPage();
			$ipp = $pn->getIpp();
			
			$data['perfect']['match'] = $p->getMatch($values, self::$config->db->keyEncrypt, $countFields, $page, $ipp, self::$userInfo, true);
			$data['perfect']['totalCnt'] = $p->getCounMath($values, self::$config->db->keyEncrypt, $countFields, self::$userInfo, true);
		}
		
		$this->view->assign(array(
			'data' => $data,
			'title' => $title,
			'countFields' => $countFields,
			'paginator' => $pn ? $pn->getNavigator($data['perfect']['totalCnt'], $page, $ipp) : '',
			'query' => $query,
		));
	}
	
	public function showPartialMatchAction()
	{
		$p = new Patients();
		
		if($this->_request->isGet()) 
		{
			$values['sex'] = $this->_params['sex'];
			$values['birthday'] = $this->_params['birthday'];
			$values['height'] = $this->_params['height'];
			$values['race'] = $this->_params['race'];
			$values['firstname_length'] = $this->_params['firstname_length'];
			$values['lastname_length'] = $this->_params['lastname_length'];
			$values['security_id'] = $this->_params['security_id'];
			$values['hidden'] = $this->_params['hidden'];
			
			$query = http_build_query($values);
			
			list($title, $countFields) = $this->buildTitleArray($values);
			
			$pn = $this->getHelper('PageNavigator');
			$page = $pn->getPage();
			$ipp = $pn->getIpp();
			
			$data['partial']['match'] = $p->getMatch($values, self::$config->db->keyEncrypt, $countFields, $page, $ipp, self::$userInfo);
			$data['partial']['totalCnt'] = $p->getCounMath($values, self::$config->db->keyEncrypt, $countFields, self::$userInfo);
		}
		
		$this->view->assign(array(
			'data' => $data,
			'title' => $title,
			'countFields' => $countFields,
			'paginator' => $pn ? $pn->getNavigator($data['partial']['totalCnt'], $page, $ipp) : '',
			'query' => $query,
		));
	}
	
	private function buildTitleArray($values)
	{
		$countFields = 0;
				
		if ($values['sex'])
		{
			$countFields++;
			$title['sex'] = true;
		}
		if ($values['birthday'])
		{
			$countFields++;
			$title['birthday'] = true;
		}
		if ($values['height'])
		{
			$countFields++;
			$title['height'] = true;
		}
		if ($values['race'])
		{
			$countFields++;
			$title['race'] = true;
		}
		if ($values['firstname_length'])
		{
			$countFields++;
			$title['firstname_length'] = true;
		}
		if ($values['lastname_length'])
		{
			$countFields++;
			$title['lastname_length'] = true;
		}
		if ($values['security_id'])
		{
			$countFields++;
			$title['security_id'] = true;
		}
		
		return array($title, $countFields);
	}
	
}
