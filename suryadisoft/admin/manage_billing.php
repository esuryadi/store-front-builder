<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once("config.php");
?>
<html>
<head>
<?php
$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);

$query = "SELECT user_id from USER WHERE user_id <> 'admin'";
$query_result = mysql_query($query);
while ($rs = mysql_fetch_row($query_result))
	$userid [] = $rs[0];
	
if (!isset($user_id))
	$user_id = $userid[0];
	
$query = "SELECT first_name, last_name FROM USER WHERE USER.user_id = '$user_id'";
$rs = mysql_fetch_row(mysql_query($query));
$first_name = $rs[0];
$last_name = $rs[1];
	
if (isset($Action) && $Action == "Update")
	$query = "SELECT * FROM BILLING WHERE user_id = '$user_id'";
else if (isset($Action) && $Action == "Add")
	$query = "SELECT * FROM BILLING";
else
	$query = "SELECT order_date, user_id, billing_first_name, billing_last_name, monthly_fee FROM BILLING ORDER BY order_date";	
$query_result = mysql_query($query);

$field_list = $query_result;
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$db_connect->close();
?>
<title>Manage Billing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function editBilling(id) {
	var url = "manage_billing.php?Action=Update&user_id=" + id;
	open(url,"_self");
}

function deleteBilling(id) {
	var url = "manage_billing_result.php?Action=Delete&user_id=" + id;
	open(url,"_self");
}

function charge(id) {
	var url = "manage_billing_result.php?Action=Charge&user_id=" + id;
	open(url,"_self");
}

function changeUser(action,id) {
	var url = "manage_billing.php?Action=" + action + "&user_id=" + id;
	open(url,"_self");
}
</script>
</head>

<body vlink="00aeef">
<p><font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
  <strong>Manage Billing </strong> </font> </p>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Today's Date: 
  <?=date("Y-m-d H:i:s")?>
  </b></font></p>
