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
		$query = "SELECT * FROM SALES_TAX WHERE SALES_TAX_ID = $sales_tax_id";
	else
		$query = "SELECT * FROM SALES_TAX";	
	$query_result = mysql_query($query);
	
	$field_list = mysql_list_fields($HTTP_SESSION_VARS["selected_db"],"SALES_TAX");
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	if (isset($state)) {
		mysql_select_db(_ADMIN_DATABASE);
		$query = "SELECT SALES_TAX_RATE FROM SALES_TAX WHERE STATE = '$state'";
		$rs_rate = mysql_fetch_row(mysql_query($query));
	}
	
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Sales Tax</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editSalesTax(id) {
	var url = "sales_tax.php?Action=Update&sales_tax_id=" + id;
	open(url,"_self");
}

function deleteSalesTax(id) {
	var url = "sales_tax_result.php?Action=Delete&sales_tax_id=" + id;
	open(url,"_self");
}

function getSalesTax(form) {
	var url = "sales_tax.php?Action=<? if(isset($Action)) {?><?=$Action?><? }?>&sales_tax_id=" + form.sales_tax_id.value + "&state=" + form.sales_tax_state.value;
	open(url,"_self");
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.sales_tax_rate.value == "") {
		is_valid = false;
		err_msg = err_msg + "Sales Tax Rate is required\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
</head>

<body vlink="00aeef">
<p><strong><font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif">Manage 
  Sales Tax</font></strong> </p>
<p align="right">
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#sales_tax','help','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');">
</p>
<p>
  <? if (isset($Action)) {?>
</p>
<form action="sales_tax_result.php?" method="post" name="salesTaxForm" id="userForm">
  <input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update") {
				$rs = mysql_fetch_row($query_result);?>
				<input type="hidden" name="old_user_id" value="<?=$rs[0]?>">
			<? }?>			 
			<? for($i=0;$i<count($field_name);$i++) {?>
			<tr>
				<? if (stristr(mysql_field_flags($field_list,$i),"AUTO_INCREMENT") == false) {?>

				
      <td align="right" nowrap><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <?=str_replace("_"," ",$field_name[$i])?>
        :</font></td>

				<td>
					<? if ($i == 1) {?>
					<select name="<?=$field_name[$i]?>" onChange="getSalesTax(this.form);">
						<option value="">- Select State -</option>
						<option value="AL" <? if ((isset($state) && $state == "AL") || ($Action == "Update" && $rs[1] == "AL")) {?>selected<? }?>>AL-Alabama 
						</option>
						<option value="AK" <? if ((isset($state) && $state == "AK") || ($Action == "Update" && $rs[1] == "AK")) {?>selected<? }?>>AK-Alaska 
						</option>
						<option value="AZ" <? if ((isset($state) && $state == "AZ") || ($Action == "Update" && $rs[1] == "AZ")) {?>selected<? }?>>AZ-Arizona 
						</option>
						<option value="AR" <? if ((isset($state) && $state == "AR") || ($Action == "Update" && $rs[1] == "AR")) {?>selected<? }?>>AR-Arkansas 
						</option>
						<option value="CA" <? if ((isset($state) && $state == "CA") || ($Action == "Update" && $rs[1] == "CA")) {?>selected<? }?>>CA-California 
						</option>
						<option value="CO" <? if ((isset($state) && $state == "CO") || ($Action == "Update" && $rs[1] == "CO")) {?>selected<? }?>>CO-Colorado 
						</option>
						<option value="CT" <? if ((isset($state) && $state == "CT") || ($Action == "Update" && $rs[1] == "CT")) {?>selected<? }?>>CT-Connecticut 
						</option>
						<option value="DC" <? if ((isset($state) && $state == "DC") || ($Action == "Update" && $rs[1] == "DC")) {?>selected<? }?>>DC-Washington 
						D.C. </option>
						<option value="DE" <? if ((isset($state) && $state == "DE") || ($Action == "Update" && $rs[1] == "DE")) {?>selected<? }?>>DE-Delaware 
						</option>
						<option value="FL" <? if ((isset($state) && $state == "FL") || ($Action == "Update" && $rs[1] == "FL")) {?>selected<? }?>>FL-Florida 
						</option>
						<option value="GA" <? if ((isset($state) && $state == "GA") || ($Action == "Update" && $rs[1] == "GA")) {?>selected<? }?>>GA-Georgia 
						</option>
						<option value="HI" <? if ((isset($state) && $state == "HI") || ($Action == "Update" && $rs[1] == "HI")) {?>selected<? }?>>HI-Hawaii 
						</option>
						<option value="ID" <? if ((isset($state) && $state == "ID") || ($Action == "Update" && $rs[1] == "ID")) {?>selected<? }?>>ID-Idaho 
						</option>
						<option value="IL" <? if ((isset($state) && $state == "IL") || ($Action == "Update" && $rs[1] == "IL")) {?>selected<? }?>>IL-Illinois 
						</option>
						<option value="IN" <? if ((isset($state) && $state == "IN") || ($Action == "Update" && $rs[1] == "IN")) {?>selected<? }?>>IN-Indiana 
						</option>
						<option value="IA" <? if ((isset($state) && $state == "IA") || ($Action == "Update" && $rs[1] == "IA")) {?>selected<? }?>>IA-Iowa 
						</option>
						<option value="KS" <? if ((isset($state) && $state == "KS") || ($Action == "Update" && $rs[1] == "KS")) {?>selected<? }?>>KS-Kansas 
						</option>
						<option value="KY" <? if ((isset($state) && $state == "KY") || ($Action == "Update" && $rs[1] == "KY")) {?>selected<? }?>>KY-Kentucky 
						</option>
						<option value="LA" <? if ((isset($state) && $state == "LA") || ($Action == "Update" && $rs[1] == "LA")) {?>selected<? }?>>LA-Louisiana 
						</option>
						<option value="ME" <? if ((isset($state) && $state == "ME") || ($Action == "Update" && $rs[1] == "ME")) {?>selected<? }?>>ME-Maine 
						</option>
						<option value="MD" <? if ((isset($state) && $state == "MD") || ($Action == "Update" && $rs[1] == "MD")) {?>selected<? }?>>MD-Maryland 
						</option>
						<option value="MA" <? if ((isset($state) && $state == "MA") || ($Action == "Update" && $rs[1] == "MA")) {?>selected<? }?>>MA-Massachusetts 
						</option>
						<option value="MI" <? if ((isset($state) && $state == "MI") || ($Action == "Update" && $rs[1] == "MI")) {?>selected<? }?>>MI-Michigan 
						</option>
						<option value="MN" <? if ((isset($state) && $state == "MN") || ($Action == "Update" && $rs[1] == "MN")) {?>selected<? }?>>MN-Minnesota 
						</option>
						<option value="MS" <? if ((isset($state) && $state == "MS") || ($Action == "Update" && $rs[1] == "MS")) {?>selected<? }?>>MS-Mississippi 
						</option>
						<option value="MO" <? if ((isset($state) && $state == "MO") || ($Action == "Update" && $rs[1] == "MO")) {?>selected<? }?>>MO-Missouri 
						</option>
						<option value="MT" <? if ((isset($state) && $state == "MT") || ($Action == "Update" && $rs[1] == "MT")) {?>selected<? }?>>MT-Montana 
						</option>
						<option value="NE" <? if ((isset($state) && $state == "NE") || ($Action == "Update" && $rs[1] == "NE")) {?>selected<? }?>>NE-Nebraska 
						</option>
						<option value="NV" <? if ((isset($state) && $state == "NV") || ($Action == "Update" && $rs[1] == "NV")) {?>selected<? }?>>NV-Nevada 
						</option>
						<option value="NH" <? if ((isset($state) && $state == "NH") || ($Action == "Update" && $rs[1] == "NH")) {?>selected<? }?>>NH-New 
						Hampshire </option>
						<option value="NJ" <? if ((isset($state) && $state == "NJ") || ($Action == "Update" && $rs[1] == "NJ")) {?>selected<? }?>>NJ-New 
						Jersey </option>
						<option value="NM" <? if ((isset($state) && $state == "NM") || ($Action == "Update" && $rs[1] == "NM")) {?>selected<? }?>>NM-New 
						Mexico </option>
						<option value="NY" <? if ((isset($state) && $state == "NY") || ($Action == "Update" && $rs[1] == "NY")) {?>selected<? }?>>NY-New 
						York </option>
						<option value="NC" <? if ((isset($state) && $state == "NC") || ($Action == "Update" && $rs[1] == "NC")) {?>selected<? }?>>NC-North 
						Carolina </option>
						<option value="ND" <? if ((isset($state) && $state == "ND") || ($Action == "Update" && $rs[1] == "ND")) {?>selected<? }?>>ND-North 
						Dakota </option>
						<option value="OH" <? if ((isset($state) && $state == "OH") || ($Action == "Update" && $rs[1] == "OH")) {?>selected<? }?>>OH-Ohio 
						</option>
						<option value="OK" <? if ((isset($state) && $state == "OK") || ($Action == "Update" && $rs[1] == "OK")) {?>selected<? }?>>OK-Oklahoma 
						</option>
						<option value="OR" <? if ((isset($state) && $state == "OR") || ($Action == "Update" && $rs[1] == "OR")) {?>selected<? }?>>OR-Oregon 
						</option>
						<option value="PA" <? if ((isset($state) && $state == "PA") || ($Action == "Update" && $rs[1] == "PA")) {?>selected<? }?>>PA-Pennsylvania 
						</option>
						<option value="PR" <? if ((isset($state) && $state == "PR") || ($Action == "Update" && $rs[1] == "PR")) {?>selected<? }?>>PR-Puerto 
						Rico </option>
						<option value="RI" <? if ((isset($state) && $state == "RI") || ($Action == "Update" && $rs[1] == "RI")) {?>selected<? }?>>RI-Rhode 
						Island </option>
						<option value="SC" <? if ((isset($state) && $state == "SC") || ($Action == "Update" && $rs[1] == "SC")) {?>selected<? }?>>SC-South 
						Carolina </option>
						<option value="SD" <? if ((isset($state) && $state == "SD") || ($Action == "Update" && $rs[1] == "SD")) {?>selected<? }?>>SD-South 
						Dakota </option>
						<option value="TN" <? if ((isset($state) && $state == "TN") || ($Action == "Update" && $rs[1] == "TN")) {?>selected<? }?>>TN-Tennessee 
						</option>
						<option value="TX" <? if ((isset($state) && $state == "TX") || ($Action == "Update" && $rs[1] == "TX")) {?>selected<? }?>>TX-Texas 
						</option>
						<option value="UT" <? if ((isset($state) && $state == "UT") || ($Action == "Update" && $rs[1] == "UT")) {?>selected<? }?>>UT-Utah 
						</option>
						<option value="VT" <? if ((isset($state) && $state == "VT") || ($Action == "Update" && $rs[1] == "VT")) {?>selected<? }?>>VT-Vermont 
						</option>
						<option value="VA" <? if ((isset($state) && $state == "VA") || ($Action == "Update" && $rs[1] == "VA")) {?>selected<? }?>>VA-Virginia 
						</option>
						<option value="WA" <? if ((isset($state) && $state == "WA") || ($Action == "Update" && $rs[1] == "WA")) {?>selected<? }?>>WA-Washington 
						</option>
						<option value="WV" <? if ((isset($state) && $state == "WV") || ($Action == "Update" && $rs[1] == "WV")) {?>selected<? }?>>WV-West 
						Virginia </option>
						<option value="WI" <? if ((isset($state) && $state == "WI") || ($Action == "Update" && $rs[1] == "WI")) {?>selected<? }?>>WI-Wisconsin 
						</option>
						<option value="WY" <? if ((isset($state) && $state == "WY") || ($Action == "Update" && $rs[1] == "WY")) {?>selected<? }?>>WY-Wyoming 
						</option>
					</select>
					<? } else {?>
					<input name="<?=$field_name[$i]?>" type="text" value="<? if (isset($rs_rate)) {?><?=$rs_rate[0]?><? } else if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
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
    <input type="submit" name="Submit" value="<?=$Action?> Sales Tax" onClick="validateForm(this.form);">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>

<p align="center"><a href="sales_tax.php?Action=Add"><img src="../../images/add_sales_tax.gif" width="93" height="21" border="0"></a></p>

<p align="center">

<table border="0" align="center" cellpadding="8" cellspacing="0">

<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>
		<th bgcolor="#999999" nowrap> 
			<? if ($i !=0) {?>
      <font size="-1" color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif"><?=strtoupper(str_replace("_"," ",$field_name[$i]))?></font>
			<? }?>
    </th>
		<? }?>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
				<? if ($i !=0) {?>
				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"><?=$rs[$i]?></font>
				<? }?>
			</td>
		<? }?>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editSalesTax('<?=$rs[0]?>');"></td>
		<td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteSalesTax('<?=$rs[0]?>');"></td>
	</tr>
	<? }?>
</table>
<p>
<center>
    <a href="sales_tax.php?Action=Add"><img src="../../images/add_sales_tax.gif" width="93" height="21" border="0"></a>
  </center>
</p>
<? }?>
</body>
</html>
