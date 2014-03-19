<?php

class Validator_ExtensionFile extends Zend_Validate_Abstract
{
	const NOT_EQUAL 				= 'notEqual';
	
	protected $userId;
	protected $_messageTemplates 	= array(
										self::NOT_EQUAL => "This type of extensions not appropriate",
									);

	public function isValid($value)
	{
		foreach ($_FILES as $files)
		{
			if ($files['tmp_name'] == $value)
			{
				$mass = explode('.', $files['name']);
				if (end($mass) == 'csv')
				{
					return true;
				}
			}
		}
		
		$this->_error(self::NOT_EQUAL);
		return false;
	}
}