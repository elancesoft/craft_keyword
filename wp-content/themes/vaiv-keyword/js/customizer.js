jQuery(document).ready(function ($) {
	AOS.init();


	// Hot Brand click action
	$('.host-brand-item').click(function () {
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
	$('.brandranking-detail-top3-slider').slick({
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
});