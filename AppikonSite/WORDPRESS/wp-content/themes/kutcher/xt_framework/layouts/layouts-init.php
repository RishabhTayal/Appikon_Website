<?php
/************************************
	XIAOTHEMES LAYOUTS INIT
************************************/

	function xt_setup_layouts() {
	
		// Enable Support to Post Formats
		add_theme_support( 'post-formats', array( 'gallery', 'image', 'link', 'quote', 'video', 'audio' ) );
		
		// Thumbnail Sizes
		add_theme_support( 'post-thumbnails' );
		
		// Default Thumbnail Size
		add_image_size( 'blog-size', 700, 9999 );
		add_image_size( 'latest-posts-size', 480, 9999 );
		
	}
	add_action( 'init', 'xt_setup_layouts' );

	/* Register Styles and Scripts */

	function xt_layouts_enqueue_styles_scripts() {

		// Page Styles
		wp_register_style( 'xt_layout_styles', get_template_directory_uri() . '/xt_framework/layouts/assets/css/layouts.css', false, '1.0.0' );
		wp_enqueue_style( 'xt_layout_styles' );

		// Blog Fonts
		wp_register_style( 'xt_blog_fonts', get_template_directory_uri() . '/xt_framework/layouts/assets/css/xt_blog_fonts.css', false, '1.0.0' );

		// Blog Script
		wp_register_script( 'xt-blog-js', get_template_directory_uri() . '/xt_framework/layouts/assets/js/blog-init.js', 
			array( 'jquery' ), '1', true );	
	}

	add_action('init', 'xt_layouts_enqueue_styles_scripts');

	/* Register Sidebars */

	function xt_register_sidebars() {

		register_sidebar( array(
			'id'          => 'xt-sidebar',
			'name'        => 'Main Sidebar',
			'description' => 'Displayed at content\'s side on pages like: Blog, Single Post and Pages with Sidebar.',
			'before_title'  => '<h3 class="widgettitle"><span>',
			'after_title'   => '</span></h3>',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		) );

		add_filter( 'widget_text', 'do_shortcode');
		add_filter( 'widget_title', 'do_shortcode');

	}
	add_action('init', 'xt_register_sidebars');

	/* Pagination */

	/*== PAGINATION ==*/
	
	function xt_nav_pagination($range = 2, $pages = '' )
	{  
		
		$showitems = ($range * 2)+1;  

		global $paged;
		if(empty($paged)) $paged = 1;

		if($pages == '')
		{
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages)
			{
				$pages = 1;
			}
		}   

		if(1 != $pages)
		{
			echo '<div class="navigation">';
				echo '<div class="page-numbers">';
					for ($i=1; $i <= $pages; $i++)
					{
						if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
						{
							 echo ($paged == $i)? "<a class='active'>".$i."</a>":"<a href='".get_pagenum_link($i)."'>".$i."</a>";
						}
					}
				echo '</div>';
				
				echo '<div class="page-arrows">';
					if($paged > 1) 
						echo '<a href="'.get_pagenum_link($paged - 1).'" class="prev">'.__('Previous', 'kutcher').'</a>';
					if ($paged < $pages)
						echo '<a href="'.get_pagenum_link($paged + 1).'" class="next">'.__('Next', 'kutcher').'</a>';
				echo '</div>';
				
				echo '<div class="clear clearboth"></div>';
				
			echo "</div>\n";
		}
	}

	/* Metabox */

	require_once( "metabox/slider.php" );
	require_once( "metabox/parallax.php" );

	/* Shortcodes */

	require_once( "shortcodes/shortcodes.php" );

	/* Custom Widgets */

	require_once( "widgets/widgets.php" );

	add_action( 'widgets_init', 'xt_custom_widgets' );


	function xt_custom_widgets() {

		register_widget( 'XTTwitterFeeds' );
		register_widget( 'XTOrganizerTabs' );
		register_widget( 'XTLatestProjects' );
		register_widget( 'XTPostTabs' );
		register_widget( 'XTFacebookBox' );
		register_widget( 'XTFlickr' );

	}

	add_filter('widget_text', 'do_shortcode');
