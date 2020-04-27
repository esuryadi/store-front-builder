<?php
require_once "../class/User.php";
require_once "../class/DBConnect.php";
require_once "../class/Clients.php";
require_once("config.php");
?>
<html>
<head>
<?php
$db_connect = new DBConnect(_HOST,_USERID,_PASSWORD);
$db_connect->open();

mysql_select_db(_ADMIN_DATABASE);
$query = "SELECT order_id,order_date,client_first_name,client_last_name,company_name,subscription_package,order_status,build_status FROM PURCHASE_ORDER";	
$query_result = mysql_query($query);

for ($i=0;$i<mysql_num_fields($query_result);$i++)
	$field_name [] = mysql_field_name($query_result,$i);
	
$db_connect->close();

if (isset($Action) && $Action == "Add") {
	if (session_is_registered("client")) 
		$client = $HTTP_SESSION_VARS["client"];
	else
		$client = new Clients();
}
?>
<title>Manage Order</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function deletePrice(id) {
	var url = "manage_order_result.php?Action=Delete&order_id=" + id;
	open(url,"_self");
}

function changeOrderStatus(status,id) {
	var url = "manage_order_result.php?Action=Update&order_status=" + status + "&order_id=" + id;
	open(url,"_self");
}

function setBillingInformation(form) {
	form.billing_first_name.value = form.first_name.value;
	form.billing_middle_initial.value = form.middle_initial.value;
	form.billing_last_name.value = form.last_name.value;
	form.billing_address_1.value = form.company_address_1.value;
	form.billing_address_2.value = form.company_address_2.value;
	form.billing_city.value = form.company_city.value;
	form.billing_state.value = form.company_state.value;
	form.billing_zip.value = form.company_zip.value;
	form.billing_country.value = form.company_country.value;
	form.billing_province.value = form.company_province.value;
	form.billing_phone.value = form.company_phone.value;
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.first_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "First Name cannot be empty\n";
	}
	if (form.last_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "Last Name cannot be empty\n";
	}
	if (form.company_address_1.value == "") {
		is_valid = false;
		err_msg = err_msg + "Address cannot be empty\n";
	}
	if (form.company_city.value == "") {
		is_valid = false;
		err_msg = err_msg + "City cannot be empty\n";
	}
	if (form.company_state.value == "" && form.company_province.value == "") {
		is_valid = false;
		err_msg = err_msg + "State or Province cannot be empty\n";
	}
	if (form.company_zip.value == "") {
		is_valid = false;
		err_msg = err_msg + "Zip Code cannot be empty\n";
	}
	if (form.company_phone.value == "") {
		is_valid = false;
		err_msg = err_msg + "Day Phone cannot be empty\n";
	}
	if (form.company_email.value == "") {
		is_valid = false;
		err_msg = err_msg + "Email cannot be empty\n";
	}
	if (form.billing_first_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing First Name cannot be empty\n";
	}
	if (form.billing_last_name.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing Last Name cannot be empty\n";
	}
	if (form.billing_address_1.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing Address cannot be empty\n";
	}
	if (form.billing_city.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing City cannot be empty\n";
	}
	if (form.billing_state.value == "" && form.billing_province.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing State or Province cannot be empty\n";
	}
	if (form.billing_zip.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing Zip Code cannot be empty\n";
	}
	if (form.billing_phone.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing Telephone cannot be empty\n";
	}
	if (form.payment_type.value == "") {
		is_valid = false;
		err_msg = err_msg + "Payment Type cannot be empty\n";
	}
	if (form.cc_number.value == "") {
		is_valid = false;
		err_msg = err_msg + "Credit Card number cannot be empty\n";
	}
	
	if (!is_valid && err_msg != "")
		alert(err_msg);
		
	event.returnValue = is_valid;
}

</script>
</head>

<body vlink="00aeef">
<font color="00aeef" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Manage 
Order </strong></font> 

