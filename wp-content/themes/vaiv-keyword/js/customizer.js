jQuery(document).ready(function ($) {
	AOS.init();

	// Hot Brand click action
	$('.host-brand-item-123123').click(function () {
		$('.host-brand-item').removeClass('active');
		$(this).toggleClass('active');

		// Show/hide content
		$('.hot-brand-detail').addClass('d-none');
		var data_alias = $(this).data('alias');
		$('#' + data_alias).removeClass('d-none');
	});

	// Slider
	$('.today-pick-thumbnails').slick({
		arrows: true,
		centerMode: true,
		infinite: true,
		centerPadding: '250px',
		slidesToShow: 1,
		speed: 500,
		dots: true,

		//autoplay: true,
		//autoplaySpeed: 3000,
	});

	// Collapse on brand ranking detail page
	$('.table-brandranking-detail-collapse').on('click', function () {
		var aria_expanded = $(this).attr("aria-expanded");

		$('.table-brandranking-detail-collapse .arrow-direction').removeClass('bi-chevron-up').addClass('bi-chevron-down');
		$('.table-brandranking-detail .collapse').removeClass('show');

		if (aria_expanded == 'true') {
			$(this).find('.arrow-direction').removeClass('bi-chevron-down').addClass('bi-chevron-up');
		} else if (aria_expanded == 'false') {
			$(this).find('.arrow-direction').removeClass('bi-chevron-up').addClass('bi-chevron-down');
		}
	});

	// Show tooltip
	$('[data-bs-toggle="tooltip"]').tooltip({ html: true });


	// Top3 Slider
	$('.brandranking-detail-top3-slider-123').slick({
		infinite: true,
		centerMode: true,
		variableWidth: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: true,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					arrows: false,
					centerMode: true,
				}
			},
			{
				breakpoint: 480,
				settings: {
					arrows: false,
					dots: true,
					centerMode: true,
					slidesToShow: 1
				}
			}
		]
	});

	// $('.trend-list .row').owlCarousel({
	// 	margin: 10,
	// 	loop: true,
	// 	autoWidth: true,
	// 	items: 3
	// });


	// TODAY PICK ACTION
	$('#today-pick-previous, #today-pick-previous-desktop').on('click', function () {
		var $list = $('.today-pick-slider-list'),
			$items = $list.children(),
			$lastItem = $items.last();

		$items.removeClass('active');
		$items.eq(0).before($lastItem).addClass('active');
	});

	$('#today-pick-next, #today-pick-next-desktop').on('click', function () {
		var $list = $('.today-pick-slider-list'),
			$items = $list.children(),
			$firstItem = $items.first();

		$items.removeClass('active');
		$items.eq(2).after($firstItem).addClass('active');
	});


	// SEARCH
	$('.search-icon-wrap').on('click', function () {
		$("#overlay").fadeIn(300);
		$(this).addClass('d-none');
	});

	$('#search-close').on('click', function () {
		$("#overlay").fadeOut(300);
		$('.search-icon-wrap').removeClass('d-none');
	});

	$('#share-by-copy').on('click', function () {
		let data_link = $(this).data('link');
		navigator.clipboard.writeText(data_link);
	});

});