<?php
$user = new WebUser($UserId,$Password);
$user->setFirstName($FirstName);
$user->setLastName($LastName);
$user->setEmail($Email);
$isSuccess = $user->record();
if ($isSuccess)
	$user->mailNewUserInfo();
?>
