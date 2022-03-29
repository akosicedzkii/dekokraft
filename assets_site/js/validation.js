var validateForm = function($form) {
	var $fields = $form.find('input:not([type="submit"]), select, textarea');
	var errorFlag = false;

	$fields.each(function() {
		switch($(this).data('fieldtype')) {
			case 'text':
				if(!$(this).val() || $(this).val() === '') {
					$(this).siblings('.error-msg').html('This field is required.');
					errorFlag = true;
				}
				else {
					$(this).siblings('.error-msg').html('');
				}
			break;
			case 'number':
				if(!$(this).val()) {
					$(this).siblings('.error-msg').html('This field is required.');
					errorFlag = true;
				}
				else if($(this).val().match(/^\d+$/) === null) {
					$(this).siblings('.error-msg').html('Field should only consist of numbers.');
					errorFlag = true;
				}
				else {
					$(this).siblings('.error-msg').html('');
				}
			break;
			case 'date': 
				if(!$(this).val()) {
					$(this).siblings('.error-msg').html('This field is required.');
					errorFlag = true;
				}
				else {
					$(this).siblings('.error-msg').html('');
				}
			break;
			case 'file': 
				if($(this).val() === '') {
					$(this).siblings('.error-msg').html('Please upload a file.');
					errorFlag = true;
				}
				else {
					$(this).siblings('.error-msg').html('');
				}
			break;
			case 'email':
				if(!$(this).val()) {
					$(this).siblings('.error-msg').html('This field is required.');
					errorFlag = true;
				}
				else if($(this).val().match(/.+@.+\..+/) === null) {
					$(this).siblings('.error-msg').html('You have entered an invalid email.');
					errorFlag = true;
				}
				else {
					$(this).siblings('.error-msg').html('');
				}
			break;
			case 'select':
				if(!$(this).val()) {
					$(this).siblings('.error-msg').html('This field is required.');
					errorFlag = true;
				}
				else {
					$(this).siblings('.error-msg').html('');
				}
			break;
		}
	});

	return errorFlag;
}