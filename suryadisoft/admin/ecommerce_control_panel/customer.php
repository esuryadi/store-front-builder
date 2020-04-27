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
	if (isset($Action) && $Action == "Update")
		$query = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = $customer_id";
	else if (isset($Action) && $Action == "Add")
		$query = "SELECT * FROM CUSTOMER";
	else
		$query = "SELECT customer_id, customer_first_name, customer_last_name, customer_email, customer_phone_day as customer_phone FROM CUSTOMER";	
	$query_result = mysql_query($query);
	
	$field_list = $query_result;
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	if (!isset($refresh_user))
		$refresh_user = "false";
		
	$query2 = "SELECT user_id FROM USER";	
	$query_result2 = mysql_query($query2);
	while($rs2 = mysql_fetch_row($query_result2))
		$user [] = $rs2[0];
		
	if ($refresh_user == "true") {
		$query3 = "select * from USER where user_id = '$user_id'";
		$query_result3 = mysql_query($query3);
		$rs3 = mysql_fetch_row($query_result3);
		if ($customer_first_name == "") 
			$customer_first_name = $rs3[3];
		if ($customer_last_name == "")
			$customer_last_name = $rs3[4];
		if ($customer_email == "")
			$customer_email = $rs3[2];
	}
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Customer</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editCustomer(id) {
	var url = "customer.php?Action=Update&customer_id=" + id;
	open(url,"_self");
}

function deleteCustomer(id) {
	var url = "customer_result.php?Action=Delete&customer_id=" + id;
	open(url,"_self");
}

