/*****************
	Init any type of Portfolio following the configurations
*****************/

jQuery(document).ready(function() {

	var $container = jQuery('.xt-projects-wrapper');

	$container.imagesLoaded( function(){

		$container.isotope({
			layoutMode : 'fitRows'
		});

		jQuery('.xt-filters-wrapper a').click(function(){
			var selector = jQuery(this).attr('data-filter');
			jQuery(".xt-filters-wrapper a").removeClass("current");
			jQuery(this).addClass("current");
			$container.isotope({ filter: selector });
			return false;
		});
		
		jQuery(".project-item .thumbnail a").hover(function() {
			jQuery(this).find(".xt-project-hover").fadeIn("fast");
		}, function() {
			jQuery(this).find(".xt-project-hover").fadeOut("fast");
		});
	});

});