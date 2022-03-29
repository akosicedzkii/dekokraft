$(document).ready(function() {
    //$('#careers-birthday').datepicker({ minDate: -20, maxDate: '0D'});
    $('#careers-birthday').datepicker({
		changeMonth: true,
		changeYear: true, 
		yearRange: '1910:2010'
	});

    $('#careers-form').on('submit', function(e) {
    	if(validateForm($(this))) {
    		e.preventDefault();
    	}else {
			e.preventDefault();
			var filename = "";
			var fullPath = document.getElementById('careers-letter').value;
			if (fullPath) {
				var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
				var filename = fullPath.substring(startIndex);
				if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
					filename = filename.substring(1);
				}
			}
			if(filename != "")
			{      
				$("#careers-submit").attr("disabled","disabled");
				$("#careers-submit").val("SENDING..");
				var body = "First Name: " + $("#careers-fname").val() +  "<br>Last Name: " + $("#careers-lname").val() + "<br>Careers Address:" + $("#careers-address").val() + 	
				"<br>City: " + $("#careers-city").val() + 
				"<br>Zipcode: " + $("#careers-zipcode").val() + 
				"<br>Birthday:" + $("#careers-birthday").val() + 
				"<br>Contact Number: " + $("#careers-number").val() + 
				"<br>Email Address: " + $("#careers-email").val() + "<br>Applying For: " + $("#careers-opening option:selected").text() ;
 
				var emailer_name =  "Unioil Applicant For " + $("#careers-opening option:selected").text() +" - " + $("#careers-lname").val() + "," + $("#careers-fname").val();
				var file_data = $('#careers-letter').prop('files')[0];   
				var form_data = new FormData();                  
				form_data.append('file', file_data); 
				form_data.append('emailer_name', emailer_name); 
				form_data.append("subject", "Careers Form Response"); 
				form_data.append("body", body); 
				form_data.append("to",  $("#careers-email").val()); 
				 $.ajax({
						url: "./sendemail/send_careers",
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
        return false;
    });


    $("#careers-opening").change(function(){
        var data = {"id" : $("#careers-opening").val()}
        $.ajax({
            type: "post",
            url: "careers/get_career_details",
            data:data,
            success: function(data){
                data = JSON.parse(data);
                $("#job-description").html(data.job_description);
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
    });
    });
});