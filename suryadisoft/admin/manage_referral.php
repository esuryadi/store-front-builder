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
if (isset($Action) && $Action == "Add")
	$query = "SELECT * FROM REFERRAL";
else if (isset($Action) && $Action == "Update")
	$query = "SELECT * FROM REFERRAL WHERE referral_id = '$referral_id'";
else
	$query = "SELECT REFERRAL.referral_id,REFERRAL.first_name,REFERRAL.last_name,COUNT(PURCHASE_ORDER.referral_id) AS total_signup_client, SUM(PURCHASE_ORDER.one_time_setup_fee), REFERRAL.paid_amount FROM REFERRAL LEFT JOIN PURCHASE_ORDER ON REFERRAL.referral_id = PURCHASE_ORDER.referral_id WHERE REFERRAL.referral_id <> '' GROUP BY REFERRAL.referral_id";	
$query_result = mysql_query($query);

$field_list = $query_result;
for ($i=0;$i<mysql_num_fields($field_list);$i++)
	$field_name [] = mysql_field_name($field_list,$i);
	
$db_connect->close();
?>
<title>Manage Referral</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function editReferral(id) {
	var url = "manage_referral.php?Action=Update&referral_id=" + id;
	open(url,"_self");
}

function deleteReferral(id) {
	var url = "manage_referral_result.php?Action=Delete&referral_id=" + id;
	open(url,"_self");
}

function payReferral(id) {
	var amount = prompt("Enter Amount:","0.00");
	var url = "manage_referral_result.php?Action=Pay&referral_id=" + id + "&amount=" + amount;
	open(url,"_self");
}
</script>
</head>

