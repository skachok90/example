<?php
class Users extends Model_Abstract
{
	const ROLE_GUEST 				= 'guest';
	const ROLE_USER 				= 'user';
	
	public static $payment = array(
		'Credit card',
		'Institutional check',
		'Money transfer',
	);
	
	protected $_requiredCols 		= array(
										'email',
										'password',
										'name',
									);
	
	public function getByEmail($email)
	{
		$zds = $this->all()
		->where('email = ?', $email);
		
		return $this->getRow($zds);
	}
	
	public function getList($page, $ipp, $sort = array())
	{
		$sql = $this->_db
		->select()
		->from($this->_name)
		->limitPage($page, $ipp);
		
		$sort = (array)$sort;
		
		switch (key($sort))
		{
			case 'email':
				$by = 'email';
				break;
				
			case 'phone':
				$by = 'phone';
				break;
				
			case 'registration_id':
				$by = 'registration_id';
				break;
				
			case 'resp_party':
				$by = 'resp_party';
				break;
				
			case 'institutional_name':
				$by = 'institutional_name';
				break;
				
			case 'payment_method':
				$by = 'payment_method';
				break;
				
			case 'id':
			default:
				$by = 'id';
				break;
		}
		
		$dir = (reset($sort) == 'desc') ? 'desc' : 'asc';
		
		$sql->order($by . ' ' . $dir);
		
		return $this->_db->fetchAll($sql);
	}
	
	public function getStudiesById($id)
	{
		$zds = $this->_db
			->select()
			->from(array('u' => $this->_name), array())
			->joinLeft(array('us' => Model_Abstract::TBL_USER_STUDIES), 'u.id = us.user_id', array())
			->joinLeft(array('s' => Model_Abstract::TBL_STUDIES), 's.id = us.study_id')
			->where('u.id = ?', $id);
			
		return $this->getAll($zds);
	}
}
