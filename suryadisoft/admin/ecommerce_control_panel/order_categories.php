<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");

if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? } else {
	$HTTP_SESSION_VARS["db_connect"]->open();
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	
	if ($cat == "main") {
		$table = "MAIN_CATEGORY";
		$title = "Main Category";
	} else if ($cat == "sub1") {
		$table = "SUB_CATEGORY_1";
		$title = "Sub Category 1";
	} else {
		$table = "SUB_CATEGORY_2";
		$title = "Sub Category 2";
	}
	
	if (isset($Action) && $Action == "Update") {
		for ($i=0;$i<count($category);$i++) {
			$query = "SELECT * FROM $table WHERE CATEGORY = '$category[$i]'";
			$num_rows = mysql_num_rows(mysql_query($query));
			if ($num_rows > 0)
				$query = "UPDATE $table SET SEQUENCE = $sequence[$i] WHERE CATEGORY = '$category[$i]'";
			else
				$query = "INSERT INTO $table (CATEGORY,SEQUENCE) VALUES ('$category[$i]','$sequence[$i]')";
			mysql_query($query);
		}
	}
	$query = "SELECT CATEGORIES_MAIN, SEQUENCE FROM CATEGORIES LEFT JOIN $table ON CATEGORY = CATEGORIES_MAIN GROUP BY CATEGORIES_MAIN ORDER BY SEQUENCE, CATEGORIES_ID";
	$query_result = mysql_query($query);
	
	
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>

<html>
<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<p><strong><a href="product_group.php"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Manage 
  Categories</font></a> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">&gt; 
  <font color="00AEEF">Arrange 
  <?=$title?> Order
  </font></font></strong> </p>
	<br>
<form name="orderCategoryForm" method="post" action="order_categories.php">
	<input type="hidden" name="cat" value="<?=$cat?>">
  <table border="1" cellpadding="3" cellspacing="0" bordercolor="#dddddd">
    <tr>
      <td nowrap bgcolor="#dddddd"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong><?=$title?></strong></font></td>
      <td bgcolor="#dddddd"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Order</strong></font></td>
		</tr>
		<? while($rs = mysql_fetch_row($query_result)) {?>
		<tr>
		<input type="hidden" name="Action" value="Update">
		<input type="hidden" name="category[]" value="<?=$rs[0]?>">
      <td nowrap>
        <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=$rs[0]?></font>
      </td>
      <td align="center"> <input type="text" name="sequence[]" value="<? if (isset($rs[1])) {?><?=$rs[1]?><? }?>" size="2"> 
      </td>
		</tr>
		<? }?>
</table>
  <p> 
  <input type="submit" name="Submit" value="Update">
  <input type="reset" name="Submit2" value="Reset">
</p>
</form>
</body>
</html>
