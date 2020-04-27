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
	$calc_method = WebContent::getPropertyValue("ship_rate_calc_method");
	if ($calc_method == "by product") {
		$table = "SHIPPING_RATE";
		$order_by = "";
	} else if ($calc_method == "by total purchase") {
		$table = "SHIPPING_RATE_2";
		$order_by = " , TOTAL_PURCHASE_LOW, ZIP_CODE_LOW";
	} else {
		$table = "SHIPPING_RATE_3";
		$order_by = " , WEIGHT";
	}
	
	$HTTP_SESSION_VARS["db_connect"]->open();
	
	mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
	if (isset($Action) && $Action == "Update")
		$query = "SELECT * FROM $table WHERE ID = $id";
	else
		$query = "SELECT * FROM $table ORDER BY SHIPPING_VENDOR, SHIPPING_METHOD $order_by";
	$query_result = mysql_query($query);
	
	$field_list = mysql_list_fields($HTTP_SESSION_VARS["selected_db"],"$table");
	for ($i=0;$i<mysql_num_fields($field_list);$i++)
		$field_name [] = mysql_field_name($field_list,$i);
		
	$HTTP_SESSION_VARS["db_connect"]->close();
}
?>
<title>Manage Shipping</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function editShippingRate(id) {
	var url = "shipping_rate.php?Action=Update&id=" + id;
	open(url,"_self");
}

function deleteShippingRate(id) {
	var url = "shipping_rate_result.php?Action=Delete&id=" + id;
	open(url,"_self");
}

