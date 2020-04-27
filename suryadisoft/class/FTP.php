<?php
class FTP 
{
	var $source_file = "";
	var $dest_file = "";
	var $ftp_server = "72.3.139.160";
	var $ftp_user_name = "";
	var $ftp_user_pwd = "";
	
	function FTP ($ftp_user_name,$ftp_user_pwd,$source_file,$dest_file)
	{
		$this->ftp_user_name = $ftp_user_name;
		$this->ftp_user_pwd = $ftp_user_pwd;
		$this->dest_file = $dest_file;		
		$this->source_file = $source_file;
	}
	
	function setFTPServer ($ftp_server)
	{
		$this->ftp_server = $ftp_server;
	}
	
	function put()
	{
		
		// set up basic connection
		$conn_id = ftp_connect($this->ftp_server); 
		
		// login with username and password
		$login_result = ftp_login($conn_id, $this->ftp_user_name, $this->ftp_user_pwd); 
		
		// check connection
		if ((!$conn_id) || (!$login_result)) { 
			$msg = "FTP connection has failed!\n";
			$msg = $msg . "Attempted to connect to " . $this->ftp_server . " for user " . $this->ftp_user_name; 
			echo "<script>alert('". $msg . "');</script>";
		} else {
			//echo "<script>alert('Connected to " . $this->ftp_server . ", for user " . $this->ftp_user_name . "');</script>";
		}
		
		// upload the file
		$upload = ftp_put($conn_id, $this->dest_file, $this->source_file, FTP_BINARY); 

		// check upload status
		if (!$upload) { 
			echo "<script>alert('FTP upload has failed! Either the target directory doesn\'t exists or target filename is invalid.');</script>";
		} else {
			//echo "<script>alert('Uploaded " . $this->source_file . " to " . $this->ftp_server . " as " . $this->dest_file . "');</script>";
		}
		
		// close the FTP stream 
		//ftp_close($conn_id); 
	}
}
?>
