<?php
class Requests extends Model_Abstract
{
	public function insert(array $values, $keyEncrypt)
	{
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
		
		if (isset($values['firstname']))
		{
			$data['firstname'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['firstname'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['lastname']))
		{
			$data['lastname'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['lastname'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['security_id']))
		{
			$data['security_id'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['security_id'] . "', '" . $keyEncrypt . "')");
		}
		
		parent::insert($data);
	}
	
	public function update($id, array $values, $keyEncrypt)
	{
		if (!($id = (int)$id))
		{
			throw new Exception_Model('$id');
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
		
		if (isset($values['firstname']))
		{
			$data['firstname'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['firstname'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['lastname']))
		{
			$data['lastname'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['lastname'] . "', '" . $keyEncrypt . "')");
		}
		
		if (isset($values['security_id']))
		{
			$data['security_id'] = new Zend_Db_Expr("AES_ENCRYPT('" . $values['security_id'] . "', '" . $keyEncrypt . "')");
		}
		
		parent::update($id, $data);
	}
	
	public function getList($page, $ipp, $keyEncrypt)
	{
		$sql = $this->_db
		->select()
		->from($this->_name, array(
			'id' => 'id',
			'sex' => new Zend_Db_Expr("AES_DECRYPT(sex, '" . $keyEncrypt . "')"),
			'birthday' => new Zend_Db_Expr("AES_DECRYPT(birthday, '" . $keyEncrypt . "')"),
			'height' => new Zend_Db_Expr("AES_DECRYPT(height, '" . $keyEncrypt . "')"),
			'race' => new Zend_Db_Expr("AES_DECRYPT(race, '" . $keyEncrypt . "')"),
			'firstname' => new Zend_Db_Expr("AES_DECRYPT(firstname, '" . $keyEncrypt . "')"),
			'lastname' => new Zend_Db_Expr("AES_DECRYPT(lastname, '" . $keyEncrypt . "')"),
			'security_id' => new Zend_Db_Expr("AES_DECRYPT(security_id, '" . $keyEncrypt . "')"),
		))
		->limitPage($page, $ipp);
		
		return $this->_db->fetchAll($sql);
	}
	
	public function getById($id, $keyEncrypt)
	{
		$zds = $this->_db
		->select()
		->from($this->_name, array(
			'id' => 'id',
			'sex' => new Zend_Db_Expr("AES_DECRYPT(sex, '" . $keyEncrypt . "')"),
			'birthday' => new Zend_Db_Expr("AES_DECRYPT(birthday, '" . $keyEncrypt . "')"),
			'height' => new Zend_Db_Expr("AES_DECRYPT(height, '" . $keyEncrypt . "')"),
			'race' => new Zend_Db_Expr("AES_DECRYPT(race, '" . $keyEncrypt . "')"),
			'firstname' => new Zend_Db_Expr("AES_DECRYPT(firstname, '" . $keyEncrypt . "')"),
			'lastname' => new Zend_Db_Expr("AES_DECRYPT(lastname, '" . $keyEncrypt . "')"),
			'security_id' => new Zend_Db_Expr("AES_DECRYPT(security_id, '" . $keyEncrypt . "')"),
		))
		->where('id =?', $id ? $id : 0);
		
		return $this->_db->fetchRow($zds);
	}
	
}
