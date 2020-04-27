<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<frameset rows="*" cols="200,*" framespacing="0" frameborder="NO" border="0">
	<frame src="menu_left.php?page=<?=$page?>" name="leftFrame" scrolling="NO" noresize>
	<? if ($page == "manage_store") {?>
		<frame src="web_content_frame.php" name="mainFrame">
	<? } else if ($page == "support") {?>
		<frame src="support.php" name="mainFrame">
	<? } else if ($page == "tools") {?>
		<frame src="ftp.php" name="mainFrame">
	<? }?>
	
</frameset>
<noframes><body>

</body></noframes>
</html>
