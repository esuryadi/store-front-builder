<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Admin.php";
require_once("config.php");
?>
<html>
<head>
<title>Administrator Control Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<frameset rows="80,*" cols="*" frameborder="NO" border="0" framespacing="0"> 
  <frame name="topFrame" scrolling="NO" noresize src="menu_top.htm" >
  <frameset cols="173,*" frameborder="NO" border="0" framespacing="0" rows="*"> 
    <frame name="leftFrame" noresize scrolling="NO" src="menu_left.php">
		<? if ($HTTP_SESSION_VARS["admin_user"]->getRole() == "Sales") {?>
		<frame name="mainFrame" src="sales_associate_data.php">
		<? } else {?>
    <frame name="mainFrame" src="manage_admin.php">
		<? }?>
  </frameset>
</frameset>
<noframes>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">

</body>
</noframes> 
</html>
