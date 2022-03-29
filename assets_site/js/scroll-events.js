var $window = $(window);
var $animatedElement = $('.animate, .pseudo-animate');
console.log('scroll event loaded')

var evaluateAnimation = function($currentElement, elementPosTop, windowPosTop, elementPosBottom, windowPosBottom) {
	if(elementPosTop >= windowPosTop &&  elementPosBottom <= windowPosBottom) {
		$currentElement.removeClass('fade-in from-top from-bottom from-left from-left-offscreen from-right from-right-offscreen from-top-right from-bottom-left rotate-x rotate-y zoom-small');
		if($currentElement.hasClass('zoom')) {
			setTimeout(function() {
				$currentElement.addClass('zoom-regular');
			}, 375);
		}
	}
}

var animate = function() {
	var $animatedElement = $('.animate, .pseudo-animate');
	var windowHeight = $window.height();
	var windowPosTop = $window.scrollTop();
	var windowPosBottom = windowPosTop + windowHeight;
	var delay = 575;
	var prevGroup = ''
	var currentGroup = '';

	$.each($animatedElement, function() {
		var $currentElement = $(this);
		var elementHeight = $currentElement.outerHeight();
		var elementPosTop = $currentElement.offset().top;
		var elementPosBottom = elementPosTop + elementHeight;

		if($currentElement.data('group')) {
			prevGroup = currentGroup;
			currentGroup = $currentElement.data('group');
		}
		else {
			prevGroup = currentGroup;
			currentGroup = '';
		}

		if(currentGroup !== '') {
			if(currentGroup !== prevGroup) {
				evaluateAnimation($currentElement, elementPosTop, windowPosTop, elementPosBottom, windowPosBottom);
			}
			else {
				setTimeout(function(){
					evaluateAnimation($currentElement, elementPosTop, windowPosTop, elementPosBottom, windowPosBottom);
				}, delay);
			}
			if(prevGroup === currentGroup) {
				delay += 575;
			}
			else {
				delay = 575;
			}
		}
		else {
			evaluateAnimation($currentElement, elementPosTop, windowPosTop, elementPosBottom, windowPosBottom);
		}
	});
}

$window.on('scroll', animate);

$(document).ready(function() {
	animate();
});