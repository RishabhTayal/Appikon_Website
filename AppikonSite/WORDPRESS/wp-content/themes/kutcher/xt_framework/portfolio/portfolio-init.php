<?php

/*********************
	POST TYPES
**********************/

	add_action('init', 'xt_project_custom_init');  

	function xt_project_custom_init()
	{

	  $labels = array(
		'name' => _x('Projects', 'post type general name', 'xt-portfolio'),
		'singular_name' => _x('Project', 'post type singular name', 'xt-portfolio'),
		'add_new' => _x('New Project', 'project', 'xt-portfolio'),
		'add_new_item' => __('Add New Project', 'xt-portfolio'),
		'edit_item' => __('Edit Project', 'xt-portfolio'),
		'new_item' => __('New Project', 'xt-portfolio'),
		'view_item' => __('View Project', 'xt-portfolio'),
		'search_items' => __('Search Projects', 'xt-portfolio'),
		'not_found' =>  __('No projects found', 'xt-portfolio'),
		'not_found_in_trash' => __('No projects found in Trash', 'xt-portfolio'),
		'parent_item_colon' => '',
		'menu_name' => __('Projects', 'xt-portfolio')

	  );
	  
	 $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		//'rewrite' => array("slug" => "portfolio"),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt')
	  );

	 // Register Post Type
	  register_post_type('project',$args);
	  
	  // Portfolio Filters
	  $labels = array(
		'name' => _x( 'Filters', 'taxonomy general name', 'xt-portfolio'),
		'singular_name' => _x( 'Filter', 'taxonomy singular name', 'xt-portfolio' ),
		'search_items' =>  __( 'Search Filters', 'xt-portfolio' ),
		'all_items' => __( 'All Filters', 'xt-portfolio' ),
		'parent_item' => __( 'Parent Filter', 'xt-portfolio' ),
		'parent_item_colon' => __( 'Parent Filter:', 'xt-portfolio' ),
		'edit_item' => __( 'Edit Filters', 'xt-portfolio' ),
		'update_item' => __( 'Update Filter', 'xt-portfolio' ),
		'add_new_item' => __( 'Add New Filter', 'xt-portfolio' ),
		'new_item_name' => __( 'New Filter Name', 'xt-portfolio' ),
	  );

	  // Register - Portfolio Filters
	  register_taxonomy('filter-portfolio', array('project'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'filter-portfolio' ),
	  ));
	  
	  // Portfolios - Labels
	  $labels = array(
		'name' => _x( 'Portfolios', 'taxonomy general name' ),
		'singular_name' => _x( 'Portfolio', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Portfolios' ),
		'all_items' => __( 'All Portfolios' ),
		'parent_item' => __( 'Parent Portfolio' ),
		'parent_item_colon' => __( 'Parent Portfolio:' ),
		'edit_item' => __( 'Edit Portfolios' ),
		'update_item' => __( 'Update Portfolio' ),
		'add_new_item' => __( 'Add New Portfolio' ),
		'new_item_name' => __( 'New Portfolio Name' ),
	  );
		// Register Portfolios
		register_taxonomy('type-portfolio', array('project'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'type-portfolio' ),
	  ));
	  
	}
	
	// Change default WP messages when user saves a project, filter or portfolio

	add_filter('post_updated_messages', 'xt_project_updated_messages');
	
	function xt_project_updated_messages( $messages ) {
	  global $post, $post_ID;

	  $messages['project'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Project updated. <a href="%s">View project</a>', 'xt-portfolio'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'xt-portfolio'),
		3 => __('Custom field deleted.', 'xt-portfolio'),
		4 => __('Project updated.', 'xt-portfolio'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Project restored to revision from %s', 'xt-portfolio'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Project published. <a href="%s">View project</a>', 'xt-portfolio'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Project saved.', 'xt-portfolio'),
		8 => sprintf( __('Project submitted. <a target="_blank" href="%s">Preview project</a>', 'xt-portfolio'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>', 'xt-portfolio'),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Project draft updated. <a target="_blank" href="%s">Preview project</a>', 'xt-portfolio'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  );

	  return $messages;
	}

	// Display Custom Column

	function xt_project_columns_head($defaults) {  
		$defaults['project_portfolios_column']  = 'Portfolio(s)';  
		return $defaults;  
	}  

	function xt_project_columns_content($column_name, $post_ID) {  
		if ($column_name == 'project_portfolios_column') {  
			//echo '[xt_slider id="'.xt_the_slug($post_ID).'"]';
			echo get_the_term_list( $post_ID, 'type-portfolio', '', ', ', '' );
		}  
	}  

	add_filter('manage_project_posts_columns', 'xt_project_columns_head', 10);  
	add_action('manage_project_posts_custom_column', 'xt_project_columns_content', 10, 2);

/********************
	SCRIPTS AND CSS ENQUEUES
********************/

	/* Styles */

	function xt_portfolio_enqueue_styles() {

		// PrettyPhoto Style
		//wp_register_style( 'pretty-style', get_template_directory_uri() . '/xt_framework/portfolio/prettyphoto/css/prettyPhoto.css', array(), '1', 'all' );
		wp_register_style( 'pretty-style', get_template_directory_uri() . '/xt_framework/portfolio/magnific/magnific-popup.css', array(), '1', 'all' );

		// FlexSlider Style
		wp_register_style( 'xt-flexslider-css', get_template_directory_uri() . '/xt_framework/portfolio/flexslider/css/flexslider.css', array(), '1', 'all' );

		// Fonts
		wp_register_style( 'xt_portfolio_fonts', get_template_directory_uri() . '/xt_framework/portfolio/css/xt_portfolio_fonts.css', false, '1.0.0' );	

		// Portfolio Styles
		wp_register_style( 'xt_portfolio_styles', get_template_directory_uri() . '/xt_framework/portfolio/css/styles.css', false, '1.0.0' );	
	}

	add_action('init', 'xt_portfolio_enqueue_styles');

	/* Scripts */

	function xt_portfolio_enqueue_scripts() {
		wp_enqueue_script('jquery');

		// prettyPhoto
		/*
		wp_register_script( 'jquery-pretty', get_template_directory_uri() . '/xt_framework/portfolio/prettyphoto/js/jquery.prettyPhoto.js', 
			array('jquery'), NULL );	
		wp_register_script( 'portfolio-pretty-init', get_template_directory_uri() . '/xt_framework/portfolio/prettyphoto/init.js', 
			array('jquery'), NULL );
		*/

		wp_register_script( 'jquery-pretty', get_template_directory_uri() . '/xt_framework/portfolio/magnific/jquery.magnific-popup.min.js', 
			array('jquery'), NULL );	
		wp_register_script( 'portfolio-pretty-init', get_template_directory_uri() . '/xt_framework/portfolio/magnific/init.js', 
			array('jquery'), NULL );

		// Flexslider

		wp_register_script( 'xt-flexslider-js', get_template_directory_uri() . '/xt_framework/portfolio/flexslider/js/jquery.flexslider-min.js', 
			array( 'jquery' ), '1', true );	

		// jQuery DebouncedResize
		wp_register_script("jquery_debouncedresize", get_template_directory_uri() . '/xt_framework/portfolio/js/jquery.debouncedresize.js', 
			array('jquery') );

		// jQuery Isotope Library
		wp_register_script("xt_portfolio_isotope", get_template_directory_uri() . '/xt_framework/portfolio/js/jquery.isotope.min.js', 
			array('jquery') );

		// Portfolio Init
		wp_register_script("xt_portfolio_init", get_template_directory_uri() . '/xt_framework/portfolio/js/portfolio-init.js', 
			array('xt_portfolio_isotope') );

		// Portfolio Mansory Init
		wp_register_script("xt_portfolio_mansory_init", get_template_directory_uri() . '/xt_framework/portfolio/js/portfolio-mansory-init.js', 
			array('xt_portfolio_isotope') );

		// Portfolio Mansory Init
		wp_register_script("xt_portfolio_mansory_init_shortcodes", 
			get_template_directory_uri() . '/xt_framework/portfolio/js/portfolio-mansory-init-shortcodes.js', 
			array('xt_portfolio_isotope') );

		// Portfolio Shortcodes Init
		wp_register_script("xt_portfolio_shortcodes_init", get_template_directory_uri() . '/xt_framework/portfolio/js/portfolio-shortcodes-init.js', 
			array('xt_portfolio_isotope') );
	}

	add_action('init', 'xt_portfolio_enqueue_scripts');

	/* Dashboard CSS & Scripts */

	function xt_portfolio_admin_style() {

		// Admin Scripts
		wp_enqueue_script('jquery');
		wp_enqueue_script('media-upload');	
		wp_enqueue_script('thickbox');
		
		wp_register_script("xt_upload", get_template_directory_uri() . '/xt_framework/portfolio/js/xt-upload.js',
			array('jquery','media-upload','thickbox') );
		wp_enqueue_script('xt_upload');

		// Admin Stylesheets
		wp_enqueue_style('thickbox');

		wp_register_style( 'xt_portfolio_admin_styles', get_template_directory_uri() . '/xt_framework/portfolio/css/admin_styles.css', false, '1.0.0' );
		wp_enqueue_style( 'xt_portfolio_admin_styles' );

	}
	
	add_action( 'admin_init', 'xt_portfolio_admin_style' );

/*******************
	INSERT IMAGE SIZES
*******************/

add_action("init", "xt_portfolio_image_sizes");

function xt_portfolio_image_sizes() {
	if ( function_exists( 'add_image_size' ) ) { 

		add_image_size( 'xt-portfolio', 480, 9999 );
		add_image_size( 'xt-portfolio-related', 480, 300, true );
		//add_image_size( 'image-cropped', 220, 180, true );

	}
}

/********************
	METABOXES
********************/
	
	add_action("admin_init", "xt_portfolio_metabox");     
      
    function xt_portfolio_metabox() {  
		
		// Portfolio Dropdown at Pages
		$post_id;

		if( isset($_GET['post']) OR isset($_POST['post_ID']) ) :
			
			$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;

			$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

			if( strpos($template_file, 'page-portfolio') !== false)
				
				add_meta_box("xt_portfolio_dropdown", "Select The Portfolio", "xt_portfolio_dropdown", "page", "side", "default");  

        endif; 

		// Single Project Options
		add_meta_box("xt_single_project_options", "Project Settings", "xt_single_project_options", "project", "normal", "high");
	}
      
/* Portfolio Dropdown displayed at Pages */
	  
    function xt_portfolio_dropdown()
	{  
		global $post;  
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;  
		$custom = get_post_custom($post->ID);  
	
		$portfolioType = (isset($custom["portfolio-type"])) ? $custom["portfolio-type"][0] : '';
    ?>  
		<div class="xt-metabox">
		
			<div class="xt-title"><h2>Portfolios</h2></div>

			<?php wp_nonce_field( basename( __FILE__ ), 'xt_portfolio_dropdown_meta_nonce' ); ?>
			
			<div class="xt-input">
				<label>Use this Portfolio:</label>

				<?php
					$portfolioTypes = get_terms("type-portfolio");	
				?>

				<?php if(count($portfolioTypes) > 0) : ?>
				<select name="portfolio-type">
					<?php
					foreach($portfolioTypes as $type) {
						$name = $type->name;
						$selected = '';
						if($name == $portfolioType) $selected = 'selected="selected"';
						
						echo '<option value="'.$name.'" '.$selected.'>'.$name.'</option>';
					}				
					?>
				</select>
				<?php else : ?>
					<span>First, create at least one portfolio.</span>
				<?php endif; ?>
			</div>
			
		</div>
    <?php  
    }  
	
	add_action('save_post', 'xt_portfolio_dropdown_save');   
      
	function xt_portfolio_dropdown_save(){  
		global $post; 
		global $post_id;   

		if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

		if( !isset( $_POST['xt_portfolio_dropdown_meta_nonce'] ) || !wp_verify_nonce( $_POST['xt_portfolio_dropdown_meta_nonce'], basename( __FILE__ ) ) ) return $post_id;

		update_post_meta($post->ID, "portfolio-type", $_POST["portfolio-type"]);
	}  
	
/**************************/
/* Single Project Options */
/**************************/

	function xt_single_project_options()
	{  
		global $post;  
		global $post_id;

		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;  

		// Get post custom fields arrays
		$custom = get_post_custom($post->ID); 

		// Project Type
		$project_type = (isset($custom["project-type"])) ? $custom["project-type"][0] : 'default';

		// External URL
		$external_url = (isset($custom["external-url"])) ? $custom["external-url"][0] : '';

		// Target
		$target = (isset($custom["target"])) ? $custom["target"][0] : '_self';

		// Lightbox Image
		$lightbox_image = (isset($custom["lightbox-image"])) ? $custom["lightbox-image"][0] : '';

		// Vimeo ID
		$vimeo_id = (isset($custom["vimeo-id"])) ? $custom["vimeo-id"][0] : '';

		// Youtube ID
		$youtube_id = (isset($custom["youtube-id"])) ? $custom["youtube-id"][0] : '';

		// Single Project Layout
		$layout = (isset($custom["layout"])) ? $custom["layout"][0] : 'left_sidebar';

		// Enable Related Projects
		$related = (isset($custom["related"])) ? $custom["related"][0] : 'yes';
	?>  

		<div class="xt-metabox">
		
			<div class="xt-title"><h2>Project Settings</h2></div>

			<?php wp_nonce_field( basename( __FILE__ ), 'xt_portfolio_meta_nonce' ); ?>

			<div class="xt-input type-selector">
				<label>Project Type</label>
				<span class="xt-radio">
				<input type="radio" name="project-type" rel="default" value="default"<?php if($project_type == 'default') echo ' checked="checked"'; ?> /> Default
				</span>

				<span class="xt-radio">
				<input type="radio" name="project-type" rel="lightbox" value="lightbox"<?php if($project_type == 'lightbox') echo ' checked="checked"'; ?> /> Lightbox
				</span>

				<span class="xt-radio">
				<input type="radio" name="project-type" rel="vimeo" value="vimeo"<?php if($project_type == 'vimeo') echo ' checked="checked"'; ?> /> Vimeo
				</span>

				<span class="xt-radio">
				<input type="radio" name="project-type" rel="youtube" value="youtube"<?php if($project_type == 'youtube') echo ' checked="checked"'; ?> /> Youtube
				</span>
			</div>

			<div id="xt-default" class="xt-input default-configs"<?php if($project_type != 'default') echo ' style="display: none;"'; ?>>
				<label>Optional External URL</label>
				<input type="text" name="external-url" value="<?php echo $external_url; ?>" />
				<br /><br />
				<label>Link Target</label>
				<select name="target">
					<option value="_self"<?php if($target == '_self') echo ' selected="selected"'; ?>>Same Window</option>
					<option value="_blank"<?php if($target == '_blank') echo ' selected="selected"'; ?>>New Window</option>
				</select>
			</div>

			<div id="xt-lightbox" class="xt-input lightbox-image"<?php if($project_type != 'lightbox') echo ' style="display: none;"'; ?>>
				<div class="xt-preview">
					<?php if($lightbox_image != '') : ?>
					<img src="<?php echo $lightbox_image; ?>" alt="" />
					<?php endif; ?>
				</div>

				<label>Upload large image</label>
				<input type="text" class="upload-admin-input" name="lightbox-image" value="<?php echo $lightbox_image; ?>" /> 
				<input class="button button-primary upload-admin" type="button" value="Upload" />

				<div class="xt-clear"></div>
			</div>

			<div id="xt-vimeo" class="xt-input vimeo-id"<?php if($project_type != 'vimeo') echo ' style="display: none;"'; ?>>
				<label>Vimeo video ID</label>
				<input type="text" name="vimeo-id" value="<?php echo $vimeo_id; ?>" />
			</div>

			<div id="xt-youtube" class="xt-input youtube-id"<?php if($project_type != 'youtube') echo ' style="display: none;"'; ?>>
				<label>Youtube video ID</label>
				<input type="text" name="youtube-id" value="<?php echo $youtube_id; ?>" />
			</div>

			<script type="text/javascript">
				//<![CDATA[
				jQuery(document).ready(function() {

					jQuery('.type-selector input[type="radio"]').change(function() {
						/* hide everybody! */
						jQuery('.lightbox-image, .vimeo-id, .youtube-id, .default-configs').css("display", "none");

						/* show only the selected */
						jQuery('#xt-' + jQuery(this).attr('rel')).css("display", "block");
					});

				});
				//]]>
			</script>

			<div class="single-project-options xt-input">
				<label>Single Project Layout</label>
				<div class="project-layout-selector">
					<input type="radio" name="layout" value="left_sidebar"<?php if($layout == 'left_sidebar') echo ' checked="checked"'; ?> />
					 <img src="<?php echo get_template_directory_uri(); ?>/xt_framework/portfolio/css/img/left_sidebar.png" alt="Left Sidebar Layout" title="Left Sidebar Layout" />
					
					<input type="radio" name="layout" value="right_sidebar"<?php if($layout == 'right_sidebar') echo ' checked="checked"'; ?> />
					 <img src="<?php echo get_template_directory_uri(); ?>/xt_framework/portfolio/css/img/right_sidebar.png" alt="Right Sidebar Layout" title="Right Sidebar Layout" />
					
					<input type="radio" name="layout" value="full"<?php if($layout == 'full') echo ' checked="checked"'; ?> />
					 <img src="<?php echo get_template_directory_uri(); ?>/xt_framework/portfolio/css/img/full.png" alt="Full Layout" title="Full Layout" />
				</div>

				<label>Related Projects?</label>
				<select name="related">
					<option value="yes"<?php if($related == 'yes') echo ' selected="selected"'; ?>>Yes, enable related projects!</option>
					<option value="no"<?php if($related == 'no') echo ' selected="selected"'; ?>>No, remove related projects!</option>
				</select>
			</div> <!-- .single-project-options -->

		</div>
    <?php  
    }  
	
	add_action('save_post', 'xt_single_project_options_save');   

	function xt_single_project_options_save() {  
		global $post;
		global $post_id;

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;  

		if(!isset( $_POST['xt_portfolio_meta_nonce']) || !wp_verify_nonce( $_POST['xt_portfolio_meta_nonce'], basename( __FILE__ ) ) ) return $post_id;

		update_post_meta($post->ID, "project-type", $_POST["project-type"]);

		update_post_meta($post->ID, "external-url", $_POST["external-url"]);

		update_post_meta($post->ID, "target", $_POST["target"]);

		update_post_meta($post->ID, "lightbox-image", $_POST["lightbox-image"]);

		update_post_meta($post->ID, "vimeo-id", $_POST["vimeo-id"]);

		update_post_meta($post->ID, "youtube-id", $_POST["youtube-id"]);

		update_post_meta($post->ID, "related", $_POST["related"]);

		update_post_meta($post->ID, "layout", $_POST["layout"]);
	}

/*******************
	SHORTCODES
*******************/
	
	require_once("shortcodes.php");