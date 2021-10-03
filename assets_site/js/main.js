var toggleContactTab = function($activePage) {
	if($(window).scrollTop() + window.innerHeight >= document.body.scrollHeight  || $(window).scrollTop() >= $('#contact-us').offset().top) {
		$('.nav-item.active').removeClass('active');
		$('#contact-link').addClass('active');
	}
	else {
		if($('.nav-item:last-child').hasClass('active')) {
			$('#contact-link').removeClass('active');
			$activePage.addClass('active');
		}
	}
}

$(document).ready(function() {
	var $activePage = $('.nav-item.active');

    $('#contact-form').on('submit', function(e) {
		
        if (validateForm($(this))) {
            e.preventDefault();
        }
		else
		{
			e.preventDefault();
			var values_contact_us_email = { "emailer_name" : "Unioil Contact Us - " + $("#contact-name").val() ,  "to": $("#contact-email").val() , "body" : "Name:" + $("#contact-name").val() + " <br> Contact Number: " + $("#contact-mobile").val() + " <br> Contact Email: " + $("#contact-email").val() + " <br> Message: "+ $("#contact-message").val() }

			$("#contact-submit").attr("disabled","disabled");
			$("#contact-submit").val("SENDING..");
			 $.ajax({
					url: "./sendemail/send_contact_us",
					type: "post",
					data: values_contact_us_email ,
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
    });

    $('.nav-item.dropdown').on('mouseleave', function(e) {
        if (window.innerWidth >= 768 && $(this).hasClass('show')) {
            $(this).removeClass('show');
        }
    });

    $(window).scroll(function() {
    	toggleContactTab($activePage);
    });

    $(document).ready(function() {
        $("a.nav-link.scroll-link").on('click', function(e) {
            if (this.hash !== "" && $(hash)) {
                e.preventDefault();
                var hash = this.hash;

                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function() {
                    (hash === '#home') ? window.location.hash = '' : window.location.hash = hash;
                });
            }
        });
    });
});