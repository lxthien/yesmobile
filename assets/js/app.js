$(document).ready(function() {
    initSliderHomepage();
    menuNavigation();

    function menuNavigation() {
        $('.drop-down').click(function() {
            $('.nav-item .dropdown-menu').hide();
            if( $(this).hasClass('active') )
                $(this).removeClass('active').next('.dropdown-menu').hide();
            else
                $(this).addClass('active').next('.dropdown-menu').show();
        })
    }
	function initSliderHomepage() {
		if(jQuery.browser.mobile) {
			$('#service-bxslider').carouFredSel({
	            responsive: true,
                width: 320,
                auto: true,
				scroll: 1,
				items: {
                    width: 160,
                    height: 120,
					visible: {
						min: 1,
						max: 1
					}
				}
	        });
        } else {
	        $('#service-bxslider').carouFredSel({
                responsive: true,
                width: '100%',
                height: '100%',
                auto: false,
                scroll: 1,
                swipe: {
                    onMouse: true,
                    onTouch: true
                },
                items: {
                    width: 160,
                    visible: {
                        min: 1,
                        max: 7
                    }
                }
            });
        }

		
        if ($('#slider').length > 0) {
			$('#slider').nivoSlider({
				animSpeed: 500,
				pauseTime: 9000
			});
		}

		/*
		if ($('#slider1').length > 0) {
			$('#slider1').carouFredSel({
				auto: false,
				responsive: true,
				scroll: {
					items: 1,
					duration: 3000
				},
				mousewheel: true,
				items: {
					visible: 1,
					width: 200,
					height: 190
				}
			});
		}
		*/
	}
});