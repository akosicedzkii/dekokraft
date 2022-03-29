var userInput = {
	storeArea: '',
	storeBranch: ''
};

var $beforeList = [];

var convertToKey = function(input) {
	return input.replace(/[^a-zA-Z0-9]*/g, '').toLowerCase();
};

var convertToRegex = function(input) {
	var regexString, ctr;
	for(ctr = 0; ctr < input.length; ctr++) {
		if(ctr === 0) {
			regexString = input.charAt(ctr);
			continue;
		}
		regexString = regexString + '[^' + input.charAt(ctr) + ']*' + input.charAt(ctr);
	}
	regexString = regexString + '.*';

	return new RegExp(regexString, 'gi');
};

var checkCurrentViewport = function() {
	if(window.innerWidth < 576) {
		return 'xs';
	}
	else if(window.innerWidth < 768) {
		return 'sm';
	}
	else if(window.innerWidth < 992) {
		return 'md';
	}
	else if(window.innerWidth < 1200) {
		return 'lg';
	}
	else {
		return 'xl';
	}
}

var displaySuggestions = function(mode) {
	var field = $(this).attr('id');
	var $step = (field === 'store-area') ? $('#step-1') : $('#step-2');

	$step.find('.suggestion-list').html('');

	if(mode === 'all') {
		var scope = stores[userInput['storeArea']]['branches'];
		for(key in scope) {
			$step.find('.suggestion-list').append('<div class="suggestion-item">' + scope[key]['name'] + '</div>');
		}
	}
	else {
		var input = convertToKey($(this).val());
		var searchTemplate = convertToRegex(input);
		var scope = (field === 'store-area') ? stores : stores[userInput['storeArea']]['branches'];
		for(key in scope) { 
			if(key.match(searchTemplate)) {
				$step.find('.suggestion-list').append('<div class="suggestion-item">' + scope[key]['name'] + '</div>');
			}
		}
	}
};
var changePriceValue = function($priceContainer) {
	var price, ctr;

	$priceContainer.each(function() {
		price = $(this).data('price').toString();
	
		$(this).html('');
	
		for(ctr = 0; ctr < price.length; ctr++) {
			$(this).append('<div class="price-digit">' + price.charAt(ctr) + '</div>');
		}
	});
};

var displayStoreList = function() {
	var $this = $(this);
	$beforeList.push($this.closest('.step'));
	$this.closest('.step').removeClass('active');
	setTimeout(function() {
		$this.closest('.step').removeClass('display');
		$('#store-list').addClass('display')
	}, 200);
	setTimeout(function() {
		$('#store-list').addClass('active');
	}, 210);
	
	populateStoreList();
};

var populateStoreList = function() {
	var branchCount, hasMultipleColumn, $listAreaGroup, $branchList, $page, itemLimit;
	var viewportSize = checkCurrentViewport();
	var areaCount = 0;
	var pageCount = 1;

	$('#store-list .list-segment').html('');
	$('#store-list .store-pagination').html('');

	$page = $('<div>', {'class': 'row page active', 'data-pnum': pageCount});

	switch(viewportSize) {
		case 'xs':
			itemLimit = 1;
		break;
		case 'sm':
			itemLimit = 4;
		break;
		case 'md':
			itemLimit = 4;
		break;
		default:
			itemLimit = 4;
		break;
	}

	for(area in stores) {
		branchCount = 0;
		$listAreaGroup = null;
		$branchList = null;

		hasMultipleColumn = (branchCount > 20) ? 'multiple-column' : '';
		$branchList = $('<ul>')

		for(branch in stores[area]['branches']) {
			$branchList.append('<li><a class="branch-link" data-area="' + area + '" data-branch="' + branch + '">' + stores[area]['branches'][branch]['name'] + '</a></li>');
			branchCount++;
		}

		if(branchCount > 20) {
			$branchList.addClass('multiple-column');
		}

		$listAreaGroup = $('<div>', {'class': 'col-12 col-sm-4 col-md-3 col-lg-3 col-xl-3 list-area-group', });
		$listAreaGroup.append($('<p>').text(stores[area]['name']));
		$listAreaGroup.append($branchList);
		$page.append($listAreaGroup)
		areaCount++;

		if(areaCount % itemLimit === 0 && areaCount !== Object.keys(stores).length) {
			pageCount++;
			$('#store-list .list-segment').append($page);
			$page = $('<div>', {'class': 'row page', 'data-pnum': pageCount});
		}
	}

	$('#store-list .list-segment').append($page);

	
	if(viewportSize === 'xs') {
		var $simplePagination = $('<div>', {'class': 'simple-pagination', 'data-pnum': 1});
		$simplePagination.append('<a class="spbutton back disabled">Back</a><a class="spbutton next">Next</a>')
		$('#store-list .store-pagination').append($simplePagination);
	}
	else {
		var $numberedPagination = $('<div>', {'class': 'numbered-pagination'});
		for(var i = 1; i <= pageCount; i++) {
			$numberedPagination.append($('<a>', {'data-pnum': i}).html(i));
		}
		$('#store-list .store-pagination').append($numberedPagination)
	}
};

