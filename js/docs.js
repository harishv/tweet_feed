/**
 * Project's common JS file.
 */
!function($) {

	$(function() {

		//Check to see if the window is top if not then display button
		$(window).scroll(function() {
			if ($(this).scrollTop() > 100) {
				$('.back-to-top').fadeIn();
			} else {
				$('.back-to-top').fadeOut();
			}
		});

		// Back to top Scroll
		$('.back-to-top').click(function() {
			$("html, body").animate({
				scrollTop: "0px"
			}, 1500);
		});

		$('.cancel-btn').on('click', function (event) {
			$('.control-group').each(function() {
				$(this).removeClass('success error');
			});
			$('span.help-inline').each(function() {
				$(this).text('');
			});
		});

	});

}(window.jQuery);