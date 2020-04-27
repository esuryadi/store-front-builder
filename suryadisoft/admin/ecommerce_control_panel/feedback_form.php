<?php
require_once "../config.php";

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? }?>
<html>
<head>
<title>Feedback Form</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<strong><font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">Feedback 
&amp; Suggestions</font></strong>
<form name="feedbackForm" method="post" action="submit_feedback.php">
  <p> 
    <textarea name="Feedback" rows="10" cols="50"></textarea>
  </p>
  <p> 
    <input type="submit" name="Submit" value="Submit">
    <input type="reset" name="Submit2" value="Reset">
  </p>
</form>
<p align="left">&nbsp;</p>
</body>
</html>
