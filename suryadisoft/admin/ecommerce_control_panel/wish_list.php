<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once("../config.php");
?>
<html>
<head>
<?php
if (!isset($HTTP_SESSION_VARS["selected_db"]) || $HTTP_SESSION_VARS["selected_db"] == NULL) {?>
<script language="javascript">
window.open("../login.php?Action=logout&session_out=true","_top");
</script>
<? } else {
	$HTTP_SESSION_VARS["db_connect"]->open();
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	
	$query = "SELECT WISH_LIST.ID, WISH_LIST.USER_ID, PRODUCT.PRODUCT_NAME, WISH_LIST.PRODUCT_COLOR, WISH_LIST.PRODUCT_SIZE, WISH_LIST.PRODUCT_CHOICE, WISH_LIST.WISH_LIST_QUANTITY FROM WISH_LIST, PRODUCT WHERE PRODUCT.PRODUCT_ID = WISH_LIST.PRODUCT_ID";	
	$query_result = mysql_query($query);
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Wish List</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function deleteItem(id) {
	var url = "wish_list_result.php?Action=Delete&id=" + id;
	open(url,"_self");
}

function emptyWishList() {
	var url = "wish_list_result.php?Action=Empty";
	open(url,"_self");
}
</script>
</head>

<body vlink="00aeef" bgcolor="#FFFFFF" text="#000000">
<font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage 
Wish List</strong></font> 
<p align="right">
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#wish_list','help','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</p>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table border="0" cellpadding="8" cellspacing="0" align="center">
        <tr> 
          <th bgcolor="#999999" nowrap><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">USER 
            ID</font></th>
          <th bgcolor="#999999" nowrap><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">ITEM</font></th>
          <th bgcolor="#999999" nowrap><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">PRODUCT COLOR</font></th>
					<th bgcolor="#999999" nowrap><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">PRODUCT SIZE</font></th>
					<th bgcolor="#999999" nowrap><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">PRODUCT CHOICE</font></th>
					<th bgcolor="#999999" nowrap><font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">QUANTITY</font></th>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<? if ($i != 0) {?>
			<td align="<? if (stristr(mysql_field_type($query_result,$i),"INT") || stristr(mysql_field_type($query_result,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
        <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
				<?=$rs[$i]?>
        </font> 
			</td>
			<? }?>
		<? }?>
		<td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteItem('<?=$rs[0]?>');"></td>
	</tr>
	<? }?>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td> <center>
    <input type="button" name="empty" value="Empty Wish List" onClick="emptyWishList();">
      </center></td>
  </tr>
</table>
<p> </p>
</body>
</html>
