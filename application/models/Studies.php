<?php
class Studies extends Model_Abstract
{
	public function getList($page, $ipp, $sort = array())
	{
		$sql = $this->_db
		->select()
		->from($this->_name)
		->limitPage($page, $ipp);
		
		$sort = (array)$sort;
		
		switch (key($sort))
		{
			case 'name':
				$by = 'name';
				break;
				
			default:
				$by = 'id';
				break;
		}
		
		$dir = (reset($sort) == 'desc') ? 'desc' : 'asc';
		
		$sql->order($by . ' ' . $dir);
		
		return $this->_db->fetchAll($sql);
	}
	
	public function getByName($name) {
		$zds = $this->_db
			->select()
			->from($this->_name)
			->where('name = ?', $name);
			
		return $this->_db->fetchRow($zds);
	}
	
}
