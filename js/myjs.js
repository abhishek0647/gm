function submitButtonActivator() {
	var emailPattern = /^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})/i;
	var phoneNumberPattern = /^[0-9]{10}$/;

	if(emailPattern.test($('input[name="txtemail"]').val()) && $('input[name="txtpass"]').val() == $('input[name="txtconfirmpass"]').val() && phoneNumberPattern.test($('input[name="txtmobnum"]').val())) {
		$('#register-btn').prop('disabled', false);
	}
	else {
		$('#register-btn').prop('disabled', true);
	}
}

function validateEmail() {
	if($('input[name="txtemail"]').val().length > 0) {
		var pattern = /^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})/i;
    	if(! pattern.test($('input[name="txtemail"]').val())) {
    		$('#email-correct').hide();
    		$("#email-wrong").show();
    	}
    	else {
    		$("#email-wrong").hide();
    		$("#email-correct").show()
    	}
		submitButtonActivator();
	}
}

function validatePassword() {
	if($('input[name="txtconfirmpass"]').val().length > 0 && $('input[name="txtpass"]').val().length > 0) {
		if($('input[name="txtpass"]').val() == $('input[name="txtconfirmpass"]').val()) {
			$('#confirm-password-wrong').hide();
			$('#confirm-password-correct').show();
		}
		else {
			$('#confirm-password-correct').hide();
			$('#confirm-password-wrong').show();
		}
		submitButtonActivator();
	}
}

function validatePhoneNumber() {
	var pattern = /^[0-9]{10}$/;
	if(! pattern.test($('input[name="txtmobnum"]').val())) {
		$('#phone-correct').hide();
		$('#phone-wrong').show();
	}
	else {
		$('#phone-wrong').hide();
		$('#phone-correct').show();
	}
	submitButtonActivator();
}