<?php
class Validator_ValidName extends Zend_Validate_Abstract
{
	const NOT_EMPTY				= 'notEmpty';

	protected $_messageTemplates 	= array(
										self::NOT_EMPTY=> 'Value is required and can\'t be empty',
									);
	protected $_contextKey;

	public function __construct($key)
	{
		$this->_contextKey = $key;
	}

	public function isValid($value, $context = null)
	{
		if (!$context['studies'] && !$value) 
		{
			$this->_error(self::NOT_EMPTY);
			return false;
		}
		
		return true;
	}
}