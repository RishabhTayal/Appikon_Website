/*

	Supersized - Fullscreen Slideshow jQuery Plugin
	Version : 3.2.7
	Theme 	: Shutter 1.1
	
	Site	: www.buildinternet.com/project/supersized
	Author	: Sam Dunn
	Company : One Mighty Roar (www.onemightyroar.com)
	License : MIT License / GPL License

*/

(function(a){theme={_init:function(){if(api.options.slide_links){a(vars.slide_list).css("margin-left",-a(vars.slide_list).width()/2)}if(api.options.autoplay){if(api.options.progress_bar){theme.progressBar()}}else{if(a(vars.play_button).attr("src")){a(vars.play_button).attr("src",vars.image_path+"play.png")}if(api.options.progress_bar){a(vars.progress_bar).stop().animate({left:-a(window).width()},0)}}a(vars.thumb_tray).animate({bottom:-a(vars.thumb_tray).height()},0);a(vars.tray_button).toggle(function(){a(vars.thumb_tray).stop().animate({bottom:0,avoidTransforms:true},300);if(a(vars.tray_arrow).attr("src")){a(vars.tray_arrow).attr("src",vars.image_path+"button-tray-down.png")}return false},function(){a(vars.thumb_tray).stop().animate({bottom:-a(vars.thumb_tray).height(),avoidTransforms:true},300);if(a(vars.tray_arrow).attr("src")){a(vars.tray_arrow).attr("src",vars.image_path+"button-tray-up.png")}return false});a(vars.thumb_list).width(a("> li",vars.thumb_list).length*a("> li",vars.thumb_list).outerWidth(true));if(a(vars.slide_total).length){a(vars.slide_total).html(api.options.slides.length)}if(api.options.thumb_links){if(a(vars.thumb_list).width()<=a(vars.thumb_tray).width()){a(vars.thumb_back+","+vars.thumb_forward).fadeOut(0)}vars.thumb_interval=Math.floor(a(vars.thumb_tray).width()/a("> li",vars.thumb_list).outerWidth(true))*a("> li",vars.thumb_list).outerWidth(true);vars.thumb_page=0;a(vars.thumb_forward).click(function(){if(vars.thumb_page-vars.thumb_interval<=-a(vars.thumb_list).width()){vars.thumb_page=0;a(vars.thumb_list).stop().animate({left:vars.thumb_page},{duration:500,easing:"easeOutExpo"})}else{vars.thumb_page=vars.thumb_page-vars.thumb_interval;a(vars.thumb_list).stop().animate({left:vars.thumb_page},{duration:500,easing:"easeOutExpo"})}});a(vars.thumb_back).click(function(){if(vars.thumb_page+vars.thumb_interval>0){vars.thumb_page=Math.floor(a(vars.thumb_list).width()/vars.thumb_interval)*-vars.thumb_interval;if(a(vars.thumb_list).width()<=-vars.thumb_page){vars.thumb_page=vars.thumb_page+vars.thumb_interval}a(vars.thumb_list).stop().animate({left:vars.thumb_page},{duration:500,easing:"easeOutExpo"})}else{vars.thumb_page=vars.thumb_page+vars.thumb_interval;a(vars.thumb_list).stop().animate({left:vars.thumb_page},{duration:500,easing:"easeOutExpo"})}})}a(vars.next_slide).click(function(){api.nextSlide()});a(vars.prev_slide).click(function(){api.prevSlide()});if(jQuery.support.opacity){a(vars.prev_slide+","+vars.next_slide).mouseover(function(){a(this).stop().animate({opacity:1},100)}).mouseout(function(){a(this).stop().animate({opacity:0.6},100)})}if(api.options.thumbnail_navigation){a(vars.next_thumb).click(function(){api.nextSlide()});a(vars.prev_thumb).click(function(){api.prevSlide()})}a(vars.play_button).click(function(){api.playToggle()});if(api.options.mouse_scrub){a(vars.thumb_tray).mousemove(function(f){var c=a(vars.thumb_tray).width(),g=a(vars.thumb_list).width();if(g>c){var b=1,d=f.pageX-b;if(d>10||d<-10){b=f.pageX;newX=(c-g)*(f.pageX/c);d=parseInt(Math.abs(parseInt(a(vars.thumb_list).css("left"))-newX)).toFixed(0);a(vars.thumb_list).stop().animate({left:newX},{duration:d*3,easing:"easeOutExpo"})}}})}a(window).resize(function(){if(api.options.progress_bar&&!vars.in_animation){if(vars.slideshow_interval){clearInterval(vars.slideshow_interval)}if(api.options.slides.length-1>0){clearInterval(vars.slideshow_interval)}a(vars.progress_bar).stop().animate({left:-a(window).width()},0);if(!vars.progressDelay&&api.options.slideshow){vars.progressDelay=setTimeout(function(){if(!vars.is_paused){theme.progressBar();vars.slideshow_interval=setInterval(api.nextSlide,api.options.slide_interval)}vars.progressDelay=false},1000)}}if(api.options.thumb_links&&vars.thumb_tray.length){vars.thumb_page=0;vars.thumb_interval=Math.floor(a(vars.thumb_tray).width()/a("> li",vars.thumb_list).outerWidth(true))*a("> li",vars.thumb_list).outerWidth(true);if(a(vars.thumb_list).width()>a(vars.thumb_tray).width()){a(vars.thumb_back+","+vars.thumb_forward).fadeIn("fast");a(vars.thumb_list).stop().animate({left:0},200)}else{a(vars.thumb_back+","+vars.thumb_forward).fadeOut("fast")}}})},goTo:function(b){if(api.options.progress_bar&&!vars.is_paused){a(vars.progress_bar).stop().animate({left:-a(window).width()},0);theme.progressBar()}},playToggle:function(b){if(b=="play"){if(a(vars.play_button).attr("src")){a(vars.play_button).attr("src",vars.image_path+"pause.png")}if(api.options.progress_bar&&!vars.is_paused){theme.progressBar()}}else{if(b=="pause"){if(a(vars.play_button).attr("src")){a(vars.play_button).attr("src",vars.image_path+"play.png")}if(api.options.progress_bar&&vars.is_paused){a(vars.progress_bar).stop().animate({left:-a(window).width()},0)}}}},beforeAnimation:function(b){if(api.options.progress_bar&&!vars.is_paused){a(vars.progress_bar).stop().animate({left:-a(window).width()},0)}if(a(vars.slide_caption).length){(api.getField("title"))?a(vars.slide_caption).html(api.getField("title")):a(vars.slide_caption).html("")}if(vars.slide_current.length){a(vars.slide_current).html(vars.current_slide+1)}if(api.options.thumb_links){a(".current-thumb").removeClass("current-thumb");a("li",vars.thumb_list).eq(vars.current_slide).addClass("current-thumb");if(a(vars.thumb_list).width()>a(vars.thumb_tray).width()){if(b=="next"){if(vars.current_slide==0){vars.thumb_page=0;a(vars.thumb_list).stop().animate({left:vars.thumb_page},{duration:500,easing:"easeOutExpo"})}else{if(a(".current-thumb").offset().left-a(vars.thumb_tray).offset().left>=vars.thumb_interval){vars.thumb_page=vars.thumb_page-vars.thumb_interval;a(vars.thumb_list).stop().animate({left:vars.thumb_page},{duration:500,easing:"easeOutExpo"})}}}else{if(b=="prev"){if(vars.current_slide==api.options.slides.length-1){vars.thumb_page=Math.floor(a(vars.thumb_list).width()/vars.thumb_interval)*-vars.thumb_interval;if(a(vars.thumb_list).width()<=-vars.thumb_page){vars.thumb_page=vars.thumb_page+vars.thumb_interval}a(vars.thumb_list).stop().animate({left:vars.thumb_page},{duration:500,easing:"easeOutExpo"})}else{if(a(".current-thumb").offset().left-a(vars.thumb_tray).offset().left<0){if(vars.thumb_page+vars.thumb_interval>0){return false}vars.thumb_page=vars.thumb_page+vars.thumb_interval;a(vars.thumb_list).stop().animate({left:vars.thumb_page},{duration:500,easing:"easeOutExpo"})}}}}}}},afterAnimation:function(){if(api.options.progress_bar&&!vars.is_paused){theme.progressBar()}},progressBar:function(){a(vars.progress_bar).stop().animate({left:-a(window).width()},0).animate({left:0},api.options.slide_interval)}};a.supersized.themeVars={progress_delay:false,thumb_page:false,thumb_interval:false,image_path:"img/",play_button:"#pauseplay",next_slide:"#nextslide",prev_slide:"#prevslide",next_thumb:"#nextthumb",prev_thumb:"#prevthumb",slide_caption:"#slidecaption",slide_current:".slidenumber",slide_total:".totalslides",slide_list:"#slide-list",thumb_tray:"#thumb-tray",thumb_list:"#thumb-list",thumb_forward:"#thumb-forward",thumb_back:"#thumb-back",tray_arrow:"#tray-arrow",tray_button:"#tray-button",progress_bar:"#progress-bar"};a.supersized.themeOptions={progress_bar:1,mouse_scrub:0}})(jQuery);


