$(document).ready(function() {

	$('#clear_cart').on('click', function() {

		if(confirm('Are you sure want to delete this row ?')) {

			return true;
		}

		else {

			return false;
		}
	});
	// display cart_holder

	function show_cart() {

		$('#cart_holder').css({
			transform: 'scale(1)',
			transition: 'all 0.4s ease-in-out'
		});
	}

	// check if restaurant cookie deosn't exists

	function restaurant_cookie_existance() {

		var cookie = ("; "+document.cookie).split("; restaurant=").pop(";").split(";").shift();

		if((document.cookie.indexOf('restaurant') != -1) && (window.location.href != cookie)) {

			alert('You can only order from 1 restaurant at a time !\nPlease check your cart !');
			return 'yes';
		}
	}

	// create cookies for restaurant & food

	function create_restaurant_food_cookie(food_id,quantity_val) {

		show_cart();

		var restaurant_id = $('#restaurant_id').html();

		var d = new Date();
		var this_year = d.getFullYear();

		var exp_year = this_year+2;

		document.cookie = 'restaurant=' + window.location.href + ';expires=Thu, 28 Sep '+exp_year+' 12:00:00 UTC; path=/';
		document.cookie = 'food_'+food_id+'=' + quantity_val + ';expires=Thu, 28 Sep '+exp_year+' 12:00:00 UTC; path=/';

	}

	// create cookies for restaurant & food

	// function delete_restaurant_food_cookie() {

	// 	var restaurant_id = $('#restaurant_id').html();
	// 	var food_id = food_id;

	// 	var d = new Date();
	// 	var this_year = d.getFullYear();

	// 	var exp_year = this_year+2;

	// 	document.cookie = 'restaurant=' + restaurant_id + ';expires=Thu, 28 Sep '+exp_year+' 12:00:00 UTC; path=/';
	// 	document.cookie = 'food_id=' + food_id + ';expires=Thu, 28 Sep '+exp_year+' 12:00:00 UTC; path=/';

	// }


	// Increase Item Quantity

	$('.plus').click(function(e) {

		var existance = restaurant_cookie_existance();

		if(existance == 'yes') {
			return false;
		}

		$quantity_val = $(this).next('.quantity').val();

		if($quantity_val == 5) {
			return alert('Exceeded Max Limit !');
		}

		$quantity_val++;

		$(this).next('.quantity').removeClass('btn-outline-success');
		$(this).next('.quantity').addClass('btn-success');

		$(this).next('.quantity').val($quantity_val);

		$(this).next('.quantity').html($quantity_val);

		// cookie section

		var food_id = $(this).next('button').attr('id');

		create_restaurant_food_cookie(food_id,$quantity_val);

	});


	// Add Quantity for 1 time

	$('.quantity').click(function(e) {

		var existance = restaurant_cookie_existance();

		if(existance == 'yes') {
			return false;
		}

		$quantity_val = $(this).val();

		if($quantity_val >= 1) {

			return false;
		}

		$quantity_val++;

		$(this).val($quantity_val);

		$(this).removeClass('btn-outline-success');
		$(this).addClass('btn-success');

		$(this).html($quantity_val);


		// cookie section

		var food_id = $(this).attr('id');

		create_restaurant_food_cookie(food_id,$quantity_val);

	});


	// Decrease Item Quantity


	$('.minus').click(function(e) {

		var existance = restaurant_cookie_existance();

		if(existance == 'yes') {
			return false;
		}

		$quantity_val = $(this).prev('.quantity').val();

		if($quantity_val <= 1) {

			$(this).prev('.quantity').removeClass('btn-success');
			$(this).prev('.quantity').addClass('btn-outline-success');

			$quantity_val = $(this).prev('.quantity').val(0);
			$(this).prev('.quantity').html('Add');


			// cookie section

			var food_id = $(this).prev('button').attr('id');

			document.cookie = 'food_'+food_id+'=;expires=Thu, 28 Sep 1999 12:00:00 UTC; path=/';

			return false;
		}

		$quantity_val--;

		$(this).prev('.quantity').val($quantity_val);

		$(this).prev('.quantity').html($quantity_val);


		// cookie section

		var food_id = $(this).prev('button').attr('id');

		create_restaurant_food_cookie(food_id,$quantity_val);

	});

	// Add smooth scroll

	$('#navbar ul li a').click(function() {

		$('#navbar ul li a').removeClass('text-muted');
		$('#navbar ul li a').removeClass('text-primary');
		$(this).addClass('text-primary');
	});


	// get parameter from the url & add .text-primary


	// For tap

	var link = window.location.href;

	var nav_ids = ['#d_home','#d_restaurent','#d_cart','#d_profile'];
	var url_links = ['home','restaurent','cart','profile'];

	for(var i=0; i < 4; i++) {

		$(nav_ids[i]).removeClass('text-muted');

		if (window.location.href.indexOf(url_links[i]) > -1) {
			$(nav_ids[i]).addClass('text-primary');
		}
	}


	// for desktop

	var link = window.location.href;

	var nav_ids = ['#home','#search_restaurent','#cart','#profile'];
	var url_links = ['home','restaurent','cart','profile'];

	for(var i=0; i < 4; i++) {

		$(nav_ids[i]).removeClass('text-muted');

		if (window.location.href.indexOf(url_links[i]) > -1) {
			$(nav_ids[i]).addClass('text-primary');
		}
	}

    // add .text-primary to the navbar

    $('.list-group-item').click(function() {
    	$('.list-group-item').removeClass('active');
    	$(this).addClass('active');
    });


    // footer & top nav bottom nav handling //


    // change color of the top nav for restaurent page

    if(window.location.href.indexOf('/restaurent') > -1) {
    	$('nav.navbar').css('background','rgba(0,0,0,0.8)');
    }


    // hide/show footer & navbar in mobile view

    if($(window).width() < 514) {
    	$('footer').hide();
    	$('#navbar').show();
    	$('nav').hide();
    	$('#cart_holder').hide();
    }

    else {
    	$('#navbar').hide(); 
    	$('nav').show(); 
    	$('#cart_holder').show();  	
    }

    $(window).resize(function resize() {

    	if($(window).width() < 514) {
    		$('footer').hide();
    		$('#navbar').show();
    		$('nav').hide();
    		$('#cart_holder').hide();
    	}
    	
    	else {

    		$('footer').show();
    		$('#navbar').hide();
    		$('nav').show();
    		$('#cart_holder').show();

    	}
    });

});