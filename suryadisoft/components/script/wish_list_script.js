function addToShoppingCart(user_id,product_id,color,size,choice,quantity) {
	var url = "<? if (WebContent::getPropertyValue("use_ssl") == "Yes") {?>https://<?=$company_url?>/<? }?>mystore.php?Page=ShoppingCart&Action=Add&UserId=" + user_id + "&ProductId=" + product_id + "&Color=" + color + "&Size=" + size + "&Choice=" + choice + "&Quantity=" + quantity;
	open(url,"_self");
}

function updateChoices(form) {
	form.action = "mystore.php?Page=WishList";
	form.method = "POST";
	form.submit();
}

function deleteItem(product_id,quantity) {
	var url = "mystore.php?Page=WishList&Action=Delete&ProductId=" + product_id + "&Quantity=" + quantity;
	open(url,"_self");
}

<? if ($Action == "Add" && !isset($user)) {?>
function signIn() {
	var url = "mystore.php?Page=SignIn&GoTo=WishList&Action=<?=$Action?><? if (isset($ProductId)) {?>&ProductId=<?=$ProductId?><? }?><? if (isset($Color)) {?>&Color=<?=$Color?><? }?><? if (isset($Size)) {?>&Size=<?=$Size?><? }?><? if (isset($Choice)) {?>&Choice=<?=$Choice?><? }?><? if (isset($Login)) {?>&Login=<?=$Login?><? }?>";
	open(url,"_self");
}
<? }?>

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
