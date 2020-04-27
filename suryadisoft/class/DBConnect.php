<?php
class DBConnect 
	extends User
{
	var $server;
	var $connection;
	
	function DBConnect($server, $user_id, $password) {
		$this->server = $server;
		$this->user_id = $user_id;
		$this->password = $password;
	}
	
	function setServer($server) {
		$this->server = $server;
	}
	
	function getServer() {
		return $this->server;
	}

	function open() {
		$this->connection = mysql_connect ($this->server, $this->user_id, $this->password);
	}
	
	function close() {
		mysql_close($this->connection);
	}
	
	function getConnection() {
		return $this->connection;
	}	
}
?>
