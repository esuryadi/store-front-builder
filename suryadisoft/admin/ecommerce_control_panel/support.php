<?php
require_once "../config.php";

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? }?>
<html>
<head>
<title>Technical Support</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Technical 
Support</strong></font> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
  <form name="supportForm" method="post" action="support_result.php">
  <p align="left">Subject: 
      <input type="text" name="Subject" size="40">
    </p>
  <p align="left">Severity:<b> </b> 
      <select name="Severity">
        <option value="Standard" selected>Standard</option>
        <option value="Urgent">Urgent</option>
        <option value="Emergency">Emergency</option>
      </select>
    </p>
  Description/Question:<br>
      <textarea name="Question" cols="50" rows="10"></textarea>
    <p> 
      <input type="submit" name="Submit" value="Submit">
      <input type="reset" name="Submit2" value="Reset">
    </p>
  </form>
  <p align="left">&nbsp;</p>
</font> 
</body>
</html>
