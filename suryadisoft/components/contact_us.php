<?php
$title = "Contact Us";
$subject = "Questions";
$message = "Thank You for contacting us";
$to = $adminuser->getCompanyEmail();

if (isset($Action) && $Action == "ProcessContactForm") {
	$mail_subject = $subject;	
	$name = "Name: $first_name $last_name\n";	
	$address = "Address: " . $address . "\n" .
		         "         $city, $state $zip" . "\n";		
	$phone = "Phone: $phone\n";	
	$email = "Email: $email\n";
	$questions = "Questions: $questions\n";	
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
					<tr> 
						<td><strong>First Name:</strong></td>
						<td><input name="first_name" type="text" id="first_name">
							<strong> Last Name:</strong> 
							<input name="last_name" type="text" id="last_name"></td>
					</tr>
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
					<tr> 
						<td><strong>Telephone:</strong></td>
						<td><input name="phone" type="text" id="phone" size="12" maxlength="12">
							<font size="-1"><em>(e.g. 925-732-8327)</em></font></td>
					</tr>
					<tr> 
						<td><strong>Email:</strong></td>
						<td><input name="email" type="text" id="email" size="40">
							<font size="-1"><em>(e.g. john@hotmail.com)</em></font></td>
					</tr>
					<tr> 
						<td valign="top"><strong>Questions:</strong></td>
						<td><textarea name="questions" cols="50" rows="10" id="questions"></textarea></td>
					</tr>
				</table>  <p align="center"> 
					<input type="submit" name="Submit" value="Submit" onClick="validateForm(this.form);">
					<input type="reset" name="Submit2" value="Reset">
				</p>
			</div>
		</form>
		<p align="left">&nbsp;</p>
	</div>
	<script language="JavaScript">
	<!--
	function validateForm(form) {
		var is_valid = true;
		var err_msg = "";
		
		if (form.first_name.value == "") {
			is_valid = false;
			err_msg = err_msg + "First Name is required\n";
		}
		if (form.last_name.value == "") {
			is_valid = false;
			err_msg = err_msg + "Last Name is required\n";
		}
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
		if (form.email.value == "") {
			is_valid = false;
			err_msg = err_msg + "Email is required\n";
		}
		if (form.email.value.search("@") < 0 || form.email.value.indexOf(".",(form.email.value.length-4)) < 0) {
			is_valid = false;
			err_msg = err_msg + "Invalid Email Address. Email should be like john@aol.com\n";
		}
		if (form.phone.value == "") {
			is_valid = false;
			err_msg = err_msg + "Phone is required\n";
		}
		if (form.phone.value.length < 12) {
			is_valid = false;
			err_msg = err_msg + "Invalid Phone Number. Phone should be like 925-251-0601\n";
		}
		if (form.questions.value == "") {
			is_valid = false;
			err_msg = err_msg + "Questions is required\n";
		}	
		if (!is_valid)
			alert(err_msg);
			
		event.returnValue = is_valid;
	}
	//-->
	</script>
<? }?>
