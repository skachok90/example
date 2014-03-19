<?php
class Validator_EqualValues extends Zend_Validate_Abstract
{
	const NOT_EQUAL 				= 'notEqual';

	protected $_messageTemplates 	= array(
										self::NOT_EQUAL => 'Passwords do not match',
									);
	protected $_contextKey;

	public function __construct($key)
	{
		$this->_contextKey = $key;
	}

	public function isValid($value, $context = null)
	{
		if (is_array($context)) 
		{
			if (isset($context[$this->_contextKey]) && ($value === $context[$this->_contextKey])) 
			{
				return true;
			}
		}

		if ($value === $context) 
		{
			return true;
		}
		
		$this->_error(self::NOT_EQUAL);
		return false;
	}
}