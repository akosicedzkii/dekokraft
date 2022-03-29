var runSlideshow = function($slideshow) {
	var currentSlide = 1;
	var slideshowInterval = setInterval(function() {
		$slideshow.find('.slideshow-bg:nth-child(' + currentSlide + ')').removeClass('active');
		if(currentSlide === $slideshow.find('.slideshow-bg').length) {
			currentSlide = 1;
		}
		else {
			currentSlide++;
		}
		$slideshow.find('.slideshow-bg:nth-child(' + currentSlide + ')').addClass('active');
	}, 4000);		
}

var toggleLoyaltyTab = function($activePage) {
	if($(window).scrollTop() + 100 >= $('#loyalty').offset().top) {
		$('.nav-item.active').removeClass('active');
		$('#loyalty-link').addClass('active');
	}
	else {
		$activePage.addClass('active');
		$('#loyalty-link').removeClass('active');
	}
}

var toggleLoyaltyOnReady = function($activePage) {
	if(window.location.hash === '#loyalty') {
		toggleLoyaltyTab($activePage);
	}
}

$(document).ready(function() {
	var $activePage = $('.nav-item.active');

	toggleLoyaltyOnReady($activePage);

	$(document).scroll(function() {
    	toggleLoyaltyTab($activePage);
	});

	$('.card-btn').on('mouseenter', function(e) {
		if(window.innerWidth < 768) {
			return;
		}
		e.stopPropagation();
		$(this).addClass('active');
	});

	$('.card-btn').on('mouseleave', function(e) {
		if(window.innerWidth < 768) {
			return;
		}
		e.stopPropagation();
		$(this).removeClass('active');
	});

	$('.card-btn').on('click', function(e) {
		if(window.innerWidth < 768) {
			return;
		}
		e.stopPropagation();
		window.location.href = $(this).data('url');
	});
	
	 if(window.location.href.indexOf('#login_modal') != -1) {
		$('#login_modal').modal('show');
	  }
	runSlideshow($('#main-slideshow'));
	
});