<? if (isset($Action)) {?>
<form action="manage_billing_result.php?" method="post" name="billingForm" id="billingForm">
		<input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
		<? if ($Action == "Update") {
			$rs = mysql_fetch_array($query_result);?>
			<input type="hidden" name="old_user_id" value="<?=$rs[0]?>">
		<? }?>		 
		<? for($i=0;$i<count($field_name);$i++) {?>
		<tr>
			<? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>
      <td align="right" nowrap>
				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
        <?=str_replace("_"," ",$field_name[$i])?>:</font>
			</td>
      <td>
				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
				<? if ($field_name[$i] == "order_date") {?>
					<?=date("Y-m-d H:i:s")?>
					<input type="hidden" name="<?=$field_name[$i]?>" value="<?=date("Y-m-d H:i:s")?>">
				<? } else if ($field_name[$i] == "payment_type") {?>
					<select name="<?=$field_name[$i]?>">
						<option value="Visa" <? if ($Action == "Update" && $rs["payment_type"] == "Visa") {?>selected<? }?>>Visa</option>
						<option value="Master Card" <? if ($Action == "Update" && $rs["payment_type"] == "Master Card") {?>selected<? }?>>Master Card</option>
						<option value="Discover" <? if ($Action == "Update" && $rs["payment_type"] == "Discover") {?>selected<? }?>>Discover</option>
						<option value="American Express" <? if ($Action == "Update" && $rs["payment_type"] == "American Express") {?>selected<? }?>>American Express</option>
					</select>
				<? } else if ($field_name[$i] == "cc_exp_date") {?>
					<select name="cc_exp_mm" size="1" tabindex="41">
						<option value="01" <? if ($Action == "Update" && substr($rs["cc_exp_date"],0,2) == "01") {?>selected<? }?>>01</option>
						<option value="02" <? if ($Action == "Update" && substr($rs["cc_exp_date"],0,2) == "02") {?>selected<? }?>>02</option>
						<option value="03" <? if ($Action == "Update" && substr($rs["cc_exp_date"],0,2) == "03") {?>selected<? }?>>03</option>
						<option value="04" <? if ($Action == "Update" && substr($rs["cc_exp_date"],0,2) == "04") {?>selected<? }?>>04</option>
						<option value="05" <? if ($Action == "Update" && substr($rs["cc_exp_date"],0,2) == "05") {?>selected<? }?>>05</option>
						<option value="06" <? if ($Action == "Update" && substr($rs["cc_exp_date"],0,2) == "06") {?>selected<? }?>>06</option>
						<option value="07" <? if ($Action == "Update" && substr($rs["cc_exp_date"],0,2) == "07") {?>selected<? }?>>07</option>
						<option value="08" <? if ($Action == "Update" && substr($rs["cc_exp_date"],0,2) == "08") {?>selected<? }?>>08</option>
						<option value="09" <? if ($Action == "Update" && substr($rs["cc_exp_date"],0,2) == "09") {?>selected<? }?>>09</option>
						<option value="10" <? if ($Action == "Update" && substr($rs["cc_exp_date"],0,2) == "10") {?>selected<? }?>>10</option>
						<option value="11" <? if ($Action == "Update" && substr($rs["cc_exp_date"],0,2) == "11") {?>selected<? }?>>11</option>
						<option value="12" <? if ($Action == "Update" && substr($rs["cc_exp_date"],0,2) == "12") {?>selected<? }?>>12</option>
					</select>
					/ 
					<select name="cc_exp_yyyy" size="1" tabindex="43">
						<option value="02" <? if ($Action == "Update" && substr($rs["cc_exp_date"],2,2) == "02") {?>selected<? }?>>2002</option>
						<option value="03" <? if ($Action == "Update" && substr($rs["cc_exp_date"],2,2) == "03") {?>selected<? }?>>2003</option>
						<option value="04" <? if ($Action == "Update" && substr($rs["cc_exp_date"],2,2) == "04") {?>selected<? }?>>2004</option>
						<option value="05" <? if ($Action == "Update" && substr($rs["cc_exp_date"],2,2) == "05") {?>selected<? }?>>2005</option>
						<option value="06" <? if ($Action == "Update" && substr($rs["cc_exp_date"],2,2) == "06") {?>selected<? }?>>2006</option>
						<option value="07" <? if ($Action == "Update" && substr($rs["cc_exp_date"],2,2) == "07") {?>selected<? }?>>2007</option>
						<option value="08" <? if ($Action == "Update" && substr($rs["cc_exp_date"],2,2) == "08") {?>selected<? }?>>2008</option>
						<option value="09" <? if ($Action == "Update" && substr($rs["cc_exp_date"],2,2) == "09") {?>selected<? }?>>2009</option>
						<option value="10" <? if ($Action == "Update" && substr($rs["cc_exp_date"],2,2) == "10") {?>selected<? }?>>2010</option>
						<option value="11" <? if ($Action == "Update" && substr($rs["cc_exp_date"],2,2) == "11") {?>selected<? }?>>2011</option>
						<option value="12" <? if ($Action == "Update" && substr($rs["cc_exp_date"],2,2) == "12") {?>selected<? }?>>2012</option>
						<option value="13" <? if ($Action == "Update" && substr($rs["cc_exp_date"],2,2) == "13") {?>selected<? }?>>2013</option>
					</select>
				<? } else if ($field_name[$i] == "user_id") {?>
					<select name="<?=$field_name[$i]?>" onChange="changeUser('<?=$Action?>',this.value);">
						<? for($n=0;$n<count($userid);$n++) {?>
						<option value="<?=$userid[$n]?>" <? if ($userid[$n] == $user_id) {?>selected<? }?>><?=$userid[$n]?></option>
						<? }?>
					</select>
				<? } else if ($field_name[$i] == "billing_state") {?>
					<select name="billing_state">
						<option value="AL" <? if ($Action == "Update" && $rs["billing_state"] == "AL") {?>selected<? }?>>AL-Alabama </option>
						<option value="AK" <? if ($Action == "Update" && $rs["billing_state"] == "AK") {?>selected<? }?>>AK-Alaska </option>
						<option value="AZ" <? if ($Action == "Update" && $rs["billing_state"] == "AZ") {?>selected<? }?>>AZ-Arizona </option>
						<option value="AR" <? if ($Action == "Update" && $rs["billing_state"] == "AR") {?>selected<? }?>>AR-Arkansas </option>
						<option value="CA" <? if ($Action == "Update" && $rs["billing_state"] == "CA") {?>selected<? }?>>CA-California </option>
						<option value="CO" <? if ($Action == "Update" && $rs["billing_state"] == "CO") {?>selected<? }?>>CO-Colorado </option>
						<option value="CT" <? if ($Action == "Update" && $rs["billing_state"] == "CT") {?>selected<? }?>>CT-Connecticut </option>
						<option value="DC" <? if ($Action == "Update" && $rs["billing_state"] == "DC") {?>selected<? }?>>DC-Washington D.C. </option>
						<option value="DE" <? if ($Action == "Update" && $rs["billing_state"] == "DE") {?>selected<? }?>>DE-Delaware </option>
						<option value="FL" <? if ($Action == "Update" && $rs["billing_state"] == "FL") {?>selected<? }?>>FL-Florida </option>
						<option value="GA" <? if ($Action == "Update" && $rs["billing_state"] == "GA") {?>selected<? }?>>GA-Georgia </option>
						<option value="HI" <? if ($Action == "Update" && $rs["billing_state"] == "HI") {?>selected<? }?>>HI-Hawaii </option>
						<option value="ID" <? if ($Action == "Update" && $rs["billing_state"] == "ID") {?>selected<? }?>>ID-Idaho </option>
						<option value="IL" <? if ($Action == "Update" && $rs["billing_state"] == "IL") {?>selected<? }?>>IL-Illinois </option>
						<option value="IN" <? if ($Action == "Update" && $rs["billing_state"] == "IN") {?>selected<? }?>>IN-Indiana </option>
						<option value="IA" <? if ($Action == "Update" && $rs["billing_state"] == "IA") {?>selected<? }?>>IA-Iowa </option>
						<option value="KS" <? if ($Action == "Update" && $rs["billing_state"] == "KS") {?>selected<? }?>>KS-Kansas </option>
						<option value="KY" <? if ($Action == "Update" && $rs["billing_state"] == "KY") {?>selected<? }?>>KY-Kentucky </option>
						<option value="LA" <? if ($Action == "Update" && $rs["billing_state"] == "LA") {?>selected<? }?>>LA-Louisiana </option>
						<option value="ME" <? if ($Action == "Update" && $rs["billing_state"] == "ME") {?>selected<? }?>>ME-Maine </option>
						<option value="MD" <? if ($Action == "Update" && $rs["billing_state"] == "MD") {?>selected<? }?>>MD-Maryland </option>
						<option value="MA" <? if ($Action == "Update" && $rs["billing_state"] == "MA") {?>selected<? }?>>MA-Massachusetts </option>
						<option value="MI" <? if ($Action == "Update" && $rs["billing_state"] == "MI") {?>selected<? }?>>MI-Michigan </option>
						<option value="MN" <? if ($Action == "Update" && $rs["billing_state"] == "MN") {?>selected<? }?>>MN-Minnesota </option>
						<option value="MS" <? if ($Action == "Update" && $rs["billing_state"] == "MS") {?>selected<? }?>>MS-Mississippi </option>
						<option value="MO" <? if ($Action == "Update" && $rs["billing_state"] == "MO") {?>selected<? }?>>MO-Missouri </option>
						<option value="MT" <? if ($Action == "Update" && $rs["billing_state"] == "MT") {?>selected<? }?>>MT-Montana </option>
						<option value="NE" <? if ($Action == "Update" && $rs["billing_state"] == "NE") {?>selected<? }?>>NE-Nebraska </option>
						<option value="NV" <? if ($Action == "Update" && $rs["billing_state"] == "NV") {?>selected<? }?>>NV-Nevada </option>
						<option value="NH" <? if ($Action == "Update" && $rs["billing_state"] == "NH") {?>selected<? }?>>NH-New Hampshire </option>
						<option value="NJ" <? if ($Action == "Update" && $rs["billing_state"] == "NJ") {?>selected<? }?>>NJ-New Jersey </option>
						<option value="NM" <? if ($Action == "Update" && $rs["billing_state"] == "NM") {?>selected<? }?>>NM-New Mexico </option>
						<option value="NY" <? if ($Action == "Update" && $rs["billing_state"] == "NY") {?>selected<? }?>>NY-New York </option>
						<option value="NC" <? if ($Action == "Update" && $rs["billing_state"] == "NC") {?>selected<? }?>>NC-North Carolina </option>
						<option value="ND" <? if ($Action == "Update" && $rs["billing_state"] == "ND") {?>selected<? }?>>ND-North Dakota </option>
						<option value="OH" <? if ($Action == "Update" && $rs["billing_state"] == "OH") {?>selected<? }?>>OH-Ohio </option>
						<option value="OK" <? if ($Action == "Update" && $rs["billing_state"] == "OK") {?>selected<? }?>>OK-Oklahoma </option>
						<option value="OR" <? if ($Action == "Update" && $rs["billing_state"] == "OR") {?>selected<? }?>>OR-Oregon </option>
						<option value="PA" <? if ($Action == "Update" && $rs["billing_state"] == "PA") {?>selected<? }?>>PA-Pennsylvania </option>
						<option value="PR" <? if ($Action == "Update" && $rs["billing_state"] == "PR") {?>selected<? }?>>PR-Puerto Rico </option>
						<option value="RI" <? if ($Action == "Update" && $rs["billing_state"] == "RI") {?>selected<? }?>>RI-Rhode Island </option>
						<option value="SC" <? if ($Action == "Update" && $rs["billing_state"] == "SC") {?>selected<? }?>>SC-South Carolina </option>
						<option value="SD" <? if ($Action == "Update" && $rs["billing_state"] == "SD") {?>selected<? }?>>SD-South Dakota </option>
						<option value="TN" <? if ($Action == "Update" && $rs["billing_state"] == "TN") {?>selected<? }?>>TN-Tennessee </option>
						<option value="TX" <? if ($Action == "Update" && $rs["billing_state"] == "TX") {?>selected<? }?>>TX-Texas </option>
						<option value="UT" <? if ($Action == "Update" && $rs["billing_state"] == "UT") {?>selected<? }?>>UT-Utah </option>
						<option value="VT" <? if ($Action == "Update" && $rs["billing_state"] == "VT") {?>selected<? }?>>VT-Vermont </option>
						<option value="VA" <? if ($Action == "Update" && $rs["billing_state"] == "VA") {?>selected<? }?>>VA-Virginia </option>
						<option value="WA" <? if ($Action == "Update" && $rs["billing_state"] == "WA") {?>selected<? }?>>WA-Washington </option>
						<option value="WV" <? if ($Action == "Update" && $rs["billing_state"] == "WV") {?>selected<? }?>>WV-West Virginia </option>
						<option value="WI" <? if ($Action == "Update" && $rs["billing_state"] == "WI") {?>selected<? }?>>WI-Wisconsin </option>
						<option value="WY" <? if ($Action == "Update" && $rs["billing_state"] == "WY") {?>selected<? }?>>WY-Wyoming </option>
					</select>
				<? } else {?>
				<input name="<?=$field_name[$i]?>" type="text" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? } else if ($field_name[$i] == "billing_first_name") {?><?=$first_name?><? } else if ($field_name[$i] == "billing_last_name") {?><?=$last_name?><? }?>" <? if ($field_name[$i] == "account_number") {?>maxlength="16"<? }?>>
        <? }?>
				</font>
			</td>
			<? } else {?>
			<input type="hidden" name="<?=$field_name[$i]?>" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
			<? }?>
		</tr>
		<? }?>
		</table>
		<p>&nbsp;</p>			
    
  <input type="submit" name="Submit" value="<?=$Action?> Billing Info">
		<input name="Reset" type="reset" id="Reset" value="Reset">
	</form>