var returnToPrevious = function() {
	var $this = $(this);
	var $toDisplay = $beforeList[$beforeList.length-1];
	var $currentSection = $this.parent();

	if($('#step-3').hasClass('active')) {
		clearResults();
	}

	$currentSection.removeClass('active');
	setTimeout(function() {
		$toDisplay.addClass('display');
		$currentSection.removeClass('display');
	}, 200);
	setTimeout(function() {
		$toDisplay.addClass('active');
		$beforeList.pop();
	}, 210);

	clearField($(this));
};

var getAreaInput = function() {
	var area = $('#store-area').val();

	if(isValidArea()) {
		userInput['storeArea'] = convertToKey(area);
		$beforeList.push($('#step-1'));
		$('#step-1').removeClass('active');
		setTimeout(function() {
			$('#step-2').addClass('display');
			$('#step-1').removeClass('display');
		}, 200);
		setTimeout(function() {
			$('#step-2').addClass('active');
		}, 210);
		$('#step-2 .selected-area').html(stores[convertToKey(area)]['name']);
	}
};

var isValidArea = function() {
	var area = convertToKey($('#store-area').val());
	var isValid = false;

	if(area !== "") {
		$('#step-1 .error').html('Location not found. Please try again.');
		for(key in stores) {
			if(area === key) {
				$('#step-1 .error').html('');
				isValid = true;
				break;
			}
		}
	}
	else {
		$('#step-1 .error').html('Please enter a location.');
	}

	return isValid;
};

var getBranchInput = function() {
	var branch = $('#store-branch').val();

	if(isValidBranch()) {
		userInput['storeBranch'] = convertToKey(branch);
		$beforeList.push($('#step-2'));
		$('#step-2').removeClass('active');
		setTimeout(function() {
			$('#step-3').addClass('display');
			$('#step-2').removeClass('display');
		}, 200);
		setTimeout(function() {
			$('#step-3').addClass('active');
		}, 210);
		setResults();
	}
};

var isValidBranch = function() {
	var branch = convertToKey($('#store-branch').val());
	var area = userInput['storeArea'];
	var isValid = false;

	if(branch !== "") {
		$('#step-2 .error').html('Location not found. Please try again.');
		for(key in stores[area]['branches']) {
			if(branch === key) {
				$('#step-2 .error').html('');
				isValid = true;
				break;
			}
		}
	}
	else {
		$('#step-2 .error').html('Please enter a location.');
	}

	return isValid;
};

var viewFromStoreList = function($this) {
	userInput['storeArea'] = $this.data('area');
	userInput['storeBranch'] = $this.data('branch');

	$beforeList.push($('#store-list'));

	$('#store-list').removeClass('active');
	setTimeout(function() {
		$('#step-3').addClass('display');
		$('#store-list').removeClass('display');
	}, 200);
	setTimeout(function() {
		$('#step-3').addClass('active');
	}, 210);
	setResults();
};

