<?php
class Helper_Routines extends Zend_Controller_Action_Helper_Abstract
{
	public function cryptPassword($str)
	{
		return md5($str);
	}

	public function generateRandomString($length = 32)
	{
		$str = '';
		for ($i = 0; $i < $length; $i++)
		{
			if (rand(0, 1))
			{
				$str .= chr(rand(48, 57));	//0 - 9
			}
			else
			{
				$str .= chr(rand(97, 122));	//a - z
			}
		}

		return $str;
	}

	public function getSecretCode($userInfo)
	{
		return md5(serialize(array(
			$userInfo['id'],
			$userInfo['email'],
			$userInfo['password'],
			$userInfo['registration_id'],
			$userInfo['resp_party'],
			$userInfo['institutional_name'],
			$userInfo['phone'],
			$userInfo['payment_method'],
		)));
	}

	public function getSiteUrl($uri)
	{
		$filter = new Filter_Host();

		return $filter->filter($uri);
	}

	public function percent($value, $total = 100)
	{
		return round(($value * 100) / $total, 1) . '%';
	}

	public function getIntroStr($text, $length = 200)
	{
		$text = strip_tags($text);
		$encoding = mb_detect_encoding($text);

		if (mb_strlen($text, $encoding) > $length)
		{
			$text = mb_substr($text, 0, $length - 3, $encoding);

			$tmp = explode(' ', $text);
			unset($tmp[count($tmp) - 1]);
			$text = implode(' ', $tmp);

			$text_length = mb_strlen($text, $encoding);
			$last_symbol = $text[$text_length - 1];
			if (in_array($last_symbol, array(
				'.',
				','
			)))
			{
				$text = mb_substr($text, 0, $text_length - 1, $encoding);
			}

			$text .= '...';
		}

		return mb_substr($text, 0, $length, $encoding);
	}

	public function cutStr($text, $length = 200)
	{
		$text = strip_tags($text);

		if (mb_strlen($text, mb_detect_encoding($text)) > $length)
		{
			$text = mb_substr($text, 0, $length - 3, mb_detect_encoding($text));

			$text .= '...';
		}

		return mb_substr($text, 0, $length, mb_detect_encoding($text));
	}

	public function exportDataToCSV($data, array $columns, $filename = 'export', array $delimiters = array())
	{
		$delimiters = $delimiters ? $delimiters : array(
			'row' => "\r",
			'col' => ",",
		);

		$csv = implode($delimiters['col'], array_values($columns));

		for ($i = 0, $sz = count($data); $i < $sz; $i++)
		{
			$row = array();

			foreach ($columns as $key => $value)
			{
				$row[] = $data[$i][$key];
			}

			$csv .= $delimiters['row'] . implode($delimiters['col'], $row);
		}

		//$csv = chr(hexdec('FF')) . chr(hexdec('FE')) . mb_convert_encoding($csv, "UTF-16LE", mb_detect_encoding($csv));
		header("Content-type: text/csv");
		header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
		echo $csv;
		exit ;
	}

}
