<?php
class Helper_CSV extends Zend_Controller_Action_Helper_Abstract
{
	private $lineSeparators 		= array(
										"\r\n",
										"\r",
										"\n",
									);
	
	public function parseCSV($tmpName, $stringSeparator = '"', $valueSeparator = ";", $lineSeparator = '')
	{
		$content = file_get_contents($tmpName);
		
		if (!$lineSeparator)
		{
			for ($i = 0; $i < count($this->lineSeparators); $i++) 
			{
				if (strpos($content, $this->lineSeparators[$i]))
				{
					$lineSeparator = $this->lineSeparators[$i];
					break;
				}
			}
		}
		
		$lines = explode($lineSeparator, $content);
		$keys = trim(strtolower(str_replace('"', '', reset($lines))));
		$keys = explode($valueSeparator, $keys);
		unset($lines[0]);

		$data = array();
		for ($i = 1, $sz = count($lines); $i < $sz; $i++)
		{
			$line = trim($lines[$i]);
			if ($line)
			{
				$values = explode($valueSeparator, $line);
				for ($j = 0, $szv = count($values); $j < $szv; $j++)
				{
					$data[$i][$keys[$j]] = trim($values[$j], $stringSeparator);
				}
			}
		}
		
		return $data;
	}
	
	public function export($data, array $columns, $filename = 'export', array $delimiters = array())
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
		exit;
	}
}