<?php

	/* XT Base Theme Functions with Main Functions and Configurations */

	// Theme Directory URI Constant
	define("THEME_DIR", get_template_directory_uri());
	
	// Remove Generator Tag to improve security
	remove_action('wp_head', 'wp_generator');
	
	// Multilanguage Support	
	load_theme_textdomain( 'kutcher', get_template_directory().'/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory()."/languages/$locale.php";
	if ( is_readable($locale_file) )
		require_once($locale_file);

	// Content Width
	if ( ! isset( $content_width ) ) $content_width = 900;

	/* XT LAYOUT BUILDER */	
	require("xt_framework/layout-builder/layout-builder.php");
	
	if(!is_admin())
		require("xt_framework/layout-builder/init.php");
	
	/* XT CUSTOM SHORTCODES */
	require("xt_framework/shortcodes/init.php");
	
	/* XT PORTFOLIO */
	require("xt_framework/portfolio/portfolio-init.php");
	
	/* XT Options Panel */
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/xt_framework/options/' );
	// Options Framework
	require_once dirname( __FILE__ ) . '/xt_framework/options/options-framework.php';
	// Fonts Selector Helpers
	require_once dirname( __FILE__ ) . '/xt_framework/options/fonts_functions.php';
	// Print Style Function
	require_once dirname( __FILE__ ) . '/xt_framework/options/print_style.php';
	
	/* XT LAYOUTS */
	require("xt_framework/layouts/layouts-init.php");

	/* WPML Integration */
	require_once('wpml-integration.php');

	/* Main Slides Manager */
	require_once('xt_framework/custom/main_slider_manager.php');
	
	// Function to avoid styles at Login Page
	function is_login_page() {
		return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
	}
	
	// Enqueue Styles
	function enqueue_styles() {
		if(!is_admin() && !is_login_page()) :
									
			// Oswald Google Font
			wp_register_style( 'Oswald-OpenSans', 'http://fonts.googleapis.com/css?family=Oswald|Open+Sans:400,600', array(), '1', 'all' );
			wp_enqueue_style( 'Oswald-OpenSans' );
	
			// Skeleton Framework Base Classes
			wp_register_style( 'skeleton', THEME_DIR . '/css/skeleton.css', array(), '1', 'all' );
			wp_enqueue_style( 'skeleton' );

			if(of_get_option('disable_responsive') == false) :
			// Skeleton Framework Responsive Sizes
			wp_register_style( 'skeleton-responsive', THEME_DIR . '/css/skeleton-responsive.css', array(), '1', 'all' );
			wp_enqueue_style( 'skeleton-responsive' );
			endif;

			// General Theme Styles
			wp_register_style( 'style', THEME_DIR . '/css/style.css', array(), '1', 'all' );
			wp_enqueue_style( 'style' );
			
			// Fullscreen Slider Supersized			
			wp_register_style( 'supersized.shutter', THEME_DIR . '/css/supersized.shutter.css', array(), '1', 'all' );
			wp_enqueue_style( 'supersized.shutter' );
			
			// FontAwesome Icons
			wp_register_style( 'font-awesome-kutcher', THEME_DIR . '/css/font-awesome.css', array(), '1', 'all' );
			wp_enqueue_style( 'font-awesome-kutcher' );
			
			if(of_get_option('disable_responsive') == false) :
			// Media Queries
			wp_register_style( 'media-queries', THEME_DIR . '/css/media.css', array(), '1', 'all' );
			wp_enqueue_style( 'media-queries' );
			endif;

			// Includes Main Stylesheet
			wp_enqueue_style("main-style", get_stylesheet_directory_uri() ."/style.css", false, "1.0", "all");
						
		endif;
	}
	add_action( 'wp_enqueue_scripts', 'enqueue_styles' );
	
	// Enqueue Scripts
	function enqueue_scripts() {
		if(!is_admin() && !is_login_page()) :

			// jQuery Script
			wp_enqueue_script( 'jquery' );
			
			// HTML5 Compatibility
			wp_register_script( 'html5-shim', THEME_DIR . '/js/html5.js', array(), null, false );
			wp_enqueue_script( 'html5-shim' );
			
			// jQuery Easing
			wp_enqueue_script( 'jquery.easing', THEME_DIR . '/js/jquery.easing.min.js', array('jquery'), NULL, true );
			
			// jQuery Supersized Slider
			wp_enqueue_script( 'supersized', THEME_DIR . '/js/supersized.3.2.7.min.js', array('jquery'), NULL, true );
			wp_enqueue_script( 'supersized.images', THEME_DIR . '/js/supersized.images.js', array('jquery'), NULL, true );
			
			// Main Scripts
			wp_enqueue_script( 'main', THEME_DIR . '/js/main.js', array('jquery'), NULL, true );
			
			if(of_get_option('disable_responsive') == false) :
				// Responsive Menu
				wp_enqueue_script( 'selectnav.min', THEME_DIR . '/js/selectnav.min.js', array('jquery'), NULL, true );
				//wp_enqueue_script( 'selectnav', THEME_DIR . '/js/selectnav.js', array('jquery'), NULL , true );
			endif;
			
			// jQuery Smart Resize
			wp_enqueue_script( 'smartresize', THEME_DIR . '/js/jquery.smartresize.js', array('jquery'), NULL, true );

			// Comments Script
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

		endif;
	}
	add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

	// Sidebars (Footer only)
	
	/*
	register_sidebar( array(
		'id'		  => 'right-sidebar',
		'name'		=> 'Right Sidebar',
		'description' => 'Widget Area of Footer',
		'before_title'  => '<h3 class="widgettitle"><span>',
		'after_title'   => '</span></h3>',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>'
	) );
	*/
	
	add_filter('widget_text', 'do_shortcode');
	add_filter('widget_title', 'do_shortcode');
	
	// Post Thumbnails Support	
	if (function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
	}
	
	// Additional Image Sizes
	if ( function_exists( 'add_image_size' ) ) { 
		// add_image_size( 'blog-size', 700, 9999 );
	}

	add_post_type_support('page', 'excerpt');
	
	// Get the slug
	function get_the_slug(){
	  global $post; 
	  return $post->post_name;
	}

	/* Parallax at Top */

	function parallax_tweet() {
	?>
		<script type="text/javascript">
			var TWEET_NUM = 0;
		</script>
	<?php
	}
	add_action('wp_head', 'parallax_tweet');

	/* Parallax at Bottom */

	function parallax_rules() {

		$styles = '';
		$mediaStyles = '';
		$scripts = '';

		// Get posts IDs from backend
		$theme_pages_ids_opts = of_get_option('pages');

		if($theme_pages_ids_opts != '') :

			$theme_pages_ids_opts = substr_replace( $theme_pages_ids_opts, "", -1); // Removes last char of Ids, the ; in the case

			$theme_pages_ids_opts = explode(";", $theme_pages_ids_opts);

			$theme_pages_ids = array();
			$theme_pages_external = array();

			foreach ($theme_pages_ids_opts as $id) {
				$id = explode(',', $id);

				if(function_exists('icl_object_id'))
					$id[0] = icl_object_id($id[0], 'page', false);

				$theme_pages_ids[] = $id[0];

				$theme_pages_external[ $id[0] ] = $id[1];	
			}

			$theme_pages_args = array( 'post__in' => $theme_pages_ids, 'post_type' => 'page', 'orderby' => 'post__in',
				'posts_per_page' => -1 );
			$theme_pages_posts = new WP_Query( $theme_pages_args );

			$parallaxCounter = 0;
			$currentPage = 0; // 0 => first

			while( $theme_pages_posts->have_posts() ) : $theme_pages_posts->the_post();

				if($theme_pages_external[get_the_ID()] != 'y' ) :

					$parallax_status = get_post_meta( get_the_ID(), 'parallax-status', true );

					if($parallax_status == '') :

						$template = get_post_meta( get_the_ID(), '_wp_page_template', true );

						// Parallax Img
						$parallax_img = get_post_meta( get_the_ID(), 'parallax-img', true );

						// Parallax Height
						$parallax_height = get_post_meta( get_the_ID(), 'parallax-height', true );
						if($parallax_height == '')
							$parallax_height = '440';

						if($parallax_img != '' && $template != 'page-templates/page-content-contact.php') :

							$styles .= '
							.bg'.$parallaxCounter.' {
								background: url('.$parallax_img.') 50% 50% fixed repeat-y;
								width: 100%;
								height: 100%;
								margin: 0 auto;
								position: absolute;
								background-size: 110%;
							}

							#parallax'.$parallaxCounter.' {
								width: 100%;
								height: '.$parallax_height.'px;
								background-color: #1c1f26;
								position: relative;
								overflow: hidden;
							}

							#parallax'.$parallaxCounter.' .vertical-text, #parallax'.$parallaxCounter.' .pattern {
								height: '.$parallax_height.'px;
							}
							';

							if($parallax_height <= 440)
								$mediaStyles .= '
								#parallax'.$parallaxCounter.', #parallax'.$parallaxCounter.' .vertical-text, #parallax'.$parallaxCounter.' .pattern {
									height: 600px;
								}
								';

							$scripts .= '
								jQuery(".bg'.$parallaxCounter.'").parallax("50%", 0.4);
							';

							$parallaxCounter++;

						elseif($template == 'page-templates/page-content-contact.php') :

							/* Contact Case */

							$slug = get_the_slug();

							$styles .= '
							#'.$slug.'-menu {
								background: url("'.$parallax_img.'") top center fixed;
								width: 100%;
								height: auto;
								min-height: 100%;
								background-color: #fff;
								position: relative;

								-webkit-background-size: cover;
								-moz-background-size: cover;
								-o-background-size: cover;
								background-size: cover;
							}
							';

						else :

							/* Without BG Case */

							$slug = get_the_slug();

							$styles .= '
							#'.$slug.'-menu {
								background-color: #fff;
								position: relative;
							}
							';

						endif;
					
					endif; // parallax activated

				endif; // not run if is external!

			endwhile;

		?>
		<style type="text/css">
			/* Initialization of All Parallax Backgrounds */

			<?php echo $styles; ?>

			@media only screen and (min-width: 1400px) {
				<?php echo $mediaStyles; ?>
				.bg { background-size: 100% !important; }
			}

		</style>

		<script type="text/javascript">
			/* Initialization of All Parallax Backgrounds */

			jQuery(document).ready(function(){
				//.parallax(xPosition, speedFactor, outerHeight) options:
				//xPosition - Horizontal position of the element
				//inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
				//outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
				var isMobile = {
					Android: function() {
						return navigator.userAgent.match(/Android/i);
					},
					BlackBerry: function() {
						return navigator.userAgent.match(/BlackBerry/i);
					},
					iOS: function() {
						return navigator.userAgent.match(/iPhone|iPad|iPod/i);
					},
					Opera: function() {
						return navigator.userAgent.match(/Opera Mini/i);
					},
					Windows: function() {
						return navigator.userAgent.match(/IEMobile/i);
					},
					any: function() {
						return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
					}
				};

				var testMobile = isMobile.any();
				
				if (testMobile == null)
				{
					<?php echo $scripts; ?>
				}
			});

		</script>
	<?php
		endif; // has pages IF
	}

	add_action('wp_footer', 'parallax_rules', 30);

	// Add Custom Styles to Revolution Layer Manager

	function xt_custom_lm_styles() {
		wp_register_style( 'xt-custom-lm-styles', THEME_DIR . '/css/custom_lm_styles.css', array('dc-settings-css-admin'), '1', 'all' );
		wp_enqueue_style( 'xt-custom-lm-styles' );
	}

	add_action('xt_lm_styles', 'xt_custom_lm_styles', 1);

	/* WPML Flag only Selector */

	function language_selector_flags(){
		if( function_exists('icl_get_languages') ) : 
			$languages = icl_get_languages('skip_missing=0&orderby=code');
			if(!empty($languages)){
				foreach($languages as $l){
					if(!$l['active']) echo '<a href="'.$l['url'].'">';
					echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
					if(!$l['active']) echo '</a>';
				}
			}
		endif;
	}