<? if (isset($Action) && $Action == "Add") {?>
	<form method="POST" action="manage_order_result.php">
	<input type="hidden" name="Action" value="<?=$Action?>">
	<table>
    <tr> 
      <td><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">One 
        Time Setup Fee:</font></b></td>
      <td><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
        <input type="text" name="one_time_setup_fee" value="<?=$client->getOneTimeSetupFee()?>">
        </font></td>
    </tr>
    <tr> 
      <td><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Recurring 
        Monthly Fee:</font></b></td>
      <td><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
        <input type="text" name="recurring_monthly_fee" value="<?=$client->getRecurringMonthlyFee()?>">
        </font></td>
    </tr>
    <tr> 
      <td><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Domain 
        Name:</font></b></td>
      <td><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
        <input type="text" name="domain_name" value="<?=$client->getDomainName()?>">
        </font>
    </tr>
    <tr> 
      <td><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Domain 
        Status:</font></b></td>
      <td> <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
        <select name="domain_status">
          <option value="new" <? if ($client->getDomainStatus() == "new") {?>selected<? }?>>New</option>
          <option value="transfer" <? if ($client->getDomainStatus() == "transfer") {?>selected<? }?>>Transfer</option>
        </select>
        </font></td>
    </tr>
    <tr> 
      <td><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Subscription 
        Package:</font></b></td>
      <td> <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
        <select name="subscription_package">
          <option value="mini">Mini Store Package</option>
          <option value="basic">Basic Store Package</option>
          <option value="standard">Standard Store Package</option>
          <option value="professional">Professional Store Package</option>
          <option value="duluxe">Deluxe Store Package</option>
        </select>
        </font></td>
    </tr>
    <tr> 
      <td valign="top"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Additional 
        Options:</font></b></td>
      <td> <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
        <textarea name="additional_options" cols="40" rows="5"></textarea>
        </font></td>
    </tr>
  </table>
	<h2><u><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">New Client 
    Information</font></u></h2>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>First Name: 
    <input type="text" name="first_name" size="15" value="<?=$client->getFirstName()?>">
    M.I: 
    <input type="text" name="middle_initial" size="1" value="<?=$client->getMiddleInitial()?>">
    Last Name: 
    <input type="text" name="last_name" size="15" value="<?=$client->getLastName()?>">
    </b></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Company Name: 
    <input type="text" name="company_name" value="<?=$client->getCompanyName()?>">
    </b></font></p>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td width="14%" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Company 
        Address:</b></font></td>
      <td width="86%" valign="top"> 
        <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b> 
          <input type="text" name="company_address_1" size="40" value="<?=$client->getCompanyAddress1()?>">
          <br>
          <input type="text" name="company_address_2" size="40" value="<?=$client->getCompanyAddress2()?>">
          <br>
          City: 
          <input type="text" name="company_city" size="10" value="<?=$client->getCompanyCity()?>">
          State: 
          <select name="company_state">
            <option value="">-Select State-</option>
            <option value="AL" <? if ($client->getCompanyState() == "AL") {?>selected<? }?>>AL-Alabama 
            </option>
            <option value="AK" <? if ($client->getCompanyState() == "AK") {?>selected<? }?>>AK-Alaska 
            </option>
            <option value="AZ" <? if ($client->getCompanyState() == "AZ") {?>selected<? }?>>AZ-Arizona 
            </option>
            <option value="AR" <? if ($client->getCompanyState() == "AR") {?>selected<? }?>>AR-Arkansas 
            </option>
            <option value="CA" <? if ($client->getCompanyState() == "CA") {?>selected<? }?>>CA-California 
            </option>
            <option value="CO" <? if ($client->getCompanyState() == "CO") {?>selected<? }?>>CO-Colorado 
            </option>
            <option value="CT" <? if ($client->getCompanyState() == "CT") {?>selected<? }?>>CT-Connecticut 
            </option>
            <option value="DC" <? if ($client->getCompanyState() == "DC") {?>selected<? }?>>DC-Washington 
            D.C. </option>
            <option value="DE" <? if ($client->getCompanyState() == "DE") {?>selected<? }?>>DE-Delaware 
            </option>
            <option value="FL" <? if ($client->getCompanyState() == "FL") {?>selected<? }?>>FL-Florida 
            </option>
            <option value="GA" <? if ($client->getCompanyState() == "GA") {?>selected<? }?>>GA-Georgia 
            </option>
            <option value="HI" <? if ($client->getCompanyState() == "HI") {?>selected<? }?>>HI-Hawaii 
            </option>
            <option value="ID" <? if ($client->getCompanyState() == "ID") {?>selected<? }?>>ID-Idaho 
            </option>
            <option value="IL" <? if ($client->getCompanyState() == "IL") {?>selected<? }?>>IL-Illinois 
            </option>
            <option value="IN" <? if ($client->getCompanyState() == "IN") {?>selected<? }?>>IN-Indiana 
            </option>
            <option value="IA" <? if ($client->getCompanyState() == "IA") {?>selected<? }?>>IA-Iowa 
            </option>
            <option value="KS" <? if ($client->getCompanyState() == "KS") {?>selected<? }?>>KS-Kansas 
            </option>
            <option value="KY" <? if ($client->getCompanyState() == "KY") {?>selected<? }?>>KY-Kentucky 
            </option>
            <option value="LA" <? if ($client->getCompanyState() == "LA") {?>selected<? }?>>LA-Louisiana 
            </option>
            <option value="ME" <? if ($client->getCompanyState() == "ME") {?>selected<? }?>>ME-Maine 
            </option>
            <option value="MD" <? if ($client->getCompanyState() == "MD") {?>selected<? }?>>MD-Maryland 
            </option>
            <option value="MA" <? if ($client->getCompanyState() == "MA") {?>selected<? }?>>MA-Massachusetts 
            </option>
            <option value="MI" <? if ($client->getCompanyState() == "MI") {?>selected<? }?>>MI-Michigan 
            </option>
            <option value="MN" <? if ($client->getCompanyState() == "MN") {?>selected<? }?>>MN-Minnesota 
            </option>
            <option value="MS" <? if ($client->getCompanyState() == "MS") {?>selected<? }?>>MS-Mississippi 
            </option>
            <option value="MO" <? if ($client->getCompanyState() == "MO") {?>selected<? }?>>MO-Missouri 
            </option>
            <option value="MT" <? if ($client->getCompanyState() == "MT") {?>selected<? }?>>MT-Montana 
            </option>
            <option value="NE" <? if ($client->getCompanyState() == "NE") {?>selected<? }?>>NE-Nebraska 
            </option>
            <option value="NV" <? if ($client->getCompanyState() == "NV") {?>selected<? }?>>NV-Nevada 
            </option>
            <option value="NH" <? if ($client->getCompanyState() == "NH") {?>selected<? }?>>NH-New 
            Hampshire </option>
            <option value="NJ" <? if ($client->getCompanyState() == "NJ") {?>selected<? }?>>NJ-New 
            Jersey </option>
            <option value="NM" <? if ($client->getCompanyState() == "NM") {?>selected<? }?>>NM-New 
            Mexico </option>
            <option value="NY" <? if ($client->getCompanyState() == "NY") {?>selected<? }?>>NY-New 
            York </option>
            <option value="NC" <? if ($client->getCompanyState() == "NC") {?>selected<? }?>>NC-North 
            Carolina </option>
            <option value="ND" <? if ($client->getCompanyState() == "ND") {?>selected<? }?>>ND-North 
            Dakota </option>
            <option value="OH" <? if ($client->getCompanyState() == "OH") {?>selected<? }?>>OH-Ohio 
            </option>
            <option value="OK" <? if ($client->getCompanyState() == "OK") {?>selected<? }?>>OK-Oklahoma 
            </option>
            <option value="OR" <? if ($client->getCompanyState() == "OR") {?>selected<? }?>>OR-Oregon 
            </option>
            <option value="PA" <? if ($client->getCompanyState() == "PA") {?>selected<? }?>>PA-Pennsylvania 
            </option>
            <option value="PR" <? if ($client->getCompanyState() == "PR") {?>selected<? }?>>PR-Puerto 
            Rico </option>
            <option value="RI" <? if ($client->getCompanyState() == "RI") {?>selected<? }?>>RI-Rhode 
            Island </option>
            <option value="SC" <? if ($client->getCompanyState() == "SC") {?>selected<? }?>>SC-South 
            Carolina </option>
            <option value="SD" <? if ($client->getCompanyState() == "SD") {?>selected<? }?>>SD-South 
            Dakota </option>
            <option value="TN" <? if ($client->getCompanyState() == "TN") {?>selected<? }?>>TN-Tennessee 
            </option>
            <option value="TX" <? if ($client->getCompanyState() == "TX") {?>selected<? }?>>TX-Texas 
            </option>
            <option value="UT" <? if ($client->getCompanyState() == "UT") {?>selected<? }?>>UT-Utah 
            </option>
            <option value="VT" <? if ($client->getCompanyState() == "VT") {?>selected<? }?>>VT-Vermont 
            </option>
            <option value="VA" <? if ($client->getCompanyState() == "VA") {?>selected<? }?>>VA-Virginia 
            </option>
            <option value="WA" <? if ($client->getCompanyState() == "WA") {?>selected<? }?>>WA-Washington 
            </option>
            <option value="WV" <? if ($client->getCompanyState() == "WV") {?>selected<? }?>>WV-West 
            Virginia </option>
            <option value="WI" <? if ($client->getCompanyState() == "WI") {?>selected<? }?>>WI-Wisconsin 
            </option>
            <option value="WY" <? if ($client->getCompanyState() == "WY") {?>selected<? }?>>WY-Wyoming 
            </option>
          </select>
          Zip: 
          <input type="text" name="company_zip" size="5" maxlength="5" value="<?=$client->getCompanyZip()?>">
          <br>
          Country: 
          <input type="text" name="company_country" value="<? if ($client->getCompanyCountry() == "") {?>United States<? } else {?><?=$client->getCompanyCountry()?><? }?>">
          <br>
          Province: 
          <input type="text" name="company_province" value="<?=$client->getCompanyProvince()?>">
          (for country other than United States) </b></font></p>
      </td>
    </tr>
  </table>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Company Phone: 
    <input type="text" name="company_phone" value="<?=$client->getCompanyPhone()?>">
    </b></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Company Fax: 
    <input type="text" name="company_fax" value="<?=$client->getCompanyFax()?>">
    </b></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Company Email: 
    <input type="text" name="company_email" size="40" value="<?=$client->getCompanyEmail()?>">
    </b></font></p>
  <h2><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><br>
    <u>Billing Information</u></font></h2>
  <p> <font face="Verdana, Arial, Helvetica, sans-serif" size="-1"> 
    <input type="checkbox" name="same_as_above" value="checkbox" onClick="setBillingInformation(this.form);">
    <b> Same as Customer Information</b></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>First Name: 
    <input type="text" name="billing_first_name" size="15" value="<?=$client->getBillingFirstName()?>">
    M.I: 
    <input type="text" name="billing_middle_initial" size="1" value="<?=$client->getBillingMiddleInitial()?>">
    Last Name: 
    <input type="text" name="billing_last_name" size="15" value="<?=$client->getBillingLastName()?>">
    </b></font></p>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td width="13%" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Billing 
        Address:</b></font></td>
      <td width="87%" valign="top"> 
        <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b> 
          <input type="text" name="billing_address_1" size="40" value="<?=$client->getBillingAddress1()?>">
          <br>
          <input type="text" name="billing_address_2" size="40" value="<?=$client->getBillingAddress2()?>">
          <br>
          City: 
          <input type="text" name="billing_city" size="10" value="<?=$client->getBillingCity()?>">
          State: 
          <select name="billing_state">
            <option value="">-Select State-</option>
            <option value="AL" <? if ($client->getBillingState() == "AL") {?>selected<? }?>>AL-Alabama 
            </option>
            <option value="AK" <? if ($client->getBillingState() == "AK") {?>selected<? }?>>AK-Alaska 
            </option>
            <option value="AZ" <? if ($client->getBillingState() == "AZ") {?>selected<? }?>>AZ-Arizona 
            </option>
            <option value="AR" <? if ($client->getBillingState() == "AR") {?>selected<? }?>>AR-Arkansas 
            </option>
            <option value="CA" <? if ($client->getBillingState() == "CA") {?>selected<? }?>>CA-California 
            </option>
            <option value="CO" <? if ($client->getBillingState() == "CO") {?>selected<? }?>>CO-Colorado 
            </option>
            <option value="CT" <? if ($client->getBillingState() == "CT") {?>selected<? }?>>CT-Connecticut 
            </option>
            <option value="DC" <? if ($client->getBillingState() == "DC") {?>selected<? }?>>DC-Washington 
            D.C. </option>
            <option value="DE" <? if ($client->getBillingState() == "DE") {?>selected<? }?>>DE-Delaware 
            </option>
            <option value="FL" <? if ($client->getBillingState() == "FL") {?>selected<? }?>>FL-Florida 
            </option>
            <option value="GA" <? if ($client->getBillingState() == "GA") {?>selected<? }?>>GA-Georgia 
            </option>
            <option value="HI" <? if ($client->getBillingState() == "HI") {?>selected<? }?>>HI-Hawaii 
            </option>
            <option value="ID" <? if ($client->getBillingState() == "ID") {?>selected<? }?>>ID-Idaho 
            </option>
            <option value="IL" <? if ($client->getBillingState() == "IL") {?>selected<? }?>>IL-Illinois 
            </option>
            <option value="IN" <? if ($client->getBillingState() == "IN") {?>selected<? }?>>IN-Indiana 
            </option>
            <option value="IA" <? if ($client->getBillingState() == "IA") {?>selected<? }?>>IA-Iowa 
            </option>
            <option value="KS" <? if ($client->getBillingState() == "KS") {?>selected<? }?>>KS-Kansas 
            </option>
            <option value="KY" <? if ($client->getBillingState() == "KY") {?>selected<? }?>>KY-Kentucky 
            </option>
            <option value="LA" <? if ($client->getBillingState() == "LA") {?>selected<? }?>>LA-Louisiana 
            </option>
            <option value="ME" <? if ($client->getBillingState() == "ME") {?>selected<? }?>>ME-Maine 
            </option>
            <option value="MD" <? if ($client->getBillingState() == "MD") {?>selected<? }?>>MD-Maryland 
            </option>
            <option value="MA" <? if ($client->getBillingState() == "MA") {?>selected<? }?>>MA-Massachusetts 
            </option>
            <option value="MI" <? if ($client->getBillingState() == "MI") {?>selected<? }?>>MI-Michigan 
            </option>
            <option value="MN" <? if ($client->getBillingState() == "MN") {?>selected<? }?>>MN-Minnesota 
            </option>
            <option value="MS" <? if ($client->getBillingState() == "MS") {?>selected<? }?>>MS-Mississippi 
            </option>
            <option value="MO" <? if ($client->getBillingState() == "MO") {?>selected<? }?>>MO-Missouri 
            </option>
            <option value="MT" <? if ($client->getBillingState() == "MT") {?>selected<? }?>>MT-Montana 
            </option>
            <option value="NE" <? if ($client->getBillingState() == "NE") {?>selected<? }?>>NE-Nebraska 
            </option>
            <option value="NV" <? if ($client->getBillingState() == "NV") {?>selected<? }?>>NV-Nevada 
            </option>
            <option value="NH" <? if ($client->getBillingState() == "NH") {?>selected<? }?>>NH-New 
            Hampshire </option>
            <option value="NJ" <? if ($client->getBillingState() == "NJ") {?>selected<? }?>>NJ-New 
            Jersey </option>
            <option value="NM" <? if ($client->getBillingState() == "NM") {?>selected<? }?>>NM-New 
            Mexico </option>
            <option value="NY" <? if ($client->getBillingState() == "NY") {?>selected<? }?>>NY-New 
            York </option>
            <option value="NC" <? if ($client->getBillingState() == "NC") {?>selected<? }?>>NC-North 
            Carolina </option>
            <option value="ND" <? if ($client->getBillingState() == "ND") {?>selected<? }?>>ND-North 
            Dakota </option>
            <option value="OH" <? if ($client->getBillingState() == "OH") {?>selected<? }?>>OH-Ohio 
            </option>
            <option value="OK" <? if ($client->getBillingState() == "OK") {?>selected<? }?>>OK-Oklahoma 
            </option>
            <option value="OR" <? if ($client->getBillingState() == "OR") {?>selected<? }?>>OR-Oregon 
            </option>
            <option value="PA" <? if ($client->getBillingState() == "PA") {?>selected<? }?>>PA-Pennsylvania 
            </option>
            <option value="PR" <? if ($client->getBillingState() == "PR") {?>selected<? }?>>PR-Puerto 
            Rico </option>
            <option value="RI" <? if ($client->getBillingState() == "RI") {?>selected<? }?>>RI-Rhode 
            Island </option>
            <option value="SC" <? if ($client->getBillingState() == "SC") {?>selected<? }?>>SC-South 
            Carolina </option>
            <option value="SD" <? if ($client->getBillingState() == "SD") {?>selected<? }?>>SD-South 
            Dakota </option>
            <option value="TN" <? if ($client->getBillingState() == "TN") {?>selected<? }?>>TN-Tennessee 
            </option>
            <option value="TX" <? if ($client->getBillingState() == "TX") {?>selected<? }?>>TX-Texas 
            </option>
            <option value="UT" <? if ($client->getBillingState() == "UT") {?>selected<? }?>>UT-Utah 
            </option>
            <option value="VT" <? if ($client->getBillingState() == "VT") {?>selected<? }?>>VT-Vermont 
            </option>
            <option value="VA" <? if ($client->getBillingState() == "VA") {?>selected<? }?>>VA-Virginia 
            </option>
            <option value="WA" <? if ($client->getBillingState() == "WA") {?>selected<? }?>>WA-Washington 
            </option>
            <option value="WV" <? if ($client->getBillingState() == "WV") {?>selected<? }?>>WV-West 
            Virginia </option>
            <option value="WI" <? if ($client->getBillingState() == "WI") {?>selected<? }?>>WI-Wisconsin 
            </option>
            <option value="WY" <? if ($client->getBillingState() == "WY") {?>selected<? }?>>WY-Wyoming 
            </option>
          </select>
          Zip: 
          <input type="text" name="billing_zip" size="5" maxlength="5" value="<?=$client->getBillingZip()?>">
          <br>
          Country: 
          <input type="text" name="billing_country" value="<? if ($client->getBillingCountry() == "") {?>United States<? } else {?><?=$client->getBillingCountry()?><? }?>">
          <br>
          Province: 
          <input type="text" name="billing_province" value="<?=$client->getBillingProvince()?>">
          (for country other than United States)</b></font></p>
      </td>
    </tr>
  </table>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Billing Phone: 
    <input type="text" name="billing_phone" value="<?=$client->getBillingPhone()?>">
    </b></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Payment Type: 
    <select name="payment_type">
      <option value="">-Select Payment Type-</option>
      <option value="Visa" <? if ($client->getPaymentType() == "Visa") {?>selected<? }?>>Visa</option>
      <option value="Master Card" <? if ($client->getPaymentType() == "Master Card") {?>selected<? }?>>Master 
      Card</option>
      <option value="Discover" <? if ($client->getPaymentType() == "Discover") {?>selected<? }?>>Discover</option>
      <option value="American Express" <? if ($client->getPaymentType() == "American Express") {?>selected<? }?>>American 
      Express</option>
    </select>
    </b></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Credit Card 
    Number: 
    <input type="text" name="cc_number" size="16" maxlength="16" value="<?=$client->getCCNumber()?>">
    </b></font></p>
  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Credit Card 
    Exp. Date:</b> 
    <select name="cc_exp_mm" size="1" tabindex="41">
      <option value="01" <? if (substr($client->getCCExpDate(),0,2) == "01") {?>selected<? }?>>01</option>
      <option value="02" <? if (substr($client->getCCExpDate(),0,2) == "02") {?>selected<? }?>>02</option>
      <option value="03" <? if (substr($client->getCCExpDate(),0,2) == "03") {?>selected<? }?>>03</option>
      <option value="04" <? if (substr($client->getCCExpDate(),0,2) == "04") {?>selected<? }?>>04</option>
      <option value="05" <? if (substr($client->getCCExpDate(),0,2) == "05") {?>selected<? }?>>05</option>
      <option value="06" <? if (substr($client->getCCExpDate(),0,2) == "06") {?>selected<? }?>>06</option>
      <option value="07" <? if (substr($client->getCCExpDate(),0,2) == "07") {?>selected<? }?>>07</option>
      <option value="08" <? if (substr($client->getCCExpDate(),0,2) == "08") {?>selected<? }?>>08</option>
      <option value="09" <? if (substr($client->getCCExpDate(),0,2) == "09") {?>selected<? }?>>09</option>
      <option value="10" <? if (substr($client->getCCExpDate(),0,2) == "10") {?>selected<? }?>>10</option>
      <option value="11" <? if (substr($client->getCCExpDate(),0,2) == "11") {?>selected<? }?>>11</option>
      <option value="12" <? if (substr($client->getCCExpDate(),0,2) == "12") {?>selected<? }?>>12</option>
    </select>
    / 
    <select name="cc_exp_yyyy" size="1" tabindex="43">
      <option value="02" <? if (substr($client->getCCExpDate(),2,2) == "02") {?>selected<? }?>>2002</option>
      <option value="03" <? if (substr($client->getCCExpDate(),2,2) == "03") {?>selected<? }?>>2003</option>
      <option value="04" <? if (substr($client->getCCExpDate(),2,2) == "04") {?>selected<? }?>>2004</option>
      <option value="05" <? if (substr($client->getCCExpDate(),2,2) == "05") {?>selected<? }?>>2005</option>
      <option value="06" <? if (substr($client->getCCExpDate(),2,2) == "06") {?>selected<? }?>>2006</option>
      <option value="07" <? if (substr($client->getCCExpDate(),2,2) == "07") {?>selected<? }?>>2007</option>
      <option value="08" <? if (substr($client->getCCExpDate(),2,2) == "08") {?>selected<? }?>>2008</option>
      <option value="09" <? if (substr($client->getCCExpDate(),2,2) == "09") {?>selected<? }?>>2009</option>
      <option value="10" <? if (substr($client->getCCExpDate(),2,2) == "10") {?>selected<? }?>>2010</option>
      <option value="11" <? if (substr($client->getCCExpDate(),2,2) == "11") {?>selected<? }?>>2011</option>
      <option value="12" <? if (substr($client->getCCExpDate(),2,2) == "12") {?>selected<? }?>>2012</option>
      <option value="13" <? if (substr($client->getCCExpDate(),2,2) == "13") {?>selected<? }?>>2013</option>
    </select>		
		<!p Credit Card Ver Code:> 
    <input type="hidden" name="cc_ver_code" size="3" maxlength="3" value="<?=$client->getCCVerCode()?>">
    <!/p>
		</font></p>
			
	<div align="center">
    <input type="submit" name="Submit" value="Create Order" onClick="validateForm(this.form);">
    <input type="reset" name="Submit2" value="Reset">
  </div>
</form>
<? } else {?>
<p align="center"> <font size="-1" face="Verdana, Arial, Helvetica, sans-serif"> 
  </font> <a href="manage_order.php?Action=Add"><img src="../images/new_order.gif" alt="Add New Order" width="80" height="21" border="0"></a> 
<p>&nbsp;

	<table border="0" align="center" cellpadding="8" cellspacing="0">
	
	<tr>
			<? for($i=0;$i<count($field_name);$i++) {?>
			<td width="154" bgcolor="#999999"> <font color="#ffffff" size="-1" face="Verdana, Arial, Helvetica, sans-serif">
				<?=strtoupper(str_replace("_"," ",$field_name[$i]))?>
				</font> </td>
			<? }?>
		</tr>
		<? for($n=0;$rs = mysql_fetch_row($query_result);$n++) {?>		
		<tr>
			<? for($i=0;$i<count($rs);$i++) {?>
				<td align="<? if (stristr(mysql_field_type($query_result,$i),"INT") || stristr(mysql_field_type($query_result,$i),"REAL")) {?>right<? } else {?>left<? }?>" bgcolor="<? if (($n%2) != 0) {?>#eeeeee<? } else {?>#FFFFFF<? }?>">
	<font size="-1" face="Verdana, Arial, Helvetica, sans-serif">
					<? if ($field_name[$i] == "order_status" && $rs[$i] == "pending") {?>
						<select name="<?=$field_name[$i]?>" onChange="changeOrderStatus(this.value,'<?=$rs[0]?>');">
							<option value="pending" <? if($rs[$i] == "pending") {?>selected<? }?>>pending</option>
							<option value="completed" <? if($rs[$i] == "completed") {?>selected<? }?>>completed</option>
						</select>
					<? } else {?>
						<? if ($i == 0) {?><a href="client_info.php?order_id=<?=$rs[$i]?>"><? }?><?=$rs[$i]?><? if ($i == 0) {?></a><? }?>
					<? }?>
				</font></td>
			<? }?>
			<td width="288"><input name="Delete" type="button" id="Delete" value="Delete" onClick="deletePrice('<?=$rs[0]?>');"></td>
		</tr>
		<? }?>
	</table>
	
	
<p align="center"><a href="manage_order.php?Action=Add"><img src="../images/new_order.gif" alt="Add New Order" width="80" height="21" border="0"></a> 
</p>

<? }?>
</body>
</html>
