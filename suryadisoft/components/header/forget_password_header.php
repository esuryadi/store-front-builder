<?php
if (isset($Action) && $Action == "EmailPassword") {
	$webuser = new WebUser("","");
	$webuser->setUserId($UserId);
	$isPasswordMailed = $webuser->mailPassword();
}
?>
