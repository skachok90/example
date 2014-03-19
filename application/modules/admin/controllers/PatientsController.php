<?php
class Admin_PatientsController extends Controller_Abstract
{
	public function indexAction()
	{
		$p = new Patients();
		$form = new Form_Admin_PatientFilter();
		
		$pn = $this->getHelper('PageNavigator');
		$page = $pn->getPage();
		$ipp = $pn->getIpp();
		
		$search['sex'] = $this->_params['sex'];
		$search['name'] = $this->_params['name'];
		
		$list = $p->getList($page, $ipp, self::$config->db->keyEncrypt, $this->_params['study-id'], $search);
		$totalCnt = $p->getCount($this->_params['study-id'], self::$config->db->keyEncrypt, $search);
		
		foreach ($list as &$value)
		{
			$value['sex'] = Patients::$sex[$value['sex']];
		}
		
		$form->populate($search);
		
		$this->view->assign(array(
			'list' => $list,
			'studyId' => $this->_params['study-id'],
			'paginator' => $pn->getNavigator($totalCnt, $page, $ipp),
			'form' => $form,
		));
	}
	
	public function editAction()
	{
		$id = $this->_params['id'];
		$p = new Patients();
		$info = $p->getById($id, self::$config->db->keyEncrypt);
		
		$form = new Form_Admin_Patients(array(
			'study_id' => $info['study_id'] ? $info['study_id'] : $this->_params['study-id'],
			'id' => $id,
		));

		if ($this->_request->isPost() && $form->isValid($this->_params))
		{
			$values = $form->getValues();
			
			$values['firstname_length'] = mb_strlen($values['firstname'], mb_detect_encoding($values['firstname']));
			$values['lastname_length'] = mb_strlen($values['lastname'], mb_detect_encoding($values['lastname']));
			
			if ($id)
			{
				$p->update($id, $values, self::$config->db->keyEncrypt);
			}
			else 
			{
				$values['study_id'] = $this->_params['study-id'];
				$p->insert($values, self::$config->db->keyEncrypt);
			}

			$this->_redirect($this->_helper->router('admin:patients', array('study-id' => $info['study_id'] ? $info['study_id'] : $this->_params['study-id'])));
		}
		
		$form->populate($info ? $info : array());
		
		$this->view->assign(array(
			'form' => $form,
		));
	}
	
	public function deleteAction()
	{
		$p = new Patients();
		
		$info = $p->getById($this->_params['id'], self::$config->db->keyEncrypt);
		$p->deleteById($this->_params['id']);
		$this->_redirect($this->_helper->router('admin:patients', array('study-id' => $info['study_id'])));
	}
	
	public function importAction()
	{
		$s = new Studies();
		$p = new Patients();
		
		$studies = $s->getAll();
		
		$massStudies[0] = '- Enter in field below -';
		
		foreach ($studies as $value)
		{
			$massStudies[$value['id']] = $value['name'];
		}
		
		if ($this->_params['study-id'])
		{
			$return = $this->_helper->router('admin:patients', array('study-id' => $this->_params['study-id']));
		}
		else
		{
			$return = $this->_helper->router('admin:studies');
		}
		
		$form = new Form_Admin_PatientsImport(array(
			'return' => $return,
			'studies' => $massStudies,
		));
		
		if ($this->_request->isPost() && $form->isValid($this->_params))
		{
			$values = $form->getValues();
			
			if ($form->file->receive())
			{
				$tmpName = $form->file->getFileName();
				
				
				if ($tmpName)
				{
					$data = $this->getHelper('CSV')->parseCSV($tmpName, '"', ";");
					
					if (!$values['studies'])
					{
						$study = $s->getByName($this->_params['name']);
					}
					
					if (!$values['name'])
					{
						$study = $s->getById($this->_params['studies']);
					}
					
					if ($study)
					{
						$values['studies'] = $study['id'];
						$values['name'] = $study['name'];
					}
					
					if (!$values['studies'])
					{
						$values['studies'] = $s->insert(array('name' => $values['name']));
					}
					
					foreach ($data as $value)
					{
						$value['firstname_length'] = mb_strlen($value['firstname'], mb_detect_encoding($value['firstname']));
						$value['lastname_length'] = mb_strlen($value['lastname'], mb_detect_encoding($value['lastname']));
						$value['study_id'] = $values['studies'];
						$p->insert($value, self::$config->db->keyEncrypt);
					}
					
					$this->_redirect($this->_helper->router('admin:patients', array('study-id' => $values['studies'])));
				}
			}
		}
		
		$form->populate($this->_params['study-id'] ? array('studies' => $this->_params['study-id']) : array());
		
		$this->view->assign(array(
			'form' => $form,
		));
	}
}
