/**
 * Main script.
 */

/** Scroll animation **/
$(function () {
	$('#scroll').click(function () {
		$('html, body').animate({
			scrollTop: $('header').outerHeight(true)
		});
	});
});