/*****************
	Init hover effect of shortcodes
*****************/

	jQuery(document).ready(function() {

		jQuery(".project-item .thumbnail a").hover(function() {
			jQuery(this).find(".xt-project-hover").fadeIn("fast");
		}, function() {
			jQuery(this).find(".xt-project-hover").fadeOut("fast");
		});

	});