function updateShippingMethod(form) {
	form.action = "shipping_rate.php";
	form.method = "POST";
	form.submit();
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	<? if ($calc_method == "by product") {?>
	if (form.one_item_rate.value == "") {
		is_valid = false;
		err_msg = err_msg + "One Item Rate is required\n";
	}
	if (form.additional_item_rate.value == "") {
		is_valid = false;
		err_msg = err_msg + "Additional Item Rate is required\n";
	}
	<? } else if ($calc_method == "by weight") {?>
	if (form.weight.value == "") {
		is_valid = false;
		err_msg = err_msg + "Weight is required\n";
	}
	if (form.shipping_rate.value == "") {
		is_valid = false;
		err_msg = err_msg + "Shipping Rate is required\n";
	}
	<? }?>
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
</script>
</head>
<body vlink="00aeef"> 
<p><font color="00AEEF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage Shipping Rates</strong></font> </p> 
<p align="right"> 
  <input name="Help" type="button" id="Help" value="Help" onClick="window.open('help/help.htm?#shipping_rate','help','toolbar=no,status=no,scrollbars=yes,resizable=yes,location=no,menubar=no,directories=no,width=750,height=550');"> 
</p> 
<p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
  <? if (isset($Action)) {?> 
  </font></p> 
<form action="shipping_rate_result.php?" method="post" name="shippingRateForm" id="userForm"> 
  <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
  <input type="hidden" name="Action" value="<?=$Action?>"> 
  </font> 
  <table cellpadding="5" cellspacing="5"> 
    <? if ($Action == "Update")
				$rs = mysql_fetch_row($query_result);?> 
    <input type="hidden" name="id" value="<? if ($Action == "Update") {?><?=$rs[0]?><? }?>"> 
    <? if ($calc_method == "by product") {?> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Product Name:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="product_id"> 
          <option value="0" <? if ($Action == "Update" && $rs[1] == 0) {?>selected<? }?>>All Products</option> 
          <? $HTTP_SESSION_VARS["db_connect"]->open();
					mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
					$query = "SELECT PRODUCT_ID, PRODUCT_NAME FROM PRODUCT";
					$query_result = mysql_query($query);
					while ($result = mysql_fetch_row($query_result)) {?> 
          <option value="<?=$result[0]?>" <? if ($Action == "Update" && $result[0] == $rs[1] || isset($product_id) && $product_id == $result[0]) {?>selected<? }?>> 
          <?=$result[1]?> 
          </option> 
          <? }
					$HTTP_SESSION_VARS["db_connect"]->close();?> 
        </select> 
        </font></td> 
    </tr> 
    <? }?> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Shipping Vendor:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="shipping_vendor"  onChange="updateShippingMethod(this.form);"> 
          <? $HTTP_SESSION_VARS["db_connect"]->open();
					mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
					$query = "SELECT SHIPPING_VENDOR_NAME FROM SHIPPING_VENDOR GROUP BY SHIPPING_VENDOR_NAME";
					$query_result = mysql_query($query);
					$first_time = true;
					$vendor = ($calc_method == "by product")?$rs[2]:$rs[1];
					while ($result = mysql_fetch_row($query_result)) {
						if ($first_time) {
							$selected_vendor_name = $result[0];
							$first_time = false;
						}?> 
          <option value="<?=$result[0]?>" <? if ($Action == "Update" && $result[0] == $vendor || isset($shipping_vendor) && $shipping_vendor == $result[0]) { $selected_vendor_name = $result[0];?>selected<? }?>> 
          <?=$result[0]?> 
          </option> 
          <? }
					$HTTP_SESSION_VARS["db_connect"]->close();?> 
        </select> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Shipping Method:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="shipping_method"> 
          <? $HTTP_SESSION_VARS["db_connect"]->open();
					mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
					$query = "SELECT SHIPPING_VENDOR_METHOD FROM SHIPPING_VENDOR WHERE SHIPPING_VENDOR_NAME = '$selected_vendor_name'";
					$query_result = mysql_query($query);
					$method = ($calc_method == "by product")?$rs[3]:$rs[2];
					while ($result = mysql_fetch_row($query_result)) {?> 
          <option value="<?=$result[0]?>" <? if ($Action == "Update" && $result[0] == $method) {?>selected<? }?>> 
          <?=$result[0]?> 
          </option> 
          <? }
					$HTTP_SESSION_VARS["db_connect"]->close();?> 
        </select> 
        </font></td> 
    </tr> 
    <? if ($calc_method == "by product") {?> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">One Item Rate:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="one_item_rate" type="text" value="<? if (isset($one_item_rate)) {?><?=$one_item_rate?><? } else if ($Action == "Update") {?><?=$rs[4]?><? }?>"> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Additional Item Rate:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="additional_item_rate" type="text" value="<? if (isset($additional_item_rate)) {?><?=$additional_item_rate?><? } else if ($Action == "Update") {?><?=$rs[5]?><? }?>"> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">State:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="state"> 
          <option value="All States" <? if ($Action == "Update" && $rs[6] == "All States") {?>selected<? }?>>All States </option> 
          <option value="AL" <? if ($Action == "Update" && $rs[6] == "AL") {?>selected<? }?>>AL-Alabama </option> 
          <option value="AK" <? if ($Action == "Update" && $rs[6] == "AK") {?>selected<? }?>>AK-Alaska </option> 
          <option value="AZ" <? if ($Action == "Update" && $rs[6] == "AZ") {?>selected<? }?>>AZ-Arizona </option> 
          <option value="AR" <? if ($Action == "Update" && $rs[6] == "AR") {?>selected<? }?>>AR-Arkansas </option> 
          <option value="CA" <? if ($Action == "Update" && $rs[6] == "CA") {?>selected<? }?>>CA-California </option> 
          <option value="CO" <? if ($Action == "Update" && $rs[6] == "CO") {?>selected<? }?>>CO-Colorado </option> 
          <option value="CT" <? if ($Action == "Update" && $rs[6] == "CT") {?>selected<? }?>>CT-Connecticut </option> 
          <option value="DC" <? if ($Action == "Update" && $rs[6] == "DC") {?>selected<? }?>>DC-Washington D.C. </option> 
          <option value="DE" <? if ($Action == "Update" && $rs[6] == "DE") {?>selected<? }?>>DE-Delaware </option> 
          <option value="FL" <? if ($Action == "Update" && $rs[6] == "FL") {?>selected<? }?>>FL-Florida </option> 
          <option value="GA" <? if ($Action == "Update" && $rs[6] == "GA") {?>selected<? }?>>GA-Georgia </option> 
          <option value="HI" <? if ($Action == "Update" && $rs[6] == "HI") {?>selected<? }?>>HI-Hawaii </option> 
          <option value="ID" <? if ($Action == "Update" && $rs[6] == "ID") {?>selected<? }?>>ID-Idaho </option> 
          <option value="IL" <? if ($Action == "Update" && $rs[6] == "IL") {?>selected<? }?>>IL-Illinois </option> 
          <option value="IN" <? if ($Action == "Update" && $rs[6] == "IN") {?>selected<? }?>>IN-Indiana </option> 
          <option value="IA" <? if ($Action == "Update" && $rs[6] == "IA") {?>selected<? }?>>IA-Iowa </option> 
          <option value="KS" <? if ($Action == "Update" && $rs[6] == "KS") {?>selected<? }?>>KS-Kansas </option> 
          <option value="KY" <? if ($Action == "Update" && $rs[6] == "KY") {?>selected<? }?>>KY-Kentucky </option> 
          <option value="LA" <? if ($Action == "Update" && $rs[6] == "LA") {?>selected<? }?>>LA-Louisiana </option> 
          <option value="ME" <? if ($Action == "Update" && $rs[6] == "ME") {?>selected<? }?>>ME-Maine </option> 
          <option value="MD" <? if ($Action == "Update" && $rs[6] == "MD") {?>selected<? }?>>MD-Maryland </option> 
          <option value="MA" <? if ($Action == "Update" && $rs[6] == "MA") {?>selected<? }?>>MA-Massachusetts </option> 
          <option value="MI" <? if ($Action == "Update" && $rs[6] == "MI") {?>selected<? }?>>MI-Michigan </option> 
          <option value="MN" <? if ($Action == "Update" && $rs[6] == "MN") {?>selected<? }?>>MN-Minnesota </option> 
          <option value="MS" <? if ($Action == "Update" && $rs[6] == "MS") {?>selected<? }?>>MS-Mississippi </option> 
          <option value="MO" <? if ($Action == "Update" && $rs[6] == "MO") {?>selected<? }?>>MO-Missouri </option> 
          <option value="MT" <? if ($Action == "Update" && $rs[6] == "MT") {?>selected<? }?>>MT-Montana </option> 
          <option value="NE" <? if ($Action == "Update" && $rs[6] == "NE") {?>selected<? }?>>NE-Nebraska </option> 
          <option value="NV" <? if ($Action == "Update" && $rs[6] == "NV") {?>selected<? }?>>NV-Nevada </option> 
          <option value="NH" <? if ($Action == "Update" && $rs[6] == "NH") {?>selected<? }?>>NH-New Hampshire </option> 
          <option value="NJ" <? if ($Action == "Update" && $rs[6] == "NJ") {?>selected<? }?>>NJ-New Jersey </option> 
          <option value="NM" <? if ($Action == "Update" && $rs[6] == "NM") {?>selected<? }?>>NM-New Mexico </option> 
          <option value="NY" <? if ($Action == "Update" && $rs[6] == "NY") {?>selected<? }?>>NY-New York </option> 
          <option value="NC" <? if ($Action == "Update" && $rs[6] == "NC") {?>selected<? }?>>NC-North Carolina </option> 
          <option value="ND" <? if ($Action == "Update" && $rs[6] == "ND") {?>selected<? }?>>ND-North Dakota </option> 
          <option value="OH" <? if ($Action == "Update" && $rs[6] == "OH") {?>selected<? }?>>OH-Ohio </option> 
          <option value="OK" <? if ($Action == "Update" && $rs[6] == "OK") {?>selected<? }?>>OK-Oklahoma </option> 
          <option value="OR" <? if ($Action == "Update" && $rs[6] == "OR") {?>selected<? }?>>OR-Oregon </option> 
          <option value="PA" <? if ($Action == "Update" && $rs[6] == "PA") {?>selected<? }?>>PA-Pennsylvania </option> 
          <option value="PR" <? if ($Action == "Update" && $rs[6] == "PR") {?>selected<? }?>>PR-Puerto Rico </option> 
          <option value="RI" <? if ($Action == "Update" && $rs[6] == "RI") {?>selected<? }?>>RI-Rhode Island </option> 
          <option value="SC" <? if ($Action == "Update" && $rs[6] == "SC") {?>selected<? }?>>SC-South Carolina </option> 
          <option value="SD" <? if ($Action == "Update" && $rs[6] == "SD") {?>selected<? }?>>SD-South Dakota </option> 
          <option value="TN" <? if ($Action == "Update" && $rs[6] == "TN") {?>selected<? }?>>TN-Tennessee </option> 
          <option value="TX" <? if ($Action == "Update" && $rs[6] == "TX") {?>selected<? }?>>TX-Texas </option> 
          <option value="UT" <? if ($Action == "Update" && $rs[6] == "UT") {?>selected<? }?>>UT-Utah </option> 
          <option value="VT" <? if ($Action == "Update" && $rs[6] == "VT") {?>selected<? }?>>VT-Vermont </option> 
          <option value="VA" <? if ($Action == "Update" && $rs[6] == "VA") {?>selected<? }?>>VA-Virginia </option> 
          <option value="WA" <? if ($Action == "Update" && $rs[6] == "WA") {?>selected<? }?>>WA-Washington </option> 
          <option value="WV" <? if ($Action == "Update" && $rs[6] == "WV") {?>selected<? }?>>WV-West Virginia </option> 
          <option value="WI" <? if ($Action == "Update" && $rs[6] == "WI") {?>selected<? }?>>WI-Wisconsin </option> 
          <option value="WY" <? if ($Action == "Update" && $rs[6] == "WY") {?>selected<? }?>>WY-Wyoming </option> 
        </select> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">City:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="city" type="text" value="<? if (isset($city)) {?><?=$city?><? } else if ($Action == "Update") {?><?=$rs[7]?><? } else {?>All Cities<? }?>"> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Zip:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="zip" type="text" value="<? if (isset($zip)) {?><?=$zip?><? } else if ($Action == "Update") {?><?=$rs[8]?><? } else {?>All Zip<? }?>"> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Country:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="country" type="text" value="<? if (isset($country)) {?><?=$country?><? } else if ($Action == "Update") {?><?=$rs[9]?><? } else {?>United States<? }?>"> 
        </font></td> 
    </tr> 
    <? } else if ($calc_method == "by weight") {?> 
	<tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Weight:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="weight" type="text" value="<? if (isset($weight)) {?><?=$weight?><? } else if ($Action == "Update") {?><?=$rs[1]?><? }?>"> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Rate Type:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="rate_type"> 
          <option value="fixed value" <? if ($Action == "Update" && $rs[5] == "fixed value") {?>selected<? }?>>fixed value</option> 
          <option value="multiple" <? if ($Action == "Update" && $rs[5] == "multiple") {?>selected<? }?>>Multiply by each weight</option> 
        </select> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Shipping Rate:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        $ <input name="shipping_rate" type="text" value="<? if (isset($shipping_rate)) {?><?=$shipping_rate?><? } else if ($Action == "Update") {?><?=$rs[4]?><? }?>"> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">State:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="state"> 
          <option value="All States" <? if ($Action == "Update" && $rs[6] == "All States") {?>selected<? }?>>All States </option> 
          <option value="AL" <? if ($Action == "Update" && $rs[6] == "AL") {?>selected<? }?>>AL-Alabama </option> 
          <option value="AK" <? if ($Action == "Update" && $rs[6] == "AK") {?>selected<? }?>>AK-Alaska </option> 
          <option value="AZ" <? if ($Action == "Update" && $rs[6] == "AZ") {?>selected<? }?>>AZ-Arizona </option> 
          <option value="AR" <? if ($Action == "Update" && $rs[6] == "AR") {?>selected<? }?>>AR-Arkansas </option> 
          <option value="CA" <? if ($Action == "Update" && $rs[6] == "CA") {?>selected<? }?>>CA-California </option> 
          <option value="CO" <? if ($Action == "Update" && $rs[6] == "CO") {?>selected<? }?>>CO-Colorado </option> 
          <option value="CT" <? if ($Action == "Update" && $rs[6] == "CT") {?>selected<? }?>>CT-Connecticut </option> 
          <option value="DC" <? if ($Action == "Update" && $rs[6] == "DC") {?>selected<? }?>>DC-Washington D.C. </option> 
          <option value="DE" <? if ($Action == "Update" && $rs[6] == "DE") {?>selected<? }?>>DE-Delaware </option> 
          <option value="FL" <? if ($Action == "Update" && $rs[6] == "FL") {?>selected<? }?>>FL-Florida </option> 
          <option value="GA" <? if ($Action == "Update" && $rs[6] == "GA") {?>selected<? }?>>GA-Georgia </option> 
          <option value="HI" <? if ($Action == "Update" && $rs[6] == "HI") {?>selected<? }?>>HI-Hawaii </option> 
          <option value="ID" <? if ($Action == "Update" && $rs[6] == "ID") {?>selected<? }?>>ID-Idaho </option> 
          <option value="IL" <? if ($Action == "Update" && $rs[6] == "IL") {?>selected<? }?>>IL-Illinois </option> 
          <option value="IN" <? if ($Action == "Update" && $rs[6] == "IN") {?>selected<? }?>>IN-Indiana </option> 
          <option value="IA" <? if ($Action == "Update" && $rs[6] == "IA") {?>selected<? }?>>IA-Iowa </option> 
          <option value="KS" <? if ($Action == "Update" && $rs[6] == "KS") {?>selected<? }?>>KS-Kansas </option> 
          <option value="KY" <? if ($Action == "Update" && $rs[6] == "KY") {?>selected<? }?>>KY-Kentucky </option> 
          <option value="LA" <? if ($Action == "Update" && $rs[6] == "LA") {?>selected<? }?>>LA-Louisiana </option> 
          <option value="ME" <? if ($Action == "Update" && $rs[6] == "ME") {?>selected<? }?>>ME-Maine </option> 
          <option value="MD" <? if ($Action == "Update" && $rs[6] == "MD") {?>selected<? }?>>MD-Maryland </option> 
          <option value="MA" <? if ($Action == "Update" && $rs[6] == "MA") {?>selected<? }?>>MA-Massachusetts </option> 
          <option value="MI" <? if ($Action == "Update" && $rs[6] == "MI") {?>selected<? }?>>MI-Michigan </option> 
          <option value="MN" <? if ($Action == "Update" && $rs[6] == "MN") {?>selected<? }?>>MN-Minnesota </option> 
          <option value="MS" <? if ($Action == "Update" && $rs[6] == "MS") {?>selected<? }?>>MS-Mississippi </option> 
          <option value="MO" <? if ($Action == "Update" && $rs[6] == "MO") {?>selected<? }?>>MO-Missouri </option> 
          <option value="MT" <? if ($Action == "Update" && $rs[6] == "MT") {?>selected<? }?>>MT-Montana </option> 
          <option value="NE" <? if ($Action == "Update" && $rs[6] == "NE") {?>selected<? }?>>NE-Nebraska </option> 
          <option value="NV" <? if ($Action == "Update" && $rs[6] == "NV") {?>selected<? }?>>NV-Nevada </option> 
          <option value="NH" <? if ($Action == "Update" && $rs[6] == "NH") {?>selected<? }?>>NH-New Hampshire </option> 
          <option value="NJ" <? if ($Action == "Update" && $rs[6] == "NJ") {?>selected<? }?>>NJ-New Jersey </option> 
          <option value="NM" <? if ($Action == "Update" && $rs[6] == "NM") {?>selected<? }?>>NM-New Mexico </option> 
          <option value="NY" <? if ($Action == "Update" && $rs[6] == "NY") {?>selected<? }?>>NY-New York </option> 
          <option value="NC" <? if ($Action == "Update" && $rs[6] == "NC") {?>selected<? }?>>NC-North Carolina </option> 
          <option value="ND" <? if ($Action == "Update" && $rs[6] == "ND") {?>selected<? }?>>ND-North Dakota </option> 
          <option value="OH" <? if ($Action == "Update" && $rs[6] == "OH") {?>selected<? }?>>OH-Ohio </option> 
          <option value="OK" <? if ($Action == "Update" && $rs[6] == "OK") {?>selected<? }?>>OK-Oklahoma </option> 
          <option value="OR" <? if ($Action == "Update" && $rs[6] == "OR") {?>selected<? }?>>OR-Oregon </option> 
          <option value="PA" <? if ($Action == "Update" && $rs[6] == "PA") {?>selected<? }?>>PA-Pennsylvania </option> 
          <option value="PR" <? if ($Action == "Update" && $rs[6] == "PR") {?>selected<? }?>>PR-Puerto Rico </option> 
          <option value="RI" <? if ($Action == "Update" && $rs[6] == "RI") {?>selected<? }?>>RI-Rhode Island </option> 
          <option value="SC" <? if ($Action == "Update" && $rs[6] == "SC") {?>selected<? }?>>SC-South Carolina </option> 
          <option value="SD" <? if ($Action == "Update" && $rs[6] == "SD") {?>selected<? }?>>SD-South Dakota </option> 
          <option value="TN" <? if ($Action == "Update" && $rs[6] == "TN") {?>selected<? }?>>TN-Tennessee </option> 
          <option value="TX" <? if ($Action == "Update" && $rs[6] == "TX") {?>selected<? }?>>TX-Texas </option> 
          <option value="UT" <? if ($Action == "Update" && $rs[6] == "UT") {?>selected<? }?>>UT-Utah </option> 
          <option value="VT" <? if ($Action == "Update" && $rs[6] == "VT") {?>selected<? }?>>VT-Vermont </option> 
          <option value="VA" <? if ($Action == "Update" && $rs[6] == "VA") {?>selected<? }?>>VA-Virginia </option> 
          <option value="WA" <? if ($Action == "Update" && $rs[6] == "WA") {?>selected<? }?>>WA-Washington </option> 
          <option value="WV" <? if ($Action == "Update" && $rs[6] == "WV") {?>selected<? }?>>WV-West Virginia </option> 
          <option value="WI" <? if ($Action == "Update" && $rs[6] == "WI") {?>selected<? }?>>WI-Wisconsin </option> 
          <option value="WY" <? if ($Action == "Update" && $rs[6] == "WY") {?>selected<? }?>>WY-Wyoming </option> 
        </select> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">City:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="city" type="text" value="<? if (isset($city)) {?><?=$city?><? } else if ($Action == "Update") {?><?=$rs[7]?><? } else {?>All Cities<? }?>"> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Zip:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="zip" type="text" value="<? if (isset($zip)) {?><?=$zip?><? } else if ($Action == "Update") {?><?=$rs[8]?><? } else {?>All Zip<? }?>"> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Country:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="country" type="text" value="<? if (isset($country)) {?><?=$country?><? } else if ($Action == "Update") {?><?=$rs[9]?><? } else {?>United States<? }?>"> 
        </font></td> 
    </tr> 
    <? } else {?> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Total Purchase Low:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="total_purchase_low" type="text" value="<? if (isset($total_purchase_low)) {?><?=$total_purchase_low?><? } else if ($Action == "Update") {?><?=$rs[3]?><? }?>"> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Total Purchase High:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="total_purchase_high" type="text" value="<? if (isset($total_purchase_high)) {?><?=$total_purchase_high?><? } else if ($Action == "Update") {?><?=$rs[4]?><? }?>"> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Zip Code Low:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="zip_code_low" type="text" value="<? if (isset($zip_code_low)) {?><?=$zip_code_low?><? } else if ($Action == "Update") {?><?=$rs[5]?><? } else {?>0<? }?>"> 
        (enter only the first 3 digit of the zip code, e.g. 937, 945, etc.)</font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Zip Code High:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="zip_code_high" type="text" value="<? if (isset($zip_code_high)) {?><?=$zip_code_high?><? } else if ($Action == "Update") {?><?=$rs[6]?><? } else {?>999<? }?>"> 
        (enter only the first 3 digit of the zip code, e.g. 937, 945, etc.)</font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Rate Type:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="rate_type"> 
          <option value="percentage" <? if ($Action == "Update" && $rs[7] == "percentage") {?>selected<? }?>> percentage </option> 
          <option value="fixed value" <? if ($Action == "Update" && $rs[7] == "fixed value") {?>selected<? }?>> fixed value </option> 
        </select> 
        </font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Shipping Rate:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <input name="shipping_rate" type="text" value="<? if (isset($shipping_rate)) {?><?=$shipping_rate?><? } else if ($Action == "Update") {?><?=$rs[8]?><? }?>"> 
        (for percentage, enter the decimal value such as 0.05 for 5%)</font></td> 
    </tr> 
    <tr> 
      <td align="right"><font size="-1" face="Verdana, Arial, Helvetica, sans-serif">Shipping Destination:</font></td> 
      <td> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <select name="shipping_destination"> 
          <option value="domestic and international" <? if ($Action == "Update" && $rs[9] == "domestic and international") {?>selected<? }?>> Domestic & International </option> 
          <option value="domestic" <? if ($Action == "Update" && $rs[9] == "domestic") {?>selected<? }?>> Domestic </option> 
          <option value="international" <? if ($Action == "Update" && $rs[9] == "international") {?>selected<? }?>> International </option> 
        </select> 
        </font></td> 
    </tr> 
    <? }?> 
  </table> 
  <p>&nbsp;</p> 
  <p> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
    <input type="submit" name="Submit" value="<?=$Action?> Shipping Rate" onClick="validateForm(this.form);"> 
    <input name="Reset" type="reset" id="Reset" value="Reset"> 
    </font></p> 
</form> 
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
<? } else {?> 
</font><font face="Verdana, Arial, Helvetica, sans-serif"> </font> 
<table border="0" align="center" cellpadding="0" cellspacing="0"> 
  <tr> 
    <td width="118"><a href="shipping_rate.php?Action=Add"><img src="../../images/add_shipping_rate.gif" width="118" height="21" border="0"></a></td> 
    <td width="8">&nbsp;&nbsp;</td> 
    <td width="119"><a href="shipping_vendor.php"><img src="../../images/shipping_vendors.gif" width="118" height="21" border="0"></a></td> 
  </tr> 
</table> 
<br> 
<table border="0" cellpadding="8" cellspacing="0"> 
  <tr> 
    <? for($i=0;$i<count($field_name);$i++) {?> 
    <td bgcolor="#999999"> <font color="#FFFFFF" size="-1" face="Verdana, Arial, Helvetica, sans-serif"> <strong> 
      <? if ($calc_method == "by product" && $i == 1) {?> 
      PRODUCT NAME
	  <? } else if ($calc_method == "by weight" && $i != 0) {?> 
      <?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
      <? } else if (($calc_method == "by total purchase" && $i != 0) || $i != 0 && $i != 7 && $i != 8 && $i !=9) {?> 
      <?=strtoupper(str_replace("_"," ",$field_name[$i]))?> 
      <? }?> 
      </strong> </font></td> 
    <? }?> 
  </tr> 
  <? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?> 
  <tr> 
    <? for($i=0;$i<count($rs);$i++) {?> 
    <td align="center" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>"> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <? if ($calc_method == "by product" && $i == 1) {
					$HTTP_SESSION_VARS["db_connect"]->open();
					mysql_select_db($HTTP_SESSION_VARS["selected_db"]);
					$query = "SELECT PRODUCT_NAME FROM PRODUCT WHERE PRODUCT_ID = $rs[$i]";
					$result = mysql_fetch_row(mysql_query($query));?> 
      <a href="shipping_rate_info.php?id=<?=$rs[0]?>"> 
      <? if ($rs[1] == 0) {?> 
      All Products 
      <? } else {?> 
      <?=$result[0]?> 
      <? }?> 
      </a> 
      <? $HTTP_SESSION_VARS["db_connect"]->close();?> 
	  <? } else if ($calc_method == "by weight" && $i != 0) {?> 
	  <?=$rs[$i]?> 
      <? } else if (($calc_method == "by total purchase" && $i != 0) || ($i != 0 && $i != 7 && $i != 8 && $i !=9)) {?> 
      <?=$rs[$i]?> 
      <? }?> 
      </font></td> 
    <? }?> 
    <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="Update" type="button" id="Update" value="Edit" onClick="editShippingRate('<?=$rs[0]?>');"> 
      </font></td> 
    <td><font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <input name="Delete" type="button" id="Delete" value="Delete" onClick="deleteShippingRate('<?=$rs[0]?>');"> 
      </font></td> 
  </tr> 
  <? }?> 
</table> 
<p>  
<center> 
  <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> </font> 
  <table border="0" align="center" cellpadding="0" cellspacing="0"> 
    <tr> 
      <td width="118"><a href="shipping_rate.php?Action=Add"><img src="../../images/add_shipping_rate.gif" width="118" height="21" border="0"></a></td> 
      <td width="8">&nbsp;&nbsp;</td> 
      <td width="119"><a href="shipping_vendor.php"><img src="../../images/shipping_vendors.gif" width="118" height="21" border="0"></a></td> 
    </tr> 
  </table> 
</center> 
</p> 
<font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
<? }?> 
</font> 
</body>
</html>
