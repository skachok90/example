<?php
class Patients extends Model_Abstract
{
	public static $sex = array(
		'M' => 'Male',
		'F' => 'Female',
	);
	
	public function insert(array $values, $keyEncrypt)
	{
		if (isset($values['firstname']))
		{
			$data['firstname'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['firstname'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['lastname']))
		{
			$data['lastname'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['lastname'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['sex']))
		{
			$data['sex'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['sex'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['birthday']))
		{
			$data['birthday'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['birthday'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['height']))
		{
			$data['height'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['height'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['race']))
		{
			$data['race'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['race'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['firstname_length']))
		{
			$data['firstname_length'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['firstname_length'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['lastname_length']))
		{
			$data['lastname_length'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['lastname_length'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['security_id']))
		{
			$data['security_id'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['security_id'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['study_id']))
		{
			$data['study_id'] = (int)$values['study_id'];
		}
		
		parent::insert($data);
	}
	
	public function update($id, array $values, $keyEncrypt)
	{
		if (!($id = (int)$id))
		{
			throw new Exception_Model('$id');
		}
		
		if (isset($values['firstname']))
		{
			$data['firstname'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['firstname'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['lastname']))
		{
			$data['lastname'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['lastname'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['sex']))
		{
			$data['sex'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['sex'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['birthday']))
		{
			$data['birthday'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['birthday'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['height']))
		{
			$data['height'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['height'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['race']))
		{
			$data['race'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['race'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['firstname_length']))
		{
			$data['firstname_length'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['firstname_length'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['lastname_length']))
		{
			$data['lastname_length'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['lastname_length'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['security_id']))
		{
			$data['security_id'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['security_id'] . "', '" . $keyEncrypt . "')");
		}
		
		parent::update($id, $data);
	}
	
	public function getMatch($values, $keyEncrypt, $countFields, $page, $ipp, $userInfo, $perfect = false)
	{
		$zds = $this->getPartZds($values, $keyEncrypt);
		
		if ($zds)
		{
			$zds2 = $this->_db
				->select()
				->from(array('zds' => $zds),
					array(
						'id' => 'zds.id',
						'sex' => 'zds.sex',
						'birthday' => 'zds.birthday',
						'height' => 'zds.height',
						'race' => 'zds.race',
						'firstname_length' => 'zds.firstname_length',
						'lastname_length' => 'zds.lastname_length',
						'security_id' => 'zds.security_id',
						'count' => new Zend_Db_Expr('zds.eqsex + zds.eqbirthday + zds.eqheight + zds.eqrace + zds.eqfirstname_length + zds.eqlastname_length + zds.eqsecurity_id'),
						'eqsex' => 'zds.eqsex',
						'eqbirthday' => 'zds.eqbirthday',
						'eqheight' => 'zds.eqheight',
						'eqrace' => 'zds.eqrace',
						'eqfirstname_length' => 'zds.eqfirstname_length',
						'eqlastname_length' => 'zds.eqlastname_length',
						'eqsecurity_id' => 'zds.eqsecurity_id',
						'percent' => new Zend_Db_Expr('ROUND(((zds.eqsex + zds.eqbirthday + zds.eqheight + zds.eqrace + zds.eqfirstname_length + zds.eqlastname_length + zds.eqsecurity_id)/' . $countFields .') * 100)')
					)
				)
				->order('percent DESC')
				->joinLeft(array('us' => Model_Abstract::TBL_USER_STUDIES), 'us.user_id =' . $userInfo['id'], array());
				
			if (!$userInfo['all'])
			{
				$zds2->where('us.study_id = zds.study_id');
			}
				
			if ($perfect)
			{
				$zds3 = $this->_db
					->select()
					->from(array('zds' => $zds2))
					->limitPage($page, $ipp)
					->where('percent = 100');
			}
			else 
			{
				$zds3 = $this->_db
					->select()
					->from(array('zds' => $zds2))
					->limitPage($page, $ipp)
					->where('percent <> 100');
			}
			
			return $this->getAll($zds3);
		}
		
		return array();
	}
	
	public function getCounMath($values, $keyEncrypt, $countFields, $userInfo, $perfect = false)
	{
		$zds = $this->getPartZds($values, $keyEncrypt);
		
		if ($zds)
		{
			$zds2 = $this->_db
				->select()
				->from(array('zds' => $zds),
					array(
						'id' => 'zds.id',
						'sex' => 'zds.sex',
						'birthday' => 'zds.birthday',
						'height' => 'zds.height',
						'race' => 'zds.race',
						'firstname_length' => 'zds.firstname_length',
						'lastname_length' => 'zds.lastname_length',
						'security_id' => 'zds.security_id',
						'percent' => new Zend_Db_Expr('ROUND(((zds.eqsex + zds.eqbirthday + zds.eqheight + zds.eqrace + zds.eqfirstname_length + zds.eqlastname_length + zds.eqsecurity_id)/' . $countFields .') * 100)')
					)
				)
				->order('percent DESC')
				->joinLeft(array('us' => Model_Abstract::TBL_USER_STUDIES), 'us.user_id =' . $userInfo['id'], array());
				
			if (!$userInfo['all'])
			{
				$zds2->where('us.study_id = zds.study_id');
			}
			
			if ($perfect)
			{
				$zds3 = $this->_db
					->select()
					->from(array('zds' => $zds2), new Zend_Db_Expr('COUNT(*)'))
					->where('percent = 100');
			}
			else 
			{
				$zds3 = $this->_db
					->select()
					->from(array('zds' => $zds2), new Zend_Db_Expr('COUNT(*)'))
					->where('percent <> 100');
			}
			
			return (int)$this->_db->fetchOne($zds3);
		}

		return 0;
	}
	
	private function getPartZds($values, $keyEncrypt)
	{
		$zds = $this->_db
			->select()
			->from(array('p' => $this->_name),
				array(
					'study_id' => 'p.study_id',
					'id' => 'p.id',
					'sex' => new Zend_Db_Expr("AES_DECRYPT(p.sex, '" . $keyEncrypt . "')"),
					'birthday' => new Zend_Db_Expr("AES_DECRYPT(p.birthday, '" . $keyEncrypt . "')"),
					'height' => new Zend_Db_Expr("AES_DECRYPT(p.height, '" . $keyEncrypt . "')"),
					'race' => new Zend_Db_Expr("AES_DECRYPT(p.race, '" . $keyEncrypt . "')"),
					'firstname_length' => new Zend_Db_Expr("AES_DECRYPT(p.firstname_length, '" . $keyEncrypt . "')"),
					'lastname_length' => new Zend_Db_Expr("AES_DECRYPT(p.lastname_length, '" . $keyEncrypt . "')"),
					'security_id' => new Zend_Db_Expr("AES_DECRYPT(p.security_id, '" . $keyEncrypt . "')"),
					'eqsex' => new Zend_Db_Expr("IF(p.sex = AES_ENCRYPT('" . $values['sex'] . "', '" . $keyEncrypt . "') AND " . $this->_db->quote($values['sex']) . " <> '', '1', '0')"),
					'eqbirthday' => new Zend_Db_Expr("IF(p.birthday = AES_ENCRYPT('" . $values['birthday'] . "', '" . $keyEncrypt . "') AND " . $this->_db->quote($values['birthday']) . " <> '', '1', '0')"),
					'eqheight' => new Zend_Db_Expr("IF(p.height = AES_ENCRYPT('" . $values['height'] . "', '" . $keyEncrypt . "') AND " . $this->_db->quote($values['height']) . " <> '', '1', '0')"),
					'eqrace' => new Zend_Db_Expr("IF(p.race = AES_ENCRYPT('" . $values['race'] . "', '" . $keyEncrypt . "') AND " . $this->_db->quote($values['race']) . " <> '', '1', '0')"),
					'eqfirstname_length' => new Zend_Db_Expr("IF(p.firstname_length = AES_ENCRYPT('" . $values['firstname_length'] . "', '" . $keyEncrypt . "') AND " . $this->_db->quote($values['firstname_length']) . " <> '', '1', '0')"),
					'eqlastname_length' => new Zend_Db_Expr("IF(p.lastname_length = AES_ENCRYPT('" . $values['lastname_length'] . "', '" . $keyEncrypt . "') AND " . $this->_db->quote($values['lastname_length']) . " <> '', '1', '0')"),
					'eqsecurity_id' => new Zend_Db_Expr("IF(p.security_id = AES_ENCRYPT('" . $values['security_id'] . "', '" . $keyEncrypt . "') AND " . $this->_db->quote($values['security_id']) . " <> '', '1', '0')"),
				))
			->order('p.id');
			
		if ($values['sex'])
		{
			$zds->orWhere("p.sex = AES_ENCRYPT('" . $values['sex'] . "', '" . $keyEncrypt . "')");
			$flag = true;
		}
		if ($values['birthday'])
		{
			$zds->orWhere("p.birthday = AES_ENCRYPT('" . $values['birthday'] . "', '" . $keyEncrypt . "')");
			$flag = true;
		}
		if ($values['height'])
		{
			$zds->orWhere("p.height = AES_ENCRYPT('" . $values['height'] . "', '" . $keyEncrypt . "')");
			$flag = true;
		}
		if ($values['race'])
		{
			$zds->orWhere("p.race = AES_ENCRYPT('" . $values['race'] . "', '" . $keyEncrypt . "')");
			$flag = true;
		}
		if ($values['firstname_length'])
		{
			$zds->orWhere("p.firstname_length = AES_ENCRYPT('" . $values['firstname_length'] . "', '" . $keyEncrypt . "')");
			$flag = true;
		}
		if ($values['lastname_length'])
		{
			$zds->orWhere("p.lastname_length = AES_ENCRYPT('" . $values['lastname_length'] . "', '" . $keyEncrypt . "')");
			$flag = true;
		}
		if ($values['security_id'])
		{
			$zds->orWhere("p.security_id = AES_ENCRYPT('" . $values['security_id'] . "', '" . $keyEncrypt . "')");
			$flag = true;
		}
		
		return $flag ? $zds : null;
	}
	
	public function deleteByStudyId($study_id)
	{
		$zds = $this->_db
			->select()
			->from(array('p' => $this->_name), array('id' => 'p.id'))
			->where('p.study_id = ?', $study_id);
			
		$ids = $this->getCol($zds);
		
		foreach ($ids as $id)
		{
			$this->deleteById($id);
		}
	}
	
	public function getList($page, $ipp, $keyEncrypt, $study_id, $search = array())
	{
		$sql = $this->_db
		->select()
		->from($this->_name, array(
			'study_id' => 'study_id',
			'id' => 'id',
			'firstname' => new Zend_Db_Expr("AES_DECRYPT(firstname, '" . $keyEncrypt . "')"),
			'lastname' => new Zend_Db_Expr("AES_DECRYPT(lastname, '" . $keyEncrypt . "')"),
			'sex' => new Zend_Db_Expr("AES_DECRYPT(sex, '" . $keyEncrypt . "')"),
			'birthday' => new Zend_Db_Expr("AES_DECRYPT(birthday, '" . $keyEncrypt . "')"),
			'height' => new Zend_Db_Expr("AES_DECRYPT(height, '" . $keyEncrypt . "')"),
			'race' => new Zend_Db_Expr("AES_DECRYPT(race, '" . $keyEncrypt . "')"),
			'firstname_length' => new Zend_Db_Expr("AES_DECRYPT(firstname_length, '" . $keyEncrypt . "')"),
			'lastname_length' => new Zend_Db_Expr("AES_DECRYPT(lastname_length, '" . $keyEncrypt . "')"),
			'security_id' => new Zend_Db_Expr("AES_DECRYPT(security_id, '" . $keyEncrypt . "')"),
		))
		->where('study_id =?', $study_id);
		
		if ($search['sex'])
		{
			$sql->where("sex=AES_ENCRYPT('" . $search['sex'] . "', '" . $keyEncrypt . "')");
		}
		
		if ($search['name'])
		{
			$sql->where("firstname=AES_ENCRYPT('" . $search['name'] . "', '" . $keyEncrypt . "') OR lastname=AES_ENCRYPT('" . $search['name'] . "', '" . $keyEncrypt . "')");
		}
		
		$sql->limitPage($page, $ipp);
		
		return $this->_db->fetchAll($sql);
	}
	
	public function getCount($study_id, $keyEncrypt, $search = array())
	{
		$zds = $this->_db
			->select()
			->from($this->_name, array('count' => new Zend_Db_Expr('COUNT(*)')))
			->where('study_id = ?', $study_id);
			
		if ($search['sex'])
		{
			$zds->where("sex=AES_ENCRYPT('" . $search['sex'] . "', '" . $keyEncrypt . "')");
		}
		
		if ($search['name'])
		{
			$zds->where("firstname=AES_ENCRYPT('" . $search['name'] . "', '" . $keyEncrypt . "') OR lastname=AES_ENCRYPT('" . $search['name'] . "', '" . $keyEncrypt . "')");
		}
			
		return $this->_db->fetchOne($zds);
	} 
	
	public function getById($id, $keyEncrypt)
	{
		$zds = $this->_db
		->select()
		->from($this->_name, array(
			'study_id' => 'study_id',
			'id' => 'id',
			'firstname' => new Zend_Db_Expr("AES_DECRYPT(firstname, '" . $keyEncrypt . "')"),
			'lastname' => new Zend_Db_Expr("AES_DECRYPT(lastname, '" . $keyEncrypt . "')"),
			'sex' => new Zend_Db_Expr("AES_DECRYPT(sex, '" . $keyEncrypt . "')"),
			'birthday' => new Zend_Db_Expr("AES_DECRYPT(birthday, '" . $keyEncrypt . "')"),
			'height' => new Zend_Db_Expr("AES_DECRYPT(height, '" . $keyEncrypt . "')"),
			'race' => new Zend_Db_Expr("AES_DECRYPT(race, '" . $keyEncrypt . "')"),
			'firstname_length' => new Zend_Db_Expr("AES_DECRYPT(firstname_length, '" . $keyEncrypt . "')"),
			'lastname_length' => new Zend_Db_Expr("AES_DECRYPT(lastname_length, '" . $keyEncrypt . "')"),
			'security_id' => new Zend_Db_Expr("AES_DECRYPT(security_id, '" . $keyEncrypt . "')"),
		))
		->where('id =?', $id ? $id : 0);
		
		return $this->_db->fetchRow($zds);
	}
}
