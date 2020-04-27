<?php
switch($position) {
	case "top": $id = $top_content->getID($n);
							break;
	case "left": $id = $left_content->getID($n);
							 break;
	case "center": $id = $middle_content->getID($n);
								 break;
	case "right": $id = $right_content->getID($n);
								break;
	case "bottom": $id = $bottom_content->getID($n);
								 break;
}
$name = "contact_form" . $id . "_";
$component_properties = WebContent::getComponentProperties("Contact Form");
$prop = Array();
for ($z=0;$z<count($component_properties);$z++) {
	$property = $component_properties[$z];
	$prop[$property["name"]] = $property["default_value"];
}
$title = (WebContent::getPropertyValue($name . "title") != "")?WebContent::getPropertyValue($name . "title"):$prop["title"];
$ask_name = (WebContent::getPropertyValue($name . "ask_name") != "")?WebContent::getPropertyValue($name . "ask_name"):$prop["ask_name"];
$ask_address = (WebContent::getPropertyValue($name . "ask_address") != "")?WebContent::getPropertyValue($name . "ask_address"):$prop["ask_address"];
$ask_phone = (WebContent::getPropertyValue($name . "ask_phone") != "")?WebContent::getPropertyValue($name . "ask_phone"):$prop["ask_phone"];
$ask_email = (WebContent::getPropertyValue($name . "ask_email") != "")?WebContent::getPropertyValue($name . "ask_email"):$prop["ask_email"];
$ask_questions = (WebContent::getPropertyValue($name . "ask_questions") != "")?WebContent::getPropertyValue($name . "ask_questions"):$prop["ask_questions"];
$subject = (WebContent::getPropertyValue($name . "mail_subject") != "")?WebContent::getPropertyValue($name . "mail_subject"):$prop["mail_subject"];
$message = (WebContent::getPropertyValue($name . "thank_message") != "")?WebContent::getPropertyValue($name . "thank_message"):$prop["thank_message"];
$to = $adminuser->getCompanyEmail();

if (isset($Action) && $Action == "ProcessContactForm") {
	$mail_subject = $subject;	
	$name = ($ask_name)?"Name: $first_name $last_name\n":"";	
	if ($ask_address) { 
		$address = "Address: " . $address . "\n" .
		           "         $city, $state $zip" . "\n";
	} else {
		$address = "";
	}			
	$phone = ($ask_phone)?"Phone: $phone\n":"";	
	$email = ($ask_email)?"Email: $email\n":"";
	$questions = ($ask_questions)?"Questions: $questions\n":"";	
	$mail_body = $name . $address . $phone . $email . $questions; 
	mail($to,$mail_subject,$mail_body);
?> 
	<h2><?=$message?></h2>
<? } else {
	$state = $adminuser->getState("United States");
	?>
	<div align="center">
		<p><strong><font size="+2"><?=$title?></font></strong></p>
		<form action="mystore.php" method="post" name="contact_form" id="contact_form">
			<input type="hidden" name="Action" value="ProcessContactForm">
			<input type="hidden" name="Page" value="<?=$Page?>">
			<? if (isset($Category)) {?>
			<input type="hidden" name="Category" value="<?=$Category?>">
			<? }?>
			<? if (isset($Link)) {?>
			<input type="hidden" name="Link" value="<?=$Link?>">
			<? }?>
			<div align="left">
				<table width="0%" border="0" cellspacing="0" cellpadding="5">
					<? if ($ask_name == "true") {?>
					<tr> 
						<td><strong>First Name:</strong></td>
						<td><input name="first_name" type="text" id="first_name">
							<strong> Last Name:</strong> 
							<input name="last_name" type="text" id="last_name"></td>
					</tr>
					<? }?>
					<? if ($ask_address == "true") {?>
					<tr> 
						<td><strong>Address:</strong></td>
						<td><input name="address" type="text" id="address" size="60"></td>
					</tr>
					<tr> 
						<td>&nbsp;</td>
						<td><strong>City</strong>: 
							<input name="city" type="text" id="city">
							<strong>State:</strong> 
							<select name="state" id="state">
							<option value="">- Select State -</option>
							<? for ($i=0;$i<count($state);$i++) {
							$name = $state[$i]?>
							<option value="<?=$name["short"]?>"><?=$name["short"]?> - <?=$name["long"]?></option>
							<? }?>
							</select>
							<strong>Zip:</strong> 
							<input name="zip" type="text" id="zip" size="5"></td>
					</tr>
					<? }?>
					<? if ($ask_phone == "true") {?>
					<tr> 
						<td><strong>Telephone:</strong></td>
						<td><input name="phone" type="text" id="phone" size="12" maxlength="12">
							<font size="-1"><em>(e.g. 925-732-8327)</em></font></td>
					</tr>
					<? }?>
					<? if ($ask_email == "true") {?>
					<tr> 
						<td><strong>Email:</strong></td>
						<td><input name="email" type="text" id="email" size="40">
							<font size="-1"><em>(e.g. john@hotmail.com)</em></font></td>
					</tr>
					<? }?>
					<? if ($ask_questions == "true") {?>
					<tr> 
						<td valign="top"><strong>Questions:</strong></td>
						<td><textarea name="questions" cols="50" rows="10" id="questions"></textarea></td>
					</tr>
					<? }?>
				</table>  <p align="center"> 
					<input type="submit" name="Submit" value="Submit" onClick="validateContactForm(this.form);">
					<input type="reset" name="Submit2" value="Reset">
				</p>
			</div>
		</form>
		<p align="left">&nbsp;</p>
	</div>
	<script language="JavaScript">
	<!--
	function validateContactForm(form) {
		var is_valid = true;
		var err_msg = "";
		
		<? if ($ask_name == "true") {?>
		if (form.first_name.value == "") {
			is_valid = false;
			err_msg = err_msg + "First Name is required\n";
		}
		if (form.last_name.value == "") {
			is_valid = false;
			err_msg = err_msg + "Last Name is required\n";
		}
		<? }?>
		<? if ($ask_address == "true") {?>
		if (form.address.value == "") {
			is_valid = false;
			err_msg = err_msg + "Address is required\n";
		}
		if (form.city.value == "") {
			is_valid = false;
			err_msg = err_msg + "City is required\n";
		}
		if (form.state.value == "") {
			is_valid = false;
			err_msg = err_msg + "State is required\n";
		}		
		if (form.zip.value == "") {
			is_valid = false;
			err_msg = err_msg + "Zip is required\n";
		}
		<? }?>
		<? if ($ask_email == "true") {?>
		if (form.email.value == "") {
			is_valid = false;
			err_msg = err_msg + "Email is required\n";
		}
		if (form.email.value.search("@") < 0 || form.email.value.indexOf(".",(form.email.value.length-4)) < 0) {
			is_valid = false;
			err_msg = err_msg + "Invalid Email Address. Email should be like john@aol.com\n";
		}
		<? }?>
		<? if ($ask_phone == "true") {?>
		if (form.phone.value == "") {
			is_valid = false;
			err_msg = err_msg + "Phone is required\n";
		}
		if (form.phone.value.length < 12) {
			is_valid = false;
			err_msg = err_msg + "Invalid Phone Number. Phone should be like 925-251-0601\n";
		}
		<? }?>
		<? if ($ask_questions == "true") {?>
		if (form.questions.value == "") {
			is_valid = false;
			err_msg = err_msg + "Questions is required\n";
		}	
		<? }?>		
		if (!is_valid)
			alert(err_msg);
			
		event.returnValue = is_valid;
	}
	//-->
	</script>
<? }?>
