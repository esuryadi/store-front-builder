<?php
require_once "../../class/User.php";
require_once "../../class/DBConnect.php";
require_once "../../class/WebContent.php";
require_once("../config.php");
define("_DB",$HTTP_SESSION_VARS["selected_db"]);
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
	if (isset($Action) && $Action == "Update")
		$query = "SELECT SPECIAL_PRICING.id AS id, USER.user_id AS user_id, PRODUCT.product_name AS product_name, SPECIAL_PRICING.product_price AS product_price FROM SPECIAL_PRICING, USER, PRODUCT WHERE USER.user_id = SPECIAL_PRICING.user_id AND PRODUCT.product_id = SPECIAL_PRICING.product_id AND ID = $id";
	else
		$query = "SELECT SPECIAL_PRICING.id AS id, USER.user_id AS user_id, PRODUCT.product_name AS product_name, SPECIAL_PRICING.product_price AS product_price FROM SPECIAL_PRICING, USER, PRODUCT WHERE USER.user_id = SPECIAL_PRICING.user_id AND PRODUCT.product_id = SPECIAL_PRICING.product_id ORDER BY USER.user_id, PRODUCT.product_name";
	$query_result = mysql_query($query);
	
	$field_list = $query_result;
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Special Pricing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editSpecialPricing(id) {
	var url = "special_pricing.php?Action=Update&id=" + id;
	open(url,"_self");
}

function deleteSpecialPricing(id) {
	var url = "special_pricing_result.php?Action=Delete&id=" + id;
	open(url,"_self");
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.product_price.value == "") {
		is_valid = false;
		err_msg = err_msg + "Product price is required\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
</head>

<body vlink="00aeef">
<p>
<font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
<strong>Manage Special Pricing</strong>
</font> 
</p>
<p align="right">
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#special_pricing','help','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</p>
<p>  
<? if (isset($Action)) {?>
<form action="special_pricing_result.php?" method="post" name="specialPricingForm" id="specialPricingForm">
  <input type="hidden" name="Action" value="<?=$Action?>"> 
  <? if ($Action == "Update")
		$rs = mysql_fetch_row($query_result);?>
  <input type="hidden" name="id" value="<? if ($Action == "Update") {?><?=$rs[0]?><? }?>">
	<table cellpadding="5" cellspacing="5">
		<tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">User ID:</font></td>
      <td> 
				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="user_id">
          <? $HTTP_SESSION_VARS["db_connect"]->open();
					mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
					$query = "SELECT USER_ID FROM USER ORDER BY user_id";
					$query_result = mysql_query($query);
					while ($result = mysql_fetch_row($query_result)) {?>
          <option value="<?=$result[0]?>" <? if ($Action == "Update" && $result[0] == $rs[1] || isset($product_id) && $product_id == $result[0]) {?>selected<? }?>> 
          <?=$result[0]?>
          </option>
          <? }
					$HTTP_SESSION_VARS["db_connect"]->close();?>
        </select>
        </font>
			</td>
    </tr>
		<tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Product Name:</font></td>
      <td> 
				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="product_id">
          <? $HTTP_SESSION_VARS["db_connect"]->open();
					mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
					$query = "SELECT PRODUCT_ID, PRODUCT_NAME FROM PRODUCT ORDER BY product_name";
					$query_result = mysql_query($query);
					while ($result = mysql_fetch_row($query_result)) {?>
          <option value="<?=$result[0]?>" <? if ($Action == "Update" && $result[0] == $rs[2] || isset($product_id) && $product_id == $result[0]) {?>selected<? }?>> 
          <?=$result[1]?>
          </option>
          <? }
					$HTTP_SESSION_VARS["db_connect"]->close();?>
        </select>
        </font>
			</td>
    </tr>
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Product Price:</font></td>
      <td> 
				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="product_price" type="text" value="<? if (isset($product_price)) {?><?=$product_price?><? } else if ($Action == "Update") {?><?=$rs[3]?><? }?>">
        </font>
			</td>
    </tr>
  </table>
	<p>&nbsp;</p>
  <p> 
		<input type="submit" name="Submit" value="<?=$Action?> Special Pricing" onClick="validateForm(this.form);">
		<input name="Reset" type="reset" id="Reset" value="Reset">
	</p>
</form>
<? } else {?>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="118" nowrap><a href="special_pricing.php?Action=Add">New Special 
      Pricing</a></td>
  </tr>
</table>
<br>
<center>
<table border="0" cellpadding="8" cellspacing="0">
	<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>
    <th bgcolor="#999999"> 
			<font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <strong><?=strtoupper(str_replace("_"," ",$field_name[$i]))?></strong> 
			</font>
		</th>
		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
    <td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>"> 
      <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
			<?=$rs[$i]?>
      </font>
		</td>
		<? }?>
    <td>
			<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="Update" type="button" id="Update" value="Edit" onClick="editSpecialPricing('<?=$rs[0]?>');">
      </font>
		</td>
    <td>
			<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteSpecialPricing('<?=$rs[0]?>');">
      </font>
		</td>
	</tr>
	<? }?>
</table>
</center>
<p>
<center>
	<table border="0" align="center" cellpadding="0" cellspacing="0">
		<tr> 
			<td nowrap width="118"><a href="special_pricing.php?Action=Add">New Special Pricing</a></td>
		</tr>
	</table>
</center>
</p>
<? }?>
</body>
</html>