var setResults = function() {
	var area = userInput['storeArea'];
	var branch = userInput['storeBranch'];
	$('#step-3 .selected-area').html(stores[area]['name']);
	$('#step-3 .selected-branch').html(stores[area]['branches'][branch]['name']);
	$('#step-3 .selected-contact>.contact-num').html(stores[area]['branches'][branch]['contact']);
	$('#step-3 .branch-map').attr('src', stores[area]['branches'][branch]['map-url']);
	var data = { "station_name" : stores[area]['branches'][branch]['name'] , "branch_name" : stores[area]['name'] };
	$("#tbl-price").html("");
	$.ajax({
		data: data,
		type: "post",
		url: "./home/get_gas_price",
		success: function(data){
			$("#tbl-price").html(data);
		},
		error: function (request, status, error) {
			alert(request.responseText);
		}
	});
	changePriceValue($('.price-container'));
};

var clearResults = function() {
	$('#step-3 .selected-area').html('');
	$('#step-3 .selected-branch').html('');
	$('#step-3 .branch-map').attr('src', '');
};

var clearField = function($this) {
	if($this.closest('.step').attr('id') === 'step-2') {
		$('#store-branch').val('');
		$('#step-2 .suggestion-list').html('');
	}
	else if($this.closest('.step').attr('id') === 'step-1') {
		$('#store-area').val('');
		$('#step-1 .suggestion-list').html('');
	}
};

$(document).ready(function() {
	$(window).resize(function() {
		if($('#store-list').hasClass('active')) {
			populateStoreList();
		}
	});

	$('#step-1 .next-btn').on('click', getAreaInput);

	$('#step-2 .next-btn').on('click', getBranchInput);

	$('#store-area, #store-branch').on('focus blur', function() {
		$(this).closest('.input-wrapper').find('.suggestion-wrapper').slideToggle(300);
	});

	$('.suggestion-list').on('mousedown', '.suggestion-item', function() {
		$(this).closest('.input-wrapper').find('input').val($(this).html());
	});

	$('#store-area').on('keyup focus', displaySuggestions);

	$('#store-branch').on('click', function() {
		displaySuggestions('all')
	});

	$('.locator-back').on('click', returnToPrevious);

	// $('#store-list .locator-back').on('click', function(e) {
	// 	returnToPrevious($beforeList);
	// });

	$('.store-list-btn').on('mousedown', displayStoreList);

	$('#store-list').on('click', '.store-pagination .numbered-pagination a', function(e) {
		$('#store-list .page.active').removeClass('active');
		$('#store-list .page[data-pnum="' + $(this).data('pnum') + '"]').addClass('active');
		$(this).addClass('active');
	});

	$('#store-list').on('click', '.branch-link', function(e) {
		e.preventDefault();
		viewFromStoreList($(this));
	});

	$('#store-list').on('click', '.simple-pagination a:not(.disabled)', function(e) {
		var newActive;

		if($(this).hasClass('next')) {
			newActive = $('#store-list .simple-pagination').data('pnum') + 1;
		}
		
		else if(($(this).hasClass('back'))) {
			newActive = $('#store-list .simple-pagination').data('pnum') - 1;
		}

		$('#store-list .simple-pagination').data('pnum', newActive);
		$('#store-list .page.active').removeClass('active');
		$('#store-list .page[data-pnum="' + newActive + '"]').addClass('active');

		if($('#store-list .simple-pagination').data('pnum') === 1) {
			$('#store-list .spbutton.back').addClass('disabled')
		}
		else if($('#store-list .simple-pagination').data('pnum') === $('#store-list .page').length) {
			$('#store-list .spbutton.next').addClass('disabled')
		}
		else {
			$('#store-list .spbutton.next, #store-list .spbutton.back').removeClass('disabled');
		}
	});
});