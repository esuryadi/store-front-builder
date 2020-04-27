function setShippingAddress(form) {
	form.ShippingFirstName.value = form.FirstName.value;
	form.ShippingMiddleInitial.value = form.MiddleInitial.value;
	form.ShippingLastName.value = form.LastName.value;
	form.ShippingAddress1.value = form.Address1.value;
	form.ShippingAddress2.value = form.Address2.value;
	form.ShippingCity.value = form.City.value;
	form.ShippingState.value = form.State.value;
	form.ShippingZip.value = form.Zip.value;
	form.ShippingProvince.value = form.Province.value;
	form.ShippingCountry.value = form.Country.value;
}

function setBillingAddress(form) {
	form.BillingFirstName.value = form.FirstName.value;
	form.BillingMiddleInitial.value = form.MiddleInitial.value;
	form.BillingLastName.value = form.LastName.value;
	form.BillingAddress1.value = form.Address1.value;
	form.BillingAddress2.value = form.Address2.value;
	form.BillingCity.value = form.City.value;
	form.BillingState.value = form.State.value;
	form.BillingZip.value = form.Zip.value;
	form.BillingProvince.value = form.Province.value;
	form.BillingCountry.value = form.Country.value;
	form.BillingPhone.value = form.EveningPhone.value;
}

function setPaymentMethod(form,payment_method) {
	if (payment_method != "credit card") {
		form.PaymentType.disabled = true;
		form.AccountNumber.disabled = true;
		form.cc_exp_mm.disabled = true;
		form.cc_exp_yyyy.disabled = true;
		<? if (WebContent::getPropertyValue("ask_cvv") == "yes") {?>
		form.CreditCardVerCode.disabled = true;
		<? }?>
	} else {
		form.PaymentType.disabled = false;
		form.AccountNumber.disabled = false;
		form.cc_exp_mm.disabled = false;
		form.cc_exp_yyyy.disabled = false;
		<? if (WebContent::getPropertyValue("ask_cvv") == "yes") {?>
		form.CreditCardVerCode.disabled = false;
		<? }?>
	}
}

function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	<? if (WebContent::getPropertyValue("ask_cust_info") == "" || WebContent::getPropertyValue("ask_cust_info") == "yes") {?>
	if (form.FirstName.value == "") {
		is_valid = false;
		err_msg = err_msg + "First Name is required\n";
	}
	if (form.LastName.value == "") {
		is_valid = false;
		err_msg = err_msg + "Last Name is required\n";
	}
	if (form.Address1.value == "") {
		is_valid = false;
		err_msg = err_msg + "Address is required\n";
	}
	if (form.City.value == "") {
		is_valid = false;
		err_msg = err_msg + "City is required\n";
	}
	if (form.State.value == "" && form.Province.value == "") {
		is_valid = false;
		err_msg = err_msg + "State/Province is required\n";
	}
	if (form.Zip.value == "") {
		is_valid = false;
		err_msg = err_msg + "Postal Code is required\n";
	}
	if (form.DayPhone.value == "") {
		is_valid = false;
		err_msg = err_msg + "Day Phone is required\n";
	}
	<? if (WebContent::getPropertyValue("ask_email") != "no") {?>
	if (form.Email.value == "") {
		is_valid = false;
		err_msg = err_msg + "Email is required\n";
	}
	<? }?>
	<? }?>
	<? if (WebContent::getPropertyValue("ask_shipping_info") == "" || WebContent::getPropertyValue("ask_shipping_info") == "yes") {?>
	if (form.ShippingFirstName.value == "") {
		is_valid = false;
		err_msg = err_msg + "Shipping First Name is required\n";
	}
	if (form.ShippingLastName.value == "") {
		is_valid = false;
		err_msg = err_msg + "Shipping Last Name is required\n";
	}
	if (form.ShippingAddress1.value == "") {
		is_valid = false;
		err_msg = err_msg + "Shipping Address is required\n";
	}
	if (form.ShippingCity.value == "") {
		is_valid = false;
		err_msg = err_msg + "Shipping City is required\n";
	}
	if (form.ShippingState.value == "" && form.ShippingProvince.value == "") {
		is_valid = false;
		err_msg = err_msg + "Shipping State/Province is required\n";
	}
	if (form.ShippingZip.value == "") {
		is_valid = false;
		err_msg = err_msg + "Shipping Postal Code is required\n";
	}
	<? }?>
	<? if (WebContent::getPropertyValue("ask_billing_info") == "" || WebContent::getPropertyValue("ask_billing_info") == "yes") {?>
	if (form.BillingFirstName.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing First Name is required\n";
	}
	if (form.BillingLastName.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing Last Name is required\n";
	}
	if (form.BillingAddress1.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing Address is required\n";
	}
	if (form.BillingCity.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing City is required\n";
	}
	if (form.BillingState.value == "" && form.BillingProvince.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing State/Province is required\n";
	}
	if (form.BillingZip.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing Postal Code is required\n";
	}
	if (form.BillingPhone.value == "") {
		is_valid = false;
		err_msg = err_msg + "Billing Telephone is required\n";
	}
	<? if ((($payment->getPaymentService(_USER) == "Manual" && WebContent::getPropertyValue("payment_method") == "Credit Card") || $payment->getPaymentService(_USER) == "VeriSign PayFlow Pro") || ($payment->getPaymentService(_USER) == "VeriSign PayFlow Link" && (WebContent::getPropertyValue("verisign_order_form") == "" || WebContent::getPropertyValue("verisign_order_form") == "False"))) {?>
	<? if (WebContent::getPropertyValue("other_payment_type") != "") {?>
	if (form.AccountNumber.value == "" && form.PaymentMethod[0].checked) {
		is_valid = false;
		err_msg = err_msg + "Credit Card number is required\n";
	}
	<? } else {?>
	if (form.AccountNumber.value == "") {
		is_valid = false;
		err_msg = err_msg + "Credit Card number is required\n";
	}
	<? }?>
	<? }?>
	<? }?>
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}

function setAction(form,action) {
	form.Action.value = action;
}

function disableState(form,section) {
	<? if (WebContent::getPropertyValue("ask_state") != "no" && WebContent::getPropertyValue("ask_country") != "no") {?>
	if (section == "customer" && form.Country.value.toLowerCase() == "canada") {
		form.State.disabled = false;
		form.State.value = "";
		form.State.selectedIndex = 53;
	} else if (section == "customer" && form.Country.value.toLowerCase() != "united states") {
		form.State.disabled = true;
		form.State.value = "";
		form.State.selectedIndex = 67;
	} else {
		form.State.disabled = false;
		form.State.value = "";
		form.State.selectedIndex = 0;
	}
	<? }?>
	<? if (WebContent::getPropertyValue("ask_shipping_state") != "no" && WebContent::getPropertyValue("ask_shipping_country") != "no") {?>
	if (section == "shipping" && form.ShippingCountry.value.toLowerCase() == "canada") {
		form.ShippingState.disabled = false;
		form.ShippingState.value = "";
		form.ShippingState.selectedIndex = 53;
	} else if (section == "shipping" && form.ShippingCountry.value.toLowerCase() != "united states") {
		form.ShippingState.disabled = true;
		form.ShippingState.value = "";
		form.ShippingState.selectedIndex = 67;
	} else {
		form.ShippingState.disabled = false;
		form.ShippingState.value = "";
		form.ShippingState.selectedIndex = 0;
	}
	<? }?>
	<? if (WebContent::getPropertyValue("ask_billing_state") != "no" && WebContent::getPropertyValue("ask_billing_country") != "no") {?>
	if (section == "billing" && form.BillingCountry.value.toLowerCase() == "canada") {
		form.BillingState.disabled = false;
		form.BillingState.value = "";
		form.BillingState.selectedIndex = 53;
	} else if (section == "billing" && form.BillingCountry.value.toLowerCase() != "united states") {
		form.BillingState.disabled = true;
		form.BillingState.value = "";
		form.BillingState.selectedIndex = 67;
	} else {
		form.BillingState.disabled = false;
		form.BillingState.value = "";
		form.BillingState.disabled = 0;
	}
	<? }?>
}