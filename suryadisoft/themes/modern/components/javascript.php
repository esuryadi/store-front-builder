<script src="<?=_URLPATH?>components/script/findDOM.js"></script>
<script language="JavaScript">

var coldColor = "<?=WebContent::getPropertyValue("modern_link_color")?>"
var hotColor  = "<?=WebContent::getPropertyValue("modern_active_link_color")?>"
var motionPix = "0"
var a='<style>'+
'A.InstantLink:link {'+
'  color:'+coldColor+';'+
'  text-decoration:none;'+
'  padding:0 '+motionPix+' 0 0;'+
'  }'+  
'A.InstantLink:visited {'+
'  color:'+coldColor+';'+
'  text-decoration:none;'+
'  padding:0 '+motionPix+' 0 0;}'+  
'A.InstantLink:active {'+
'  color:'+coldColor+';'+
'  text-decoration:none;'+
'  padding:0 '+motionPix+' 0 0;'+
'  }'+  
'A.InstantLink:hover {'+
'  color:'+hotColor+';'+
'  text-decoration:underline;'+
'  padding:0 0 0 '+motionPix+';'+
'  }'+
'</style>'

if (document.all || document.getElementById) {
		document.write(a);
}

function openURL(url) {
	open(url,"_self");
}

<?php
if ($Page == "Home") {
	include(_COMPONENTPATH . "script/home_script.js");
} else if ($Page == "ShoppingCart") {
	include(_COMPONENTPATH . "script/shopping_cart_script.js");
} else if ($Page == "WishList") {
	include(_COMPONENTPATH . "script/wish_list_script.js");
} else if ($Page == "FindWishList") {
	include(_COMPONENTPATH . "script/find_wish_list_script.js");
} else if ($Page == "Account") {
	include(_COMPONENTPATH . "script/account_script.js");
} else if ($Page == "SignIn") {
	include(_COMPONENTPATH . "script/sign_in_script.js");
} else if ($Page == "SignOut") {
	include(_COMPONENTPATH . "script/sign_out_script.js");
} else if ($Page == "Registration") {
	include(_COMPONENTPATH . "script/registration_script.js");
} else if ($Page == "RegistrationResult") {
	include(_COMPONENTPATH . "script/registration_result_script.js");
} else if ($Page == "ForgetPassword") {
	include(_COMPONENTPATH . "script/forget_password_script.js");
} else if ($Page == "CheckOut1") {
	include(_COMPONENTPATH . "script/check_out_step_1_script.js");
} else if ($Page == "CheckOut2") {
	include(_COMPONENTPATH . "script/check_out_step_2_script.js");
} else if ($Page == "ReviewOrder") {
	include(_COMPONENTPATH . "script/review_order_script.js");
}
?>

function changeBGColor(objectID,classname) {
	var dom = findDOM(objectID,0);
	dom.className = classname;
}

var lastObject = "";
var extra_space = 0;
function setVisibility(objectID,state,pos,extra) {	
	if (objectID != "") {
		var dom = findDOM(objectID,1);
		dom.visibility = state;
		dom.left = 178;
		dom.top = <?=$top?> + pos + extra;			
	}
	if (lastObject != "" && lastObject != objectID) {
		var dom2 = findDOM(lastObject,1);
		dom2.visibility = "hidden";
	}
	if (objectID == "" && lastObject != "") {
		var dom3 = findDOM(lastObject,1);
		dom3.visibility = state;
		dom3.left = 178;
	}
	lastObject = objectID;
}

</script>