<? } else {?>
	<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
  	<td><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="manage_billing.php?Action=Add"><img src="../images/new_billing.gif" alt="Add New Billing" width="84" height="21" border="0"></a></font></td>
  </tr>
  </table>
	
	<p align="center">
  <table border="0" align="center" cellpadding="8" cellspacing="0">
	<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>
    <th width="97" valign="bottom" bgcolor="#999999"> 
			<font color="#ffffff" size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
	    <?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
      </font>
		</th>
		<? }?>
	</tr>
	<? $total_revenue = 0;?>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>		
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
		<td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
			<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
			<? if ($field_name[$i] == "user_id") {?>
				<a href="billing_info.php?user_id=<?=$rs[$i]?>"><?=$rs[$i]?></a>
			<? } else { ?>
				<? if ($field_name[$i] == "monthly_fee") { $total_revenue += $rs[$i]?>$ <? }?><?=$rs[$i]?>
			<? }?>
			</font>
		</td>
		<? }?>
		<td>
			<table cellspacing="0" cellpadding="0">
			<tr>
			<td><input name="Charge" type="button" id="Charge" value="Bill Client" onClick="charge('<?=$rs[1]?>');"></td>
			<td><input name="Update" type="button" id="Update" value="Edit" onClick="editBilling('<?=$rs[1]?>');"></td>
			<td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteBilling('<?=$rs[1]?>');"></td>
			</tr>
			</table>
		</td>
	<? }?>
	</tr>
	</table>
	<hr>
	Total Revenue: $<? printf("%01.2f",$total_revenue);?>
	<p>
	
	<center>
  <table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
  	  <td><a href="manage_billing.php?Action=Add"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="manage_billing.php?Action=Add"><img src="../images/new_billing.gif" alt="Add New Billing" width="84" height="21" border="0"></a></font></a></td>
  </tr>
  </table>
  </center>
<? }?>

</body>
</html>

<? if (isset($Status) && $Status == "failed") {?>
<script>
	alert("User Id already exists.\nPlease select different User Id.");
</script>
<? }?>