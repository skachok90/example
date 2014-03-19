<?php
class Exception_Model extends Zend_Exception
{
	const ERROR_SPECIFIED			= '%s must be specified';
	const ERROR_INVALID				= 'Invalid %s';
	const ERROR_RECORD_NOT_FOUND 	= "Record not found";
	const ERROR_SELF				= '%s';
		
	public function __construct($msg, $type = self::ERROR_INVALID)
	{
		$trace = $this->getTrace();
		$pre = $trace[0]['class'] . '::' . $trace[0]['function'] . ' - ';
		
		$error = $pre . sprintf($type, $msg);
		
		parent::__construct($error);
	}
}