function getUserInfo(form) {
	form.action = "customer.php?refresh_user=true";
	form.method = "POST";
	form.submit();
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.customer_first_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "Customer First Name is required\n";
	}
	if (form.customer_last_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "Customer Last Name is required\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
</head>

<body vlink="00aeef">
<p><font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage 
  Customers</strong></font> </p>
<p align="right"> 
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#customer','help','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</p>
<p>
  <? if (isset($Action)) {?>
</p>
<form action="customer_result.php?" method="post" name="customerForm" id="customerForm">
  <input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update") {
				$rs = mysql_fetch_row($query_result);?>
				<input type="hidden" name="customer_id" value="<?=$rs[0]?>">
			<? }?>			 
			<? for($i=0;$i<count($field_name);$i++) { 
				if ($refresh_user == "true") {
					eval("\$value = \"\$" . $field_name[$i] . "\";");
					$field_value = stripslashes($value);
				}?>
			<tr>
				<? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>
      <td align="right" nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <?=str_replace("_"," ",$field_name[$i])?>
        :</font></td>
      	<td>
				<? if ($field_name[$i] == "user_id") {?>
				<select name="<?=$field_name[$i]?>" onchange="getUserInfo(this.form);">
				<option value="">-Select User ID-</option>
				<? for($n=0;$n<count($user);$n++) {?>
				<option value="<?=$user[$n]?>" <? if ($refresh_user == "true" && $user[$n] == $field_value) {?>selected<? } else if ($Action == "Update" && $user[$n] == $rs[$i]) {?>selected<? }?>><?=$user[$n]?></option>
				<? }?>
				</select>
				<? } else if ($field_name[$i] == "customer_state") {?>
				<select name="<?=$field_name[$i]?>">
				<option value="">Select States 
				</option>
				<option value="AL" <? if ($refresh_user == "true" && $field_value == "AL") {?>selected<? } else if ($Action == "Update" && $rs[12] == "AL") {?>selected<? }?>>AL-Alabama 
				</option>
				<option value="AK" <? if ($refresh_user == "true" && $field_value == "AK") {?>selected<? } else if ($Action == "Update" && $rs[12] == "AK") {?>selected<? }?>>AK-Alaska 
				</option>
				<option value="AZ" <? if ($refresh_user == "true" && $field_value == "AZ") {?>selected<? } else if ($Action == "Update" && $rs[12] == "AZ") {?>selected<? }?>>AZ-Arizona 
				</option>
				<option value="AR" <? if ($refresh_user == "true" && $field_value == "AR") {?>selected<? } else if ($Action == "Update" && $rs[12] == "AR") {?>selected<? }?>>AR-Arkansas 
				</option>
				<option value="CA" <? if ($refresh_user == "true" && $field_value == "CA") {?>selected<? } else if ($Action == "Update" && $rs[12] == "CA") {?>selected<? }?>>CA-California 
				</option>
				<option value="CO" <? if ($refresh_user == "true" && $field_value == "CO") {?>selected<? } else if ($Action == "Update" && $rs[12] == "CO") {?>selected<? }?>>CO-Colorado 
				</option>
				<option value="CT" <? if ($refresh_user == "true" && $field_value == "CT") {?>selected<? } else if ($Action == "Update" && $rs[12] == "CT") {?>selected<? }?>>CT-Connecticut 
				</option>
				<option value="DC" <? if ($refresh_user == "true" && $field_value == "DC") {?>selected<? } else if ($Action == "Update" && $rs[12] == "DC") {?>selected<? }?>>DC-Washington 
				D.C. </option>
				<option value="DE" <? if ($refresh_user == "true" && $field_value == "DE") {?>selected<? } else if ($Action == "Update" && $rs[12] == "DE") {?>selected<? }?>>DE-Delaware 
				</option>
				<option value="FL" <? if ($refresh_user == "true" && $field_value == "FL") {?>selected<? } else if ($Action == "Update" && $rs[12] == "FL") {?>selected<? }?>>FL-Florida 
				</option>
				<option value="GA" <? if ($refresh_user == "true" && $field_value == "GA") {?>selected<? } else if ($Action == "Update" && $rs[12] == "GA") {?>selected<? }?>>GA-Georgia 
				</option>
				<option value="HI" <? if ($refresh_user == "true" && $field_value == "HI") {?>selected<? } else if ($Action == "Update" && $rs[12] == "HI") {?>selected<? }?>>HI-Hawaii 
				</option>
				<option value="ID" <? if ($refresh_user == "true" && $field_value == "ID") {?>selected<? } else if ($Action == "Update" && $rs[12] == "ID") {?>selected<? }?>>ID-Idaho 
				</option>
				<option value="IL" <? if ($refresh_user == "true" && $field_value == "IL") {?>selected<? } else if ($Action == "Update" && $rs[12] == "IL") {?>selected<? }?>>IL-Illinois 
				</option>
				<option value="IN" <? if ($refresh_user == "true" && $field_value == "IN") {?>selected<? } else if ($Action == "Update" && $rs[12] == "IN") {?>selected<? }?>>IN-Indiana 
				</option>
				<option value="IA" <? if ($refresh_user == "true" && $field_value == "IA") {?>selected<? } else if ($Action == "Update" && $rs[12] == "IA") {?>selected<? }?>>IA-Iowa 
				</option>
				<option value="KS" <? if ($refresh_user == "true" && $field_value == "KS") {?>selected<? } else if ($Action == "Update" && $rs[12] == "KS") {?>selected<? }?>>KS-Kansas 
				</option>
				<option value="KY" <? if ($refresh_user == "true" && $field_value == "KY") {?>selected<? } else if ($Action == "Update" && $rs[12] == "KY") {?>selected<? }?>>KY-Kentucky 
				</option>
				<option value="LA" <? if ($refresh_user == "true" && $field_value == "LA") {?>selected<? } else if ($Action == "Update" && $rs[12] == "LA") {?>selected<? }?>>LA-Louisiana 
				</option>
				<option value="ME" <? if ($refresh_user == "true" && $field_value == "ME") {?>selected<? } else if ($Action == "Update" && $rs[12] == "ME") {?>selected<? }?>>ME-Maine 
				</option>
				<option value="MD" <? if ($refresh_user == "true" && $field_value == "MD") {?>selected<? } else if ($Action == "Update" && $rs[12] == "MD") {?>selected<? }?>>MD-Maryland 
				</option>
				<option value="MA" <? if ($refresh_user == "true" && $field_value == "MA") {?>selected<? } else if ($Action == "Update" && $rs[12] == "MA") {?>selected<? }?>>MA-Massachusetts 
				</option>
				<option value="MI" <? if ($refresh_user == "true" && $field_value == "MI") {?>selected<? } else if ($Action == "Update" && $rs[12] == "MI") {?>selected<? }?>>MI-Michigan 
				</option>
				<option value="MN" <? if ($refresh_user == "true" && $field_value == "MN") {?>selected<? } else if ($Action == "Update" && $rs[12] == "MN") {?>selected<? }?>>MN-Minnesota 
				</option>
				<option value="MS" <? if ($refresh_user == "true" && $field_value == "MS") {?>selected<? } else if ($Action == "Update" && $rs[12] == "MS") {?>selected<? }?>>MS-Mississippi 
				</option>
				<option value="MO" <? if ($refresh_user == "true" && $field_value == "MO") {?>selected<? } else if ($Action == "Update" && $rs[12] == "MO") {?>selected<? }?>>MO-Missouri 
				</option>
				<option value="MT" <? if ($refresh_user == "true" && $field_value == "MT") {?>selected<? } else if ($Action == "Update" && $rs[12] == "MT") {?>selected<? }?>>MT-Montana 
				</option>
				<option value="NE" <? if ($refresh_user == "true" && $field_value == "NE") {?>selected<? } else if ($Action == "Update" && $rs[12] == "NE") {?>selected<? }?>>NE-Nebraska 
				</option>
				<option value="NV" <? if ($refresh_user == "true" && $field_value == "NV") {?>selected<? } else if ($Action == "Update" && $rs[12] == "NV") {?>selected<? }?>>NV-Nevada 
				</option>
				<option value="NH" <? if ($refresh_user == "true" && $field_value == "NH") {?>selected<? } else if ($Action == "Update" && $rs[12] == "NH") {?>selected<? }?>>NH-New 
				Hampshire </option>
				<option value="NJ" <? if ($refresh_user == "true" && $field_value == "NJ") {?>selected<? } else if ($Action == "Update" && $rs[12] == "NJ") {?>selected<? }?>>NJ-New 
				Jersey </option>
				<option value="NM" <? if ($refresh_user == "true" && $field_value == "NM") {?>selected<? } else if ($Action == "Update" && $rs[12] == "NM") {?>selected<? }?>>NM-New 
				Mexico </option>
				<option value="NY" <? if ($refresh_user == "true" && $field_value == "NY") {?>selected<? } else if ($Action == "Update" && $rs[12] == "NY") {?>selected<? }?>>NY-New 
				York </option>
				<option value="NC" <? if ($refresh_user == "true" && $field_value == "NC") {?>selected<? } else if ($Action == "Update" && $rs[12] == "NC") {?>selected<? }?>>NC-North 
				Carolina </option>
				<option value="ND" <? if ($refresh_user == "true" && $field_value == "ND") {?>selected<? } else if ($Action == "Update" && $rs[12] == "ND") {?>selected<? }?>>ND-North 
				Dakota </option>
				<option value="OH" <? if ($refresh_user == "true" && $field_value == "OH") {?>selected<? } else if ($Action == "Update" && $rs[12] == "OH") {?>selected<? }?>>OH-Ohio 
				</option>
				<option value="OK" <? if ($refresh_user == "true" && $field_value == "OK") {?>selected<? } else if ($Action == "Update" && $rs[12] == "OK") {?>selected<? }?>>OK-Oklahoma 
				</option>
				<option value="OR" <? if ($refresh_user == "true" && $field_value == "OR") {?>selected<? } else if ($Action == "Update" && $rs[12] == "OR") {?>selected<? }?>>OR-Oregon 
				</option>
				<option value="PA" <? if ($refresh_user == "true" && $field_value == "PA") {?>selected<? } else if ($Action == "Update" && $rs[12] == "PA") {?>selected<? }?>>PA-Pennsylvania 
				</option>
				<option value="PR" <? if ($refresh_user == "true" && $field_value == "PR") {?>selected<? } else if ($Action == "Update" && $rs[12] == "PR") {?>selected<? }?>>PR-Puerto 
				Rico </option>
				<option value="RI" <? if ($refresh_user == "true" && $field_value == "RI") {?>selected<? } else if ($Action == "Update" && $rs[12] == "RI") {?>selected<? }?>>RI-Rhode 
				Island </option>
				<option value="SC" <? if ($refresh_user == "true" && $field_value == "SC") {?>selected<? } else if ($Action == "Update" && $rs[12] == "SC") {?>selected<? }?>>SC-South 
				Carolina </option>
				<option value="SD" <? if ($refresh_user == "true" && $field_value == "SD") {?>selected<? } else if ($Action == "Update" && $rs[12] == "SD") {?>selected<? }?>>SD-South 
				Dakota </option>
				<option value="TN" <? if ($refresh_user == "true" && $field_value == "TN") {?>selected<? } else if ($Action == "Update" && $rs[12] == "TN") {?>selected<? }?>>TN-Tennessee 
				</option>
				<option value="TX" <? if ($refresh_user == "true" && $field_value == "TX") {?>selected<? } else if ($Action == "Update" && $rs[12] == "TX") {?>selected<? }?>>TX-Texas 
				</option>
				<option value="UT" <? if ($refresh_user == "true" && $field_value == "UT") {?>selected<? } else if ($Action == "Update" && $rs[12] == "UT") {?>selected<? }?>>UT-Utah 
				</option>
				<option value="VT" <? if ($refresh_user == "true" && $field_value == "VT") {?>selected<? } else if ($Action == "Update" && $rs[12] == "VT") {?>selected<? }?>>VT-Vermont 
				</option>
				<option value="VA" <? if ($refresh_user == "true" && $field_value == "VA") {?>selected<? } else if ($Action == "Update" && $rs[12] == "VA") {?>selected<? }?>>VA-Virginia 
				</option>
				<option value="WA" <? if ($refresh_user == "true" && $field_value == "WA") {?>selected<? } else if ($Action == "Update" && $rs[12] == "WA") {?>selected<? }?>>WA-Washington 
				</option>
				<option value="WV" <? if ($refresh_user == "true" && $field_value == "WV") {?>selected<? } else if ($Action == "Update" && $rs[12] == "WV") {?>selected<? }?>>WV-West 
				Virginia </option>
				<option value="WI" <? if ($refresh_user == "true" && $field_value == "WI") {?>selected<? } else if ($Action == "Update" && $rs[12] == "WI") {?>selected<? }?>>WI-Wisconsin 
				</option>
				<option value="WY" <? if ($refresh_user == "true" && $field_value == "WY") {?>selected<? } else if ($Action == "Update" && $rs[12] == "WY") {?>selected<? }?>>WY-Wyoming 
				</option>
			</select>
				<? } else {?>
				<input name="<?=$field_name[$i]?>" type="text" value="<? if ($refresh_user == "true") {?><?=$field_value?><? } else if ($Action == "Update") {?><?=$rs[$i]?><? } else if ($field_name[$i] == "customer_country") {?>United States<? }?>" size="<? if ($i == 3) {?>1<? } else if ($i == 5) {?>30<? } else if ($i == 6 || $i == 7 || $i ==8) {?>12<? } else if ($i == 9 || $i == 10) {?>40<? } else if ($i == 13) {?>10<? } else {?>20<? }?>"> 
				<? }?>
				</td>
				<? } else {?>
				<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
				<? }?>
			</tr>
			<? }?>
		</table>
		<p>&nbsp;</p>
  <p> 
    <input type="submit" name="Submit" value="<?=$Action?> Customer" onClick="validateForm(this.form);">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
<p align="center"><a href="customer.php?Action=Add"><img src="../../images/new_customer.gif" width="101" height="21" border="0"></a></p>
<p align="center">
<table border="0" align="center" cellpadding="8" cellspacing="0">
<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>
    <th bgcolor="#999999"> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif" color="#FFFFFF"> 
      <?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
      </font></th>
		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
    <td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#dddddd<? } else {?>#FFFFFF<? }?>"> 
      <font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
				<? if ($field_name[$i] == "customer_id") {?>
					<a href="customer_info.php?customer_id=<?=$rs[$i]?>"><?=$rs[$i]?></a>
				<? } else if ($field_name[$i] == "customer_email") {?>
					<a href="mailto:<?=$rs[$i]?>"><?=$rs[$i]?></a>
				<? } else {?>
					<?=$rs[$i]?>
  			<? }?>
	    </font> </td>
		<? }?>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editCustomer('<?=$rs[0]?>');"></td>
		<td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteCustomer('<?=$rs[0]?>');"></td>
	</tr>
	<? }?>
</table>
<p>
<center>
    <a href="customer.php?Action=Add"><img src="../../images/new_customer.gif" width="101" height="21" border="0"></a> 
  </center>
</p>
<? }?>
</body>
</html>
