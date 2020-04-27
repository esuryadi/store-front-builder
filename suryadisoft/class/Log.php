<?php
class Log
{
	var $log_file = "";
	
	function Log()
	{
		$this->log_file = "log.txt";
		if (!file_exists($this->log_file)) {
			touch($this->log_file);
			chmod($this->log_file,0666);
		}
	}
	
	function write($text)
	{
		if (!isset($this->log_file) || $this->log_file == "")
			$filename = _LOG;
		else
			$filename = $this->log_file;
		$log = fopen($filename,"a+");
		fwrite($log,$text);
		fclose($log);
	}
	
	function writeToFile($file,$text)
	{
		$log = fopen($file,"a+");
		fwrite($log,$text);
		fclose($log);
	}
}
?>
