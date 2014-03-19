<?php

class Validator_ExistEmail extends Zend_Validate_Abstract
{
	const NOT_EXIST 				= 'notExist';
	
	protected $userId;
	protected $_messageTemplates 	= array(
										self::NOT_EXIST => "E-mail '%value%' is not registered",
									);

	public function isValid($value)
	{
		$this->_setValue($value);

		$u = new Users();

		if (!$u->getByEmail($value)) 
		{
			$this->_error(self::NOT_EXIST);
			return false;
		}
		
		return true;
	}
}