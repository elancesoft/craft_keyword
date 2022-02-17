jQuery(document).ready(function ($) {
	AOS.init({
		duration: 600, // values from 0 to 3000, with step 50ms
	});


	// Collapse on brand ranking detail page
	$('.table-brandranking-detail-collapse').on('click', function() {
		var tr_index = $(this).data('trindex');

		$('.tr-brandranking-detail-item-details').removeClass('active');
		$('.table-brandranking-detail-collapse').not($(this)).removeClass('active');

		if ($(this).hasClass('active')) {
			$(this).find('.arrow-direction').removeClass('bi-chevron-up').addClass('bi-chevron-down');
			$('#tr-brandranking-detail-item-' + tr_index).removeClass('active');
			$(this).removeClass('active');
		} else {
			$(this).find('.arrow-direction').removeClass('bi-chevron-down').addClass('bi-chevron-up');
			$('#tr-brandranking-detail-item-' + tr_index).toggleClass('active');
			$(this).toggleClass('active');
		}
	});

	// Show tooltip
	$('[data-bs-toggle="tooltip"]').tooltip({ html: true });

	// Home page: Trend List
	$(".trend-list-owl.owl-carousel").owlCarousel({
		loop: false,
		nav: false,
		autoplay: false,
		dots: false,
		margin: 20,
		responsive: {
			0: {
				loop: true,
				items: 1,
				stagePadding: 50,
				margin: 20,
			},
			568: {
				loop: true,
				items: 1,
				margin: 30,
				stagePadding: 50,
			},
			1024: {
				margin: 20,
				items: 3,
				stagePadding: 0,
			},
		}
	});

	// Search suggestion list
	$(".search-suggestion-list.owl-carousel").owlCarousel({
		loop: false,
		nav: false,
		autoplay: false,
		dots: false,
		margin: 20,
		responsive: {
			0: {
				loop: true,
				items: 2,
				stagePadding: 50,
				margin: 20,
			},
			568: {
				loop: true,
				items: 2,
				margin: 30,
				stagePadding: 50,
			},
			1024: {
				margin: 20,
				items: 3,
				stagePadding: 0,
			},
		}
	});

	// Brand Ranking Detail Top 3
	$(".brandranking-detail-top3-slider-mobile.owl-carousel").owlCarousel({
		loop: false,
		nav: false,
		autoplay: false,
		dots: false,
		margin: 20,
		autoWidth: true,
		responsive: {
			0: {
				loop: true,
				items: 2,
				stagePadding: 50,
				margin: 20,
			},
			568: {
				loop: true,
				items: 2,
				margin: 30,
				stagePadding: 50,
			},
			1024: {
				margin: 20,
				items: 3,
				stagePadding: 0,
			},
		}
	});


	// TODAY PICK ACTION
	$('#today-pick-previous, #today-pick-previous-desktop').on('click', function () {
		var $list = $('.today-pick-slider-list'),
			$items = $list.children(),
			$lastItem = $items.last();

		// Set active item
		$items.removeClass('active');
		$items.eq(0).before($lastItem).addClass('active');

		// Get the Post Title of active item
		var post_title = $('.today-pick-slider-item.active').data('title');

		// Change Post Title
		$('#today-pick-post-title').html(post_title);

	});

	$('#today-pick-next, #today-pick-next-desktop').on('click', function () {
		var $list = $('.today-pick-slider-list'),
			$items = $list.children(),
			$firstItem = $items.first();

		// Set active item
		$items.removeClass('active');
		$items.eq(2).after($firstItem).addClass('active');

		// Get the Post Title of active item
		var post_title = $('.today-pick-slider-item.active').data('title');

		// Change Post Title
		$('#today-pick-post-title').html(post_title);
	});


	// SEARCH
	$('.search-icon-close').on('click', function () {
		$("#overlay").fadeOut(300);
		$(this).addClass('d-none');
		$('.search-icon').removeClass('d-none');
	});

	$('.search-icon').on('click', function () {
		// get the current height of the header
		var masthead_height = $('#masthead').outerHeight();

		$("#overlay").fadeIn(300);
		$("#overlay").css('top', masthead_height + 'px');
		$(this).addClass('d-none');
		$('.search-icon-close').removeClass('d-none');
	});

	$('.share-by-copy').on('click', function () {
		let data_link = $(this).data('link');
		navigator.clipboard.writeText(data_link);

		$(".toast-message").fadeIn("slow", function () {
			$(".toast-message").delay(1000).fadeOut("slow");
		});
	});
});