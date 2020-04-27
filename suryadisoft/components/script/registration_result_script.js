function signIn() {
	open("mystore.php?Page=SignIn","_self");
}

function registrationFailed() {
	open("mystore.php?Page=Registration&Status=failed&UserId=<?=$UserId?>","_self");
}
