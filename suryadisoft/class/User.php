<?php
class User 
{
	var $user_id;
	var $password;
	
	function User($user_id, $password) {
		$this->user_id = $user_id;
		$this->password = $password;
	}
	
	function setUserId($user_id) {
		$this->user_id = $user_id;
	}
	
	function setPassword($password) {
		$this->password = $password;
	}
	
	function getUserId() {
		return $this->user_id;
	}
	
	function getPassword() {
		return $this->password;
	}
}
?>
