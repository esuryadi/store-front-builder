<?php
if (isset($Action) && $Action == "ProcessAffiliateForm") {
	$affiliate = new Affiliate();
	if (!$affiliate->isAffiliateExists($affl_id)) {
		$affiliate->setId($affl_id);
		$affiliate->setName($affiliate_name);
		$affiliate->setAddress($affiliate_address);
		$affiliate->setCity($affiliate_city);
		$affiliate->setState(($affiliate_state == "")?$affiliate_province:$affiliate_state);
		$affiliate->setZip($affiliate_zip);
		$affiliate->setCountry($affiliate_country);
		$affiliate->setPhone($affiliate_phone);
		$affiliate->setEmail($affiliate_email);
		$affiliate->setURL($affiliate_url);
		$affiliate->addNewAffiliate();
		$affiliate->mailAffiliate();
		$company_name = $adminuser->getCompanyName();
		$company_url = $adminuser->getCompanyURL();
		$logo_img_src = WebContent::getPropertyValue("logo_img_src");
		$message = "<h2>Thank You for becoming our affiliate.<p></h2>";
		$message = $message . "Please add the following HTML code snippet to your website:";
		$message = $message . "<blockquote>";
		$message = $message . "&lt;!-- " . $company_name . " logo --&gt;<br>";
		$message = $message . "&lt;a href=&quot;http://$company_url/mystore.php?affiliate_id=$affl_id&quot;&gt;&lt;img 
src=&quot;http://$company_url/" . str_replace(" ","%20",$logo_img_src) . "&quot;&gt;&lt;/a&gt;<br>";
		$message = $message . "&lt;!-- End of logo --&gt;";
		$message = $message . "</blockquote>";
		$message = $message . "You will receive an affiliate commission from us for every click that results a purchase in our website.<p>";
		$message = $message . "Thank You,<p>";
		$message = $message . $company_name;
	} else {
		$message = "<h2>" .$affl_id . " has been taken, please choose different affiliate id.</h2>";
		$message = $message . "<center>[<a href=\"mystore.php?Page=$Page&Category=$Category\">Back</a>]</center>";
	}
?> 
	<?=$message?>
<? } else if (isset($Action) && $Action == "AffiliateSignIn") {
	$affiliate = new Affiliate();?>
	<? if ($affiliate->isAffiliateExists($affl_id)) {
		$affiliate->getAffiliateInfo($affl_id);?>
	<table align="center" cellpadding="5" cellspacing="0" border="1">
	<tr>
		<td align="right">Your website address:</td>
		<td><a href="<?=$affiliate->getURL()?>" target="_blank"><?=$affiliate->getURL()?></a></td>
	</tr>
	<tr>
		<td align="right">Total hits coming from your website:</td>
		<td align="right"><?=$affiliate->getHits()?></td>
	</tr>
	<tr>
		<td align="right">Total hits that results purchases:</td>
		<td align="right"><?=$affiliate->getPurchase()?></td>
	</tr>
	<tr>
		<td align="right">Your total commission:</td>
		<td align="right">$ <? printf("%01.2f",$affiliate->getTotalCommission());?></td>
	</tr>
	<tr>
		<td align="right">Total commission that has been paid to you:</td>
		<td align="right">$ <? printf("%01.2f",$affiliate->getPaidCommission());?></td>
	</tr>
	<tr>
		<td align="right">Current commission due:</td>
		<td align="right">$ <? printf("%01.2f",($affiliate->getTotalCommission() - $affiliate->getPaidCommission()));?></td>
	</tr>
	</table>
	<? } else {?>
	<h2><?=$affl_id?> does not exists.</h2>
	<center>[<a href="mystore.php?Page=<?=$Page?>&Category=<?=$Category?>">Back</a>]</center>
	<? }?>
<? } else {
	$state = $adminuser->getState("United States");
	?>
	<div align="center">
		<p><strong><font size="+2">Affiliate Registration</font></strong></p>
  <form action="mystore.php" method="post" name="affiliate_registration_form" id="affiliate_registration_form">
			<input type="hidden" name="Action" value="ProcessAffiliateForm">
			<input type="hidden" name="Page" value="<?=$Page?>">
			<? if (isset($Category)) {?>
			<input type="hidden" name="Category" value="<?=$Category?>">
			<? }?>
			<? if (isset($Link)) {?>
			<input type="hidden" name="Link" value="<?=$Link?>">
			<? }?>
			<div align="left">
				
      <table width="0%" border="0" cellspacing="0" cellpadding="5">
        <tr> 
          <td><strong>Name:</strong></td>
          <td><input name="affiliate_name" type="text" id="name" size="30"> <strong> </strong></td>
        </tr>
        <tr> 
          <td><strong>Address:</strong></td>
          <td><input name="affiliate_address" type="text" id="address2" size="75"></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td><strong>City</strong>: 
            <input name="affiliate_city" type="text" id="city"> <strong>State:</strong> 
            <select name="affiliate_state" id="state">
              <option value="">- Select State -</option>
              <? for ($i=0;$i<count($state);$i++) {
							$name = $state[$i]?>
              <option value="<?=$name["short"]?>"> 
              <?=$name["short"]?>
              - 
              <?=$name["long"]?>
              </option>
              <? }?>
            </select> <strong>Zip:</strong> <input name="affiliate_zip" type="text" id="zip" size="5"></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td><strong>Province: 
            <input name="affiliate_province" type="text" id="province" size="15">
            </strong><font size="-2">(if not within U.S)</font><strong> Country:</strong> 
            <input name="affiliate_country" type="text" id="country" value="United States" size="15"></td>
        </tr>
        <tr> 
          <td><strong>Telephone:</strong></td>
          <td><input name="affiliate_phone" type="text" id="phone" size="12" maxlength="12"> 
            <font size="-1"><em>(e.g. 925-732-8327)</em></font></td>
        </tr>
        <tr> 
          <td><strong>Email:</strong></td>
          <td><input name="affiliate_email" type="text" id="email" size="40"> <font size="-1"><em>(e.g. 
            john@hotmail.com)</em></font></td>
        </tr>
        <tr>
          <td><strong>Web Address:</strong></td>
          <td><input name="affiliate_url" type="text" id="url" size="75"></td>
        </tr>
        <tr> 
          <td colspan="2" valign="top"><strong>Please enter your affiliate id: 
            <input name="affl_id" type="text" id="id">
            </strong></td>
        </tr>
      </table>
      <p align="center"> 
					<input type="submit" name="Submit" value="Submit" onClick="validateAffiliateForm(this.form);">
					<input type="reset" name="Submit2" value="Reset">
				</p>
			</div>
		</form>
		<form name="affiliate_sign_in_form" method="post" action="mystore.php">
    <input type="hidden" name="Action" value="AffiliateSignIn">
		<input type="hidden" name="Page" value="<?=$Page?>">
		<? if (isset($Category)) {?>
		<input type="hidden" name="Category" value="<?=$Category?>">
		<? }?>
		<? if (isset($Link)) {?>
		<input type="hidden" name="Link" value="<?=$Link?>">
		<? }?>
		<table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="<? if (WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background") != "") {?><?=WebContent::getPropertyValue(WebContent::getPropertyValue("selected_theme") . "_table_header_background")?><? } else {?><?=$theme->getDefaultProperty("classic","Table Header Background")?><? }?>">
      <tr>
        <td><strong>Are you a registered affiliate? Please enter your affiliate 
          id</strong>: 
          <input name="affl_id" type="text" id="affl_id">
          <input name="signInButton" type="submit" id="signInButton" value="Sign In"></td>
      </tr>
    </table>
  </form>
	</div>
	<script language="JavaScript">
	<!--
	function validateAffiliateForm(form) {
		var is_valid = true;
		var err_msg = "";
		
		if (form.affiliate_name.value == "") {
			is_valid = false;
			err_msg = err_msg + "Name is required\n";
		}
		if (form.affiliate_address.value == "") {
			is_valid = false;
			err_msg = err_msg + "Address is required\n";
		}
		if (form.affiliate_city.value == "") {
			is_valid = false;
			err_msg = err_msg + "City is required\n";
		}
		if (form.affiliate_state.value == "" && form.province.value == "") {
			is_valid = false;
			err_msg = err_msg + "State/Province is required\n";
		}		
		if (form.affiliate_zip.value == "") {
			is_valid = false;
			err_msg = err_msg + "Zip is required\n";
		}
		if (form.affiliate_email.value == "") {
			is_valid = false;
			err_msg = err_msg + "Email is required\n";
		}
		if (form.affiliate_email.value.search("@") < 0 || form.affiliate_email.value.indexOf(".",(form.affiliate_email.value.length-4)) < 0) {
			is_valid = false;
			err_msg = err_msg + "Invalid Email Address. Email should be like john@aol.com\n";
		}
		if (form.affiliate_phone.value == "") {
			is_valid = false;
			err_msg = err_msg + "Phone is required\n";
		}
		if (form.affiliate_phone.value.length < 12) {
			is_valid = false;
			err_msg = err_msg + "Invalid Phone Number. Phone should be like 925-251-0601\n";
		}
		if (form.affl_id.value == "") {
			is_valid = false;
			err_msg = err_msg + "Affiliate ID is required\n";
		}
		if (form.affiliate_url.value == "") {
			is_valid = false;
			err_msg = err_msg + "Web Address is required\n";
		}

		if (!is_valid)
			alert(err_msg);
			
		event.returnValue = is_valid;
	}
	//-->
	</script>
<? }?>
