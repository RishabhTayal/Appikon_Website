/********************
	BLOG HOVER EFFECTS
********************/

	jQuery(document).ready(function() {

		/* Thumbnail Hover Effect */

		jQuery(".post .thumbnail a").hover(function() {
			jQuery(this).find(".post-thumb-hover").fadeIn("fast");
			}, function() {
			jQuery(this).find(".post-thumb-hover").fadeOut("fast");
		});

		/* Latest Posts Effect */

		jQuery(".xt-posts-wrapper .post-item .thumbnail a").hover(function() {
			jQuery(this).find(".xt-post-hover").fadeIn("fast");
			}, function() {
			jQuery(this).find(".xt-post-hover").fadeOut("fast");
		});

		/* PrettyPhoto Init */

	     jQuery("a[rel^='prettyPhoto']").magnificPopup({
	    	type:'image'
	    });

	    /* Flexslider */

	    jQuery(".thumbnail.post-gallery").flexslider({
			animation: "slide", // fade or slides
			smoothHeight: true,
			slideshow: true, // false to disable autoplay
			controlNav: true,
			directionNav: true
		});

		/* Fix Video Frame Z-Index Bug */

		 jQuery("iframe").each(function(){
			var ifr_source = jQuery(this).attr('src');
			var wmode = "wmode=transparent";
			if(ifr_source.indexOf('?') != -1) {
				var getQString = ifr_source.split('?');
				var oldString = getQString[1];
				var newString = getQString[0];
				jQuery(this).attr('src',newString+'?'+wmode+'&'+oldString);
			}
			else jQuery(this).attr('src',ifr_source+'?'+wmode);
		});

	});