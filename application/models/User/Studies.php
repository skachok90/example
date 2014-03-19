<?php
class User_Studies extends Model_Abstract
{
	public function deleteByUserId($id = 0)
	{
		if (!$id)
    	{
    		return false;
    	}
    	
    	$where =  'user_id = ' . (int)$id;
    	return parent::delete($where);
	}
}
