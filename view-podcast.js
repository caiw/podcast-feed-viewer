$(document).ready(function() {
	$('.episode-media-link').click(function() {
		var media_url = $(this).attr('href');
		var media_type = $(this).attr('type');
		$(this).replaceWith('<audio controls="controls" src="' + media_url + '" type="' + media_type + '" />');
		return false;
	});
});
