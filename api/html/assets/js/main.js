/*
	Halcyonic by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

(function($) {

	skel
		.breakpoints({
			desktop: '(min-width: 737px)',
			tablet: '(min-width: 737px) and (max-width: 1200px)',
			mobile: '(max-width: 736px)'
		})
		.viewport({
			breakpoints: {
				tablet: {
					width: 1080
				}
			}
		});

	$(function() {

		var $window = $(window),
			$body = $('body');

		// Fix: Placeholder polyfill.
			$('form').placeholder();

		// Prioritize "important" elements on mobile.
			skel.on('+mobile -mobile', function() {
				$.prioritize(
					'.important\\28 mobile\\29',
					skel.breakpoint('mobile').active
				);
			});

		// Off-Canvas Navigation.

			// Title Bar.
				$(
					'<div id="titleBar">' +
						'<a href="#navPanel" class="toggle"></a>' +
						'<span class="title">' + $('#logo').html() + '</span>' +
					'</div>'
				)
					.appendTo($body);

			// Navigation Panel.
				$(
					'<div id="navPanel">' +
						'<nav>' +
							$('#nav').navList() +
						'</nav>' +
					'</div>'
				)
					.appendTo($body)
					.panel({
						delay: 500,
						hideOnClick: true,
						hideOnSwipe: true,
						resetScroll: true,
						resetForms: true,
						side: 'left',
						target: $body,
						visibleClass: 'navPanel-visible'
					});

			// Fix: Remove navPanel transitions on WP<10 (poor/buggy performance).
				if (skel.vars.os == 'wp' && skel.vars.osVersion < 10)
					$('#titleBar, #navPanel, #page-wrapper')
						.css('transition', 'none');

			try {
				for (let index = 0; index < 20; index++) {
					$( 'a[data-imagelightbox="gal'+index+'"]' ).imageLightbox({
						activity: true,
						caption: true,
						navigation: true
					});
				}
			} catch (error) {
				
			}

			var currentSlide = 0;
			setInterval(() => {
				$('#slide_'+currentSlide).fadeOut(500);
				// $('#slide_'+currentSlide).removeClass("slideshow");
				// $('#slide_'+currentSlide).addClass("slidehide");
				$('#slideritem_'+currentSlide).removeClass("itemshow");
				$('#slideritem_'+currentSlide).addClass("itemhide");
				currentSlide = (currentSlide == 2) ? 0 : currentSlide + 1;
				$('#slide_'+currentSlide).fadeIn(500);
				// $('#slide_'+currentSlide).addClass("slideshow");
				// $('#slide_'+currentSlide).removeClass("slidehide");
				$('#slideritem_'+currentSlide).addClass("itemshow");
				$('#slideritem_'+currentSlide).removeClass("itemhide");
			}, 5000);

	});

})(jQuery);