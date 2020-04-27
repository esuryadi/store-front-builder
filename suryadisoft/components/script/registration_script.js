function validateForm(form) {
	var is_valid = true;
	var err_msg = "";
	
	if (form.FirstName.value == "") {
		is_valid = false;
		err_msg = err_msg + "First Name cannot be empty\n";
	}
	if (form.LastName.value == "") {
		is_valid = false;
		err_msg = err_msg + "Last Name cannot be empty\n";
	}
	if (form.Email.value == "") {
		is_valid = false;
		err_msg = err_msg + "Email cannot be empty\n";
	}
	if (form.UserId.value == "") {
		is_valid = false;
		err_msg = err_msg + "User Id cannot be empty\n";
	}
	if (form.Password.value == "") {
		is_valid = false;
		err_msg = err_msg + "Password cannot be empty\n";
	}
	if (form.Password.value != form.Password2.value) {
		is_valid = false;
		err_msg = err_msg + "Your Re-Enter Password doesn't match with your password\n";
		form.Password.value = "";
		form.Password2.value = "";
	}
	
	if (!is_valid)
		alert(err_msg);
		
	event.returnValue = is_valid;
}
