<?php
class Helper_DebugLog extends Zend_Controller_Action_Helper_Abstract
{
	const LOG_NAME = 'files/debug-log.txt';
	const END_LINE = "\r\n";
	const END_LOG = "= = = = = = = = = = = = = = = =";

	public function direct($data = null)
	{
		$date = new Zend_Date();
		$file = fopen(self::LOG_NAME, 'a+');

		if (!$data)
		{
			$data = array('REQUEST' => $_REQUEST);
		}

		fwrite($file, "Log at " . $date->get(Zend_Date::DATETIME) . ":" . self::END_LINE);

		foreach ($data as $key => $val)
		{
			fwrite($file, "[" . $key . "]: ");
			fwrite($file, print_r($val, true));
			fwrite($file, self::END_LINE);
		}

		fwrite($file, self::END_LOG . self::END_LINE . self::END_LINE);
		fclose($file);

		return true;
	}

}
