
jQuery(document).ready(function($){

	/* Init Lightbox */

    $("a[rel^='portfolio-prettyPhoto']").magnificPopup({
    	type:'image'
    });

    $("a[rel^='single-prettyPhoto']").magnificPopup({
    	type:'image',
    	gallery: { enabled: true }
    });

});