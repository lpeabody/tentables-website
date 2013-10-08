(function($){

	//
	//gives breadcrumbs dots to visually separate
	//
	$('.breadcrumbs li a').before('<span class="pseudo">&nbsp;&nbsp;&bull;</span> ');
	$('.breadcrumbs li:first-child span').remove();

	$('.button').prepend('<span class="pseudo">&gt;</span> ');

	//
	//gives ribbon flair
	//
	$('.ribbon').prepend('<span class="pseudo before"></span> ');
	$('.ribbon').append('<span class="pseudo after"></span> ');
	
	//
	//gives slider controls flair
	//
	$('.slider-controls').prepend('<span class="pseudo before"></span> ');
	$('.slider-controls').append('<span class="pseudo after"></span> ');

})(jQuery);