function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.UserId.value == "") {
		is_valid = false;
		err_msg = err_msg + "User Id cannot be empty\n";
	}
	if (form.Password.value == "") {
		is_valid = false;
		err_msg = err_msg + "Password cannot be empty\n";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
