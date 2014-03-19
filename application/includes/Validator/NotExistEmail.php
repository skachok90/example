<?php

class Validator_NotExistEmail extends Zend_Validate_Abstract
{
	const EXIST 				= 'exist';
	
	protected $userId;
	protected $_messageTemplates 	= array(
										self::EXIST => "E-mail '%value%' is already registered",
									);

	public function isValid($value)
	{
		$this->_setValue($value);

		$u = new Users();

		if ($u->getByEmail($value))
		{
			$this->_error(self::EXIST);
			return false;
		}
		
		return true;
	}
}