<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Component Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<div align="center">
  <p>&nbsp;</p>
  <p><strong>Component Login</strong></p>
  <form action="initialize.php" method="post" name="loginForm" id="loginForm">
  	<input type="hidden" name="component" value="<?=$component?>">
  	<input type="hidden" name="Action" value="<?=$Action?>">
	<? if ($component == "product") {?>
	<input type="hidden" name="Mode" value="<?=$Mode?>">
	<input type="hidden" name="page_name" value="<?=urldecode($page_name)?>">
	<input type="hidden" name="page_category" value="<?=$page_category?>">
	<input type="hidden" name="main_category" value="<?=urldecode($main_category)?>">
	<input type="hidden" name="comp_type" value="<?=$comp_type?>">
	<? } else {?>
	<input type="hidden" name="selected_component" value="<?=$selected_component?>">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="hidden" name="main_category" value="<?=urldecode($main_category)?>">
	<? }?>
    <table border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td align="right"><strong>Username:</strong></td>
        <td><input name="userid" type="text" id="userid" size="15"></td>
      </tr>
      <tr>
        <td align="right"><strong>Password:</strong></td>
        <td><input name="password" type="password" id="password" size="15"></td>
      </tr>
      <tr align="center">
        <td colspan="2"><input name="LoginBtn" type="submit" id="LoginBtn" value="Login">
        <input name="resetBtn" type="reset" id="resetBtn" value="Reset"></td>
      </tr>
    </table>
  </form>
  <p><strong>Use your Store Manager Login Username and Password</strong></p>
</div>
</body>
</html>
<script language="javascript">
<!--
document.loginForm.userid.focus();
-->
</script>