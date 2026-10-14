$(".sec-out-partner-content").slick({
	infinite: true,
	lazyLoad: 'ondemand',
	slidesToShow: 6,
	slidesToScroll: 6,
	prevArrow:'<i class="fa-solid fa-angle-left"></i>',
    nextArrow:'<i class="fa-solid fa-angle-right"></i>',
	autoplay: true,
    autoplaySpeed: 2000,
	dots: false,
	responsive: [
		{
			breakpoint: 1200,
			settings: {
				slidesToShow: 4,
				slidesToScroll: 4,
				infinite: true
			}
		},
		{
			breakpoint: 768,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 3,
            	autoplay: false
			}
		},
		{
			breakpoint: 426,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 2,
            	autoplay: false
			}
		}
	]
});


$(window).scroll(function () {
    if ($(window).scrollTop() != 0) {
        $('#top').fadeIn();
    } else {
        $('#top').fadeOut();
    }
    
    if (window.pageYOffset > 120) {
        $("header .container-fluid-menu").addClass("sticky");
    } else {
        $("header .container-fluid-menu").removeClass("sticky");
    }
});

$('#top').click(function () {
    $('html, body').animate({
        scrollTop: 0
    });
});
