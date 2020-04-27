<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Admin.php";
require_once("config.php");
?>
<html>
<head>
<?php
$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);
$query = "SELECT * FROM SALES_ASSOCIATE WHERE sales_id = '" . $HTTP_SESSION_VARS["admin_user"]->getUserId() . "'";
$query_result = mysql_query($query);

$db_connect->close();

$admin = new Admin();
$rs = mysql_fetch_array($query_result);
?>
<title>Manage Sales Associates</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function editSalesAssociate(id) {
	var url = "sales_associate_data.php?Action=Update";
	open(url,"_self");
}

</script>
<style type="text/css">
<!--
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: smaller;
}
-->
</style>
</head>

<body vlink="00aeef">
<table width="100%"  border="0">
<tr> 
	  <td> <font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Sales 
      Associate Data</strong></font> 
     <? if (isset($Action)) {?>
     <form action="sales_associate_data_result.php?" method="post" name="adminForm" id="adminForm">
		 <input name="sales_id" type="hidden" id="sales_id" value="<? if ($Action == "Update") {?><?=$rs["sales_id"]?><? }?>">			 
		 	    <table cellpadding="5">
          <tr> 
            <td><strong>First Name:</strong></td>
            <td><input name="sales_first_name" type="text" size="20" value="<? if ($Action == "Update") {?><?=$rs["sales_first_name"]?><? }?>"> 
              <strong>M.I:</strong> <input name="sales_middle_initial" type="text" id="sales_middle_initial" size="1" maxlength="1" value="<? if ($Action == "Update") {?><?=$rs["sales_middle_initial"]?><? }?>"> 
              <strong>Last Name: </strong> <input name="sales_last_name" type="text" id="sales_last_name" size="20" value="<? if ($Action == "Update") {?><?=$rs["sales_last_name"]?><? }?>"></td>
          </tr>
          <tr> 
            <td><strong>Address:</strong></td>
            <td><input name="sales_address_1" type="text" id="sales_address_1" size="60" value="<? if ($Action == "Update") {?><?=$rs["sales_address_1"]?><? }?>"></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td><input name="sales_address_2" type="text" id="sales_address_2" size="60" value="<? if ($Action == "Update") {?><?=$rs["sales_address_2"]?><? }?>"></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td><strong>City:</strong> <input name="sales_city" type="text" id="sales_city" size="15" value="<? if ($Action == "Update") {?><?=$rs["sales_city"]?><? }?>"> 
              <strong>State:</strong> <select name="sales_state" id="sales_state">
                <? $state = $admin->getState("United States");
					for ($n=0;$n<count($state);$n++) {
						$name = $state[$n];?>
                <option value="<?=$name["short"]?>" <? if ($Action == "Update" && $rs["sales_state"] == $name["short"]) {?>selected<? }?>> 
                <?=$name["short"]?>
                - 
                <?=$name["long"]?>
                </option>
                <? }?>
              </select> <strong> Zip:</strong> <input name="sales_zip" type="text" id="sales_zip" size="5" value="<? if ($Action == "Update") {?><?=$rs["sales_zip"]?><? }?>"></td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td><strong>Country:</strong> <input name="sales_country" type="text" id="sales_country" size="20" value="<? if ($Action == "Update") {?><?=$rs["sales_country"]?><? } else {?>United States<? }?>"></td>
          </tr>
          <tr> 
            <td><strong>Home Phone:</strong></td>
            <td><input name="sales_home_phone" type="text" id="sales_home_phone" size="12" value="<? if ($Action == "Update") {?><?=$rs["sales_home_phone"]?><? }?>"> 
              <strong>Business Phone:</strong> <input name="sales_business_phone" type="text" id="sales_business_phone" size="12" value="<? if ($Action == "Update") {?><?=$rs["sales_business_phone"]?><? }?>"></td>
          </tr>
          <tr> 
            <td><strong>Cellular Phone:</strong></td>
            <td><input name="sales_cell_phone" type="text" id="sales_cell_phone" size="12" value="<? if ($Action == "Update") {?><?=$rs["sales_cellular_phone"]?><? }?>"></td>
          </tr>
          <tr> 
            <td><strong>Fax:</strong></td>
            <td><input name="sales_fax" type="text" id="sales_fax" size="12" value="<? if ($Action == "Update") {?><?=$rs["sales_fax"]?><? }?>"></td>
          </tr>
          <tr> 
            <td><strong>Email:</strong></td>
            <td><input name="sales_email" type="text" id="sales_email" value="<? if ($Action == "Update") {?><?=$rs["sales_email"]?><? }?>" size="30"></td>
          </tr>
          <tr> 
            <td><strong>SSN#:</strong></td>
            <td><input name="sales_ssn" type="text" id="sales_ssn" size="11" value="<? if ($Action == "Update") {?><?=$rs["sales_ssn"]?><? }?>"></td>
          </tr>
          <tr> 
            <td><strong>Date of Birth:</strong></td>
            <td><input name="sales_dob" type="text" id="sales_dob" value="<? if ($Action == "Update") {?><?=$rs["sales_dob"]?><? }?>"></td>
          </tr>
          <tr> 
            <td><strong>Married Status:</strong></td>
            <td><select name="sales_married_status" id="sales_married_status">
                <option value="Single" <? if ($Action == "Update" && $rs["sales_married_status"] == "Single") {?>selected<? }?>>Single</option>
                <option value="Married" <? if ($Action == "Update" && $rs["sales_married_status"] == "Married") {?>selected<? }?>>Married</option>
              </select></td>
          </tr>
        </table>
		<br>
		<p align="center"> 
			<input type="submit" name="Submit" value="Update Associate Data">
			<input name="Reset" type="reset" id="Reset" value="Reset">
		</p>
		</form>
		<? } else {?>
		<table cellpadding="5">
			<tr> 
				<td><strong>First Name:</strong></td>
				<td><?=$rs["sales_first_name"]?> 
					<strong>M.I:</strong> <?=$rs["sales_middle_initial"]?> 
					<strong>Last Name: </strong> <?=$rs["sales_last_name"]?></td>
			</tr>
			<tr> 
				<td><strong>Address:</strong></td>
				<td><?=$rs["sales_address_1"]?></td>
			</tr>
			<tr> 
				<td>&nbsp;</td>
				<td><?=$rs["sales_address_2"]?></td>
			</tr>
			<tr> 
				<td>&nbsp;</td>
				<td><strong>City:</strong> <?=$rs["sales_city"]?> 
					<strong>State:</strong> <?=$rs["sales_state"]?> 
					<strong> Zip:</strong> <?=$rs["sales_zip"]?></td>
			</tr>
			<tr> 
				<td>&nbsp;</td>
				<td><strong>Country:</strong> <?=$rs["sales_country"]?></td>
			</tr>
			<tr> 
				<td><strong>Home Phone:</strong></td>
				<td><?=$rs["sales_home_phone"]?>
				<strong>Business Phone:</strong> <?=$rs["sales_business_phone"]?></td>
			</tr>
			<tr> 
				<td><strong>Cellular Phone:</strong></td>
				<td><?=$rs["sales_cellular_phone"]?></td>
			</tr>
			<tr> 
				<td><strong>Fax:</strong></td>
				<td><?=$rs["sales_fax"]?></td>
			</tr>
			<tr> 
				<td><strong>Email:</strong></td>
				<td><?=$rs["sales_email"]?></td>
			</tr>
			<tr> 
				<td><strong>SSN#:</strong></td>
				<td><?=$rs["sales_ssn"]?></td>
			</tr>
			<tr> 
				<td><strong>Date of Birth:</strong></td>
				<td><?=$rs["sales_dob"]?></td>
			</tr>
			<tr> 
				<td><strong>Married Status:</strong></td>
				<td><?=$rs["sales_married_status"]?></td>
			</tr>
			<tr> 
				<td><strong>Commission:</strong></td>
				<td><?=$rs["sales_commission"]?></td>
			</tr>
		</table>
		  <br>
      <div align="center">
        <input name="Update" type="button" id="Update" value="Edit" onClick="editSalesAssociate();">
      </div>
		<? }?>
	</td>
</tr>
</table>
</body>
</html>
