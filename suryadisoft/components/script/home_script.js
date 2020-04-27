var login = "success";

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.UserId.value == "") {
		is_valid = false;
		err_msg = err_msg + "User Id cannot be empty\n";
	}
	if (form.Password.value == "") {
		is_valid = false;
		err_msg = err_msg + "Password cannot be empty\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}

function loginFailed() {
	login = "failed";
	open("mystore.php?Page=SignIn&Login=failed","_self");
}

<? if (isset($GoTo)) {?>
function goTo(to) {
	<? if (isset($ShoppingCartAction)) {?>
	if (to == "ShoppingCart")
		url = "<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$company_url?>/<? }?>mystore.php?Page=ShoppingCart&Action=<?=$ShoppingCartAction?>&ProductId=<?=$ProductId?><? if (isset($Color)) {?>&Color=<?=$Color?><? }?><? if (isset($Size)) {?>&Size=<?=$Size?><? }?><? if (isset($Choice)) {?>&Choice=<?=$Choice?><? }?><? if (isset($Quantity)) {?>&Quantity=<?=$Quantity?><? }?><? if (isset($UserId)) {?>&UserId=<?=$UserId?><? }?>&Login=" + login;
	<? }?>
	<? if (isset($WishListAction)) {?>
	if (to == "WishList")
		url = "mystore.php?Page=WishList&Action=<?=$WishListAction?>&ProductId=<?=$ProductId?><? if (isset($Color)) {?>&Color=<?=$Color?><? }?><? if (isset($Size)) {?>&Size=<?=$Size?><? }?><? if (isset($Choice)) {?>&Choice=<?=$Choice?><? }?>&Login=" + login;
	<? }?>
	if (to == "Account")
		url = "mystore.php?Page=Account&Login=" + login;

	open(url,"_self");
}
<? }?>		