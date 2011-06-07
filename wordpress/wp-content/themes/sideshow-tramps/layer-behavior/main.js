jQuery(function($) {
    
    $('#WidgetMailBlack').attr('style', '');

	//valid and unobtrustive means of loading a new window
	$('a[rel="external"]').attr("target","_blank");

	// shadowbox with defaults
	Shadowbox.init();

	// so that the image links refer to their larger resolutions
	// and shadowbox can be invoked by them
	$(".attachment-thumbnail").each(function() {
		var el = $(this);
			el
			.parent()
			.attr("href", $(this).attr("src").replace("-150x150",""))
			.attr("rel", "shadowbox["+$(this).parent().parent().parent().parent().attr("class").slice(0,7)+"]");
	});
	
	// preloading backgrounds since they're so massive!
	//window.setTimeout(function() {
	/*
	$.preLoadImages(
		"/wordpress/wp-content/themes/sideshow-tramps/images/craig-bio-bg.jpg", 
		"/wordpress/wp-content/themes/sideshow-tramps/images/scott-bio-bg.jpg",
		"/wordpress/wp-content/themes/sideshow-tramps/images/geoffery-bio-bg.jpg",
		"/wordpress/wp-content/themes/sideshow-tramps/images/shane-bio-bg.jpg",
		"/wordpress/wp-content/themes/sideshow-tramps/images/bios-template-bg.jpg",
		"/wordpress/wp-content/themes/sideshow-tramps/images/generic-template-bg.jpg",
		"/wordpress/wp-content/themes/sideshow-tramps/images/music-template-bg.jpg",
		"/wordpress/wp-content/themes/sideshow-tramps/images/shows-template-bg.jpg",
		"/wordpress/wp-content/themes/sideshow-tramps/images/video-template-bg.jpg"
	);
	*/
	//}, 500);
	
});
