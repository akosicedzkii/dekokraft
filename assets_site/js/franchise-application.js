$(document).ready(function() {
    //$('#franchise-birthday').datepicker({ minDate: -20, maxDate: '0D'});
	$('#franchise-birthday').datepicker({
		changeMonth: true,
		changeYear: true, 
		yearRange: '1910:2010'
	});
    $('#franchise-form').on('submit', function(e) {
    	if(validateForm($(this))) {
    		e.preventDefault();
    	}else {
			e.preventDefault();
			var filename = "";
			var fullPath = document.getElementById('franchise-letter').value;
			if (fullPath) {
				var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
				var filename = fullPath.substring(startIndex);
				if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
					filename = filename.substring(1);
				}
			}
			if(filename != "")
			{   
				$("#franchise-submit").attr("disabled","disabled");
				$("#franchise-submit").val("SENDING..");   
				var body = "First Name: " + $("#franchise-fname").val() +  "<br>Last Name: " + $("#franchise-lname").val() + "<br>Franchise Address:" + $("#franchise-address").val() + 	
				"<br>City: " + $("#franchise-city").val() + 
				"<br>Zipcode: " + $("#franchise-zipcode").val() + 
				"<br>Birthday:" + $("#franchise-birthday").val() + 
				"<br>Contact Number: " + $("#franchise-number").val() + 
				"<br>Email Address: " + $("#franchise-email").val() ;

				var file_data = $('#franchise-letter').prop('files')[0];  
				var emailer_name =  "Unioil Franchise Application - " + $("#franchise-lname").val() + "," + $("#franchise-fname").val(); 
				var form_data = new FormData();                  
				form_data.append('file', file_data); 
				form_data.append('emailer_name', emailer_name); 
				form_data.append("subject", "Franchise Form Response"); 
				form_data.append("body", body); 
				form_data.append("to",  $("#franchise-email").val()); 
				 $.ajax({
						url: "./sendemail/send_franchise",
						type: "post",
						data: form_data ,
						cache: false,
						contentType: false,
						processData: false,
						success: function (response) {
						   if(response == "Message sent")
						   {
							   alert("Message successfully sent");
							   window.location = "";
						   }else{
							alert(response);
							window.location = "";
						   }						   
							   
	
						},
						error: function(jqXHR, textStatus, errorThrown) {
						   console.log(textStatus, errorThrown);
						}
	
	
					});
			}
			
		}
    });
});