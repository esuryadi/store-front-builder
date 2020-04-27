<?php
require_once("../config.php");
?>
<html>
<head>
<title>Execute Query</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body vlink="00aeef">
<h1 align="center">Execute SQL Query Statement</h1>
<p align="center">&nbsp;</p>
<form action="execute_query_result.php" method="post" name="ExecuteQueryForm" id="ExecuteQueryForm">
  <p>Database: <?=$HTTP_SESSION_VARS["selected_db"]?></p>
	<input type="hidden" name="DatabaseName" value="<?=$HTTP_SESSION_VARS['selected_db']?>">
  <p>SQL Statement:</p>
  <p> 
    <textarea name="SQLStatement" cols="50" rows="5"></textarea>
  </p>
  <p>&nbsp; </p>
  <p align="center"> 
    <input type="submit" name="Submit" value="Execute Query">
    <input type="reset" name="Submit2" value="Reset">
  </p>
</form>
<p align="left">&nbsp;</p>
</body>
</html>