/* Supersized Images */

		jQuery(function($){

			if(XT_MAIN_SLIDES != '') {
				
				$.supersized({
				
					// Functionality
					slideshow               :   1,			// Slideshow on/off
					autoplay				:	1,			// Slideshow starts playing automatically
					start_slide             :   1,			// Start slide (0 is random)
					stop_loop				:	0,			// Pauses slideshow on last slide
					random					: 	0,			// Randomize slide order (Ignores start slide)
					slide_interval          :   12000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	1000,		// Speed of transition
					new_window				:	1,			// Image links open in new window/tab
					pause_hover             :   0,			// Pause slideshow on hover
					keyboard_nav            :   1,			// Keyboard navigation on/off
					performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	1,			// Disables image dragging and right click with Javascript
															   
					// Size & Position						   
					min_width		        :   0,			// Min width allowed (in pixels)
					min_height		        :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait         	:   1,			// Portrait images will not exceed browser height
					fit_landscape			:   0,			// Landscape images will not exceed browser width
															   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					thumb_links				:	0,			// Individual thumb links for each slide
					thumbnail_navigation    :   0,			// Thumbnail navigation
					slides 					:  	XT_MAIN_SLIDES,
												
					// Theme Options			   
					progress_bar			:	0,			// Timer for each slide							
					mouse_scrub				:	0
					
				});
			}
		});