<body vlink="00aeef">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage Referral</strong></font> 
<p>
<? if (isset($Action)) {?>
</p>
	<form action="manage_referral_result.php?" method="post" name="PricingForm" id="PricingForm">
		<input type="hidden" name="Action" value="<?=$Action?>">
		<table cellpadding="5" cellspacing="5">
			<? if ($Action == "Update") {
				$rs = mysql_fetch_row($query_result);?>
				<input type="hidden" name="old_referral_id" value="<?=$rs[0]?>">
			<? }?>			 
			<? for($i=0;$i<count($field_name);$i++) {?>
				<tr>
					<? if (stristr(mysql_field_flags($query_result,$i),"AUTO_INCREMENT") == false) {?>	
			      <td align="right" nowrap>
							<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
							<?=str_replace("_"," ",$field_name[$i])?>:</font></td>
						<td>
							<? if ($field_name[$i] == "state") {?>
							<select name="state">
							<option value="">-Select State-</option>
							<option value="AL" <? if ($Action == "Update" && $rs[$i] == "AL") {?>selected<? }?>>AL-Alabama </option>
							<option value="AK" <? if ($Action == "Update" && $rs[$i] == "AK") {?>selected<? }?>>AK-Alaska </option>
							<option value="AZ" <? if ($Action == "Update" && $rs[$i] == "AZ") {?>selected<? }?>>AZ-Arizona </option>
							<option value="AR" <? if ($Action == "Update" && $rs[$i] == "AR") {?>selected<? }?>>AR-Arkansas </option>
							<option value="CA" <? if ($Action == "Update" && $rs[$i] == "CA") {?>selected<? }?>>CA-California </option>
							<option value="CO" <? if ($Action == "Update" && $rs[$i] == "CO") {?>selected<? }?>>CO-Colorado </option>
							<option value="CT" <? if ($Action == "Update" && $rs[$i] == "CT") {?>selected<? }?>>CT-Connecticut </option>
							<option value="DC" <? if ($Action == "Update" && $rs[$i] == "DC") {?>selected<? }?>>DC-Washington D.C. </option>
							<option value="DE" <? if ($Action == "Update" && $rs[$i] == "DE") {?>selected<? }?>>DE-Delaware </option>
							<option value="FL" <? if ($Action == "Update" && $rs[$i] == "FL") {?>selected<? }?>>FL-Florida </option>
							<option value="GA" <? if ($Action == "Update" && $rs[$i] == "GA") {?>selected<? }?>>GA-Georgia </option>
							<option value="HI" <? if ($Action == "Update" && $rs[$i] == "HI") {?>selected<? }?>>HI-Hawaii </option>
							<option value="ID" <? if ($Action == "Update" && $rs[$i] == "ID") {?>selected<? }?>>ID-Idaho </option>
							<option value="IL" <? if ($Action == "Update" && $rs[$i] == "IL") {?>selected<? }?>>IL-Illinois </option>
							<option value="IN" <? if ($Action == "Update" && $rs[$i] == "IN") {?>selected<? }?>>IN-Indiana </option>
							<option value="IA" <? if ($Action == "Update" && $rs[$i] == "IA") {?>selected<? }?>>IA-Iowa </option>
							<option value="KS" <? if ($Action == "Update" && $rs[$i] == "KS") {?>selected<? }?>>KS-Kansas </option>
							<option value="KY" <? if ($Action == "Update" && $rs[$i] == "KY") {?>selected<? }?>>KY-Kentucky </option>
							<option value="LA" <? if ($Action == "Update" && $rs[$i] == "LA") {?>selected<? }?>>LA-Louisiana </option>
							<option value="ME" <? if ($Action == "Update" && $rs[$i] == "ME") {?>selected<? }?>>ME-Maine </option>
							<option value="MD" <? if ($Action == "Update" && $rs[$i] == "MD") {?>selected<? }?>>MD-Maryland </option>
							<option value="MA" <? if ($Action == "Update" && $rs[$i] == "MA") {?>selected<? }?>>MA-Massachusetts </option>
							<option value="MI" <? if ($Action == "Update" && $rs[$i] == "MI") {?>selected<? }?>>MI-Michigan </option>
							<option value="MN" <? if ($Action == "Update" && $rs[$i] == "MN") {?>selected<? }?>>MN-Minnesota </option>
							<option value="MS" <? if ($Action == "Update" && $rs[$i] == "MS") {?>selected<? }?>>MS-Mississippi </option>
							<option value="MO" <? if ($Action == "Update" && $rs[$i] == "MO") {?>selected<? }?>>MO-Missouri </option>
							<option value="MT" <? if ($Action == "Update" && $rs[$i] == "MT") {?>selected<? }?>>MT-Montana </option>
							<option value="NE" <? if ($Action == "Update" && $rs[$i] == "NE") {?>selected<? }?>>NE-Nebraska </option>
							<option value="NV" <? if ($Action == "Update" && $rs[$i] == "NV") {?>selected<? }?>>NV-Nevada </option>
							<option value="NH" <? if ($Action == "Update" && $rs[$i] == "NH") {?>selected<? }?>>NH-New Hampshire </option>
							<option value="NJ" <? if ($Action == "Update" && $rs[$i] == "NJ") {?>selected<? }?>>NJ-New Jersey </option>
							<option value="NM" <? if ($Action == "Update" && $rs[$i] == "NM") {?>selected<? }?>>NM-New Mexico </option>
							<option value="NY" <? if ($Action == "Update" && $rs[$i] == "NY") {?>selected<? }?>>NY-New York </option>
							<option value="NC" <? if ($Action == "Update" && $rs[$i] == "NC") {?>selected<? }?>>NC-North Carolina </option>
							<option value="ND" <? if ($Action == "Update" && $rs[$i] == "ND") {?>selected<? }?>>ND-North Dakota </option>
							<option value="OH" <? if ($Action == "Update" && $rs[$i] == "OH") {?>selected<? }?>>OH-Ohio </option>
							<option value="OK" <? if ($Action == "Update" && $rs[$i] == "OK") {?>selected<? }?>>OK-Oklahoma </option>
							<option value="OR" <? if ($Action == "Update" && $rs[$i] == "OR") {?>selected<? }?>>OR-Oregon </option>
							<option value="PA" <? if ($Action == "Update" && $rs[$i] == "PA") {?>selected<? }?>>PA-Pennsylvania </option>
							<option value="PR" <? if ($Action == "Update" && $rs[$i] == "PR") {?>selected<? }?>>PR-Puerto Rico </option>
							<option value="RI" <? if ($Action == "Update" && $rs[$i] == "RI") {?>selected<? }?>>RI-Rhode Island </option>
							<option value="SC" <? if ($Action == "Update" && $rs[$i] == "SC") {?>selected<? }?>>SC-South Carolina </option>
							<option value="SD" <? if ($Action == "Update" && $rs[$i] == "SD") {?>selected<? }?>>SD-South Dakota </option>
							<option value="TN" <? if ($Action == "Update" && $rs[$i] == "TN") {?>selected<? }?>>TN-Tennessee </option>
							<option value="TX" <? if ($Action == "Update" && $rs[$i] == "TX") {?>selected<? }?>>TX-Texas </option>
							<option value="UT" <? if ($Action == "Update" && $rs[$i] == "UT") {?>selected<? }?>>UT-Utah </option>
							<option value="VT" <? if ($Action == "Update" && $rs[$i] == "VT") {?>selected<? }?>>VT-Vermont </option>
							<option value="VA" <? if ($Action == "Update" && $rs[$i] == "VA") {?>selected<? }?>>VA-Virginia </option>
							<option value="WA" <? if ($Action == "Update" && $rs[$i] == "WA") {?>selected<? }?>>WA-Washington </option>
							<option value="WV" <? if ($Action == "Update" && $rs[$i] == "WV") {?>selected<? }?>>WV-West Virginia </option>
							<option value="WI" <? if ($Action == "Update" && $rs[$i] == "WI") {?>selected<? }?>>WI-Wisconsin </option>
							<option value="WY" <? if ($Action == "Update" && $rs[$i] == "WY") {?>selected<? }?>>WY-Wyoming </option>
							</select>
						<? } else {?>					
							<input name="<?=$field_name[$i]?>" type="text" value="<? if ($Action == "Update") {?><?=$rs[$i]?><? }?>">
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
    <input type="submit" name="Submit" value="<?=$Action?> Referral">
		<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
	</form>
<? } else {?>
	<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> </font> 
	<center>
  	<table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><a href="manage_referral.php?Action=Add"><img src="../images/add_new_referral.gif" alt="Add New Referral" width="121" height="21" border="0"></a></td>
    </tr>
  	</table>
  <br>
	</center>
  
	<table border="0" align="center" cellpadding="8" cellspacing="0">
	<tr>
		<? for($i=0;$i<count($field_name);$i++) {?>
    	<th width="154" bgcolor="#999999"> 
				<font color="#ffffff" size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
				<? if ($i < 4) {?>
				<?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
				<? }?>
				</font> 
			</th>
		<? }?>
		<th bgcolor="#999999"><font color="#ffffff" size="-1" face="Verdana, Arial, Helvetica, sans-serif">REFERRAL FEE</font></th>
	</tr>
	<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>		
	<tr>
		<? for($i=0;$i<count($rs);$i++) {?>
			<td align="<? if (stristr(mysql_field_type($field_list,$i),"INT") || stristr(mysql_field_type($field_list,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
				<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
				<? if ($i < 4) {?>
					<? if ($field_name[$i] == "referral_id") {?>
						<a href="referral_info.php?referral_id=<?=$rs[$i]?>"><?=$rs[$i]?></a>
					<? } else {?>
						<?=$rs[$i]?>
					<? }?>
				<? }?>
				</font>
			</td>
		<? }?>
		<td align="right" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">$ <? printf("%01.2f",(($rs[4] * 0.25) - $rs[5]));?></td>
		<td><input name="Update" type="button" id="Update" value="Edit" onClick="editReferral('<?=$rs[0]?>');"></td>
		<td><input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteReferral('<?=$rs[0]?>');"></td>
		<td><input name="Pay" type="button" id="Pay" value="Pay" onClick="payReferral('<?=$rs[0]?>');"></td>
	</tr>
	<? }?>
	</table>
	<p>
	<center>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				
      <td><a href="manage_referral.php?Action=Add"><img src="../images/add_new_referral.gif" alt="Add New Referral" width="121" height="21" border="0"></a></td>
			</tr>
		</table>
	</center>
<? }?>
</body>
</html>
<? if (isset($Status) && $Status == "failed") {?>
<script>
alert("Referral ID already exists.\nPlease select different Referral ID.");
</script>
<? }?>