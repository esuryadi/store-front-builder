<script src="<?=_URLPATH?>components/script/findDOM.js"></script>
<script language="JavaScript" type="text/JavaScript">

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
	if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
		document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
	else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_preloadImages() { //v3.0
	var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
		var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
		if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
	var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
		d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
	if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
	for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
	if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_nbGroup(event, grpName) { //v6.0
	var i,img,nbArr,args=MM_nbGroup.arguments;
	if (event == "init" && args.length > 2) {
		if ((img = MM_findObj(args[2])) != null && !img.MM_init) {
			img.MM_init = true; img.MM_up = args[3]; img.MM_dn = img.src;
			if ((nbArr = document[grpName]) == null) nbArr = document[grpName] = new Array();
			nbArr[nbArr.length] = img;
			for (i=4; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
				if (!img.MM_up) img.MM_up = img.src;
				img.src = img.MM_dn = args[i+1];
				nbArr[nbArr.length] = img;
		} }
	} else if (event == "over") {
		document.MM_nbOver = nbArr = new Array();
		for (i=1; i < args.length-1; i+=3) if ((img = MM_findObj(args[i])) != null) {
			if (!img.MM_up) img.MM_up = img.src;
			img.src = (img.MM_dn && args[i+2]) ? args[i+2] : ((args[i+1])? args[i+1] : img.MM_up);
			nbArr[nbArr.length] = img;
		}
	} else if (event == "out" ) {
		for (i=0; i < document.MM_nbOver.length; i++) {
			img = document.MM_nbOver[i]; img.src = (img.MM_dn) ? img.MM_dn : img.MM_up; }
	} else if (event == "down") {
		nbArr = document[grpName];
		if (nbArr)
			for (i=0; i < nbArr.length; i++) { img=nbArr[i]; img.src = img.MM_up; img.MM_dn = 0; }
		document[grpName] = nbArr = new Array();
		for (i=2; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
			if (!img.MM_up) img.MM_up = img.src;
			img.src = img.MM_dn = (args[i+1])? args[i+1] : img.MM_up;
			nbArr[nbArr.length] = img;
	} }
}

function MM_swapImgRestore() { //v3.0
	var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_swapImage() { //v3.0
	var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
	 if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

var coldColor = "<? if (WebContent::getPropertyValue("classic_link_color") != "") {?><?=WebContent::getPropertyValue("classic_link_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Link Color")?><? }?>"
var hotColor  = "<? if (WebContent::getPropertyValue("classic_active_link_color") != "") {?><?=WebContent::getPropertyValue("classic_active_link_color")?><? } else {?><?=$theme->getDefaultProperty("classic","Active Link Color")?><? }?>"
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
		document.write(a)	
}

function openURL(url) {
	open(url,"_self");
}

function changeBGColor(objectID,classname) {
	var dom = findDOM(objectID,0);
	dom.className = classname;
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

</script>
