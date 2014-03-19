<?php

class Validator_UniqueEmail extends Zend_Validate_Abstract
{
	const NOT_UNIQUE 				= 'notUnique';
	
	protected $_messageTemplates 	= array(
										self::NOT_UNIQUE => "E-mail '%value%' is already registered"
									);

	public function isValid($value)
	{
		$this->_setValue($value);
		$u = new Users();
		if($u->getByEmail($value)) 
		{
			$this->_error(self::NOT_UNIQUE);
			$isValid = false;
		}
		else 
		{
			$isValid = true;
		}
		
		return $isValid;
	}
}