<?php
if (isset($Category))
	$Category = urldecode($Category);
else
	$Category = "ALL";
if (!isset($SubCategory1))
	$SubCategory1 = "";
else
	$SubCategory1 = urldecode($SubCategory1);
if (!isset($SubCategory2))
	$SubCategory2 = "";
else
	$SubCategory2 = urldecode($SubCategory2);
	
if (isset($HTTP_COOKIE_VARS["user"])) 
	$user = unserialize(stripslashes($HTTP_COOKIE_VARS["user"]));

if (isset($Category) && $Category == "ALL") {	
	if (isset($Action) && $Action == "login") {
		$user = new WebUser($UserId,$Password);
		$isVerified = $user->verify();
		if ($isVerified)
			setcookie("user",serialize($user),time() + 100000,"","",0);
		else
			unset($user);
	}
} 
$company_url = $adminuser->getCompanyURL();

if (isset($affiliate_id)) { 
	$affiliate = new Affiliate();
	$affiliate->setId($affiliate_id);
	$affiliate->increaseTotalHit();
	session_register("affiliate");
}
?>
