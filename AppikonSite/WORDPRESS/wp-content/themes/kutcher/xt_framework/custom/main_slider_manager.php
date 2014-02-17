<?php

	// Custom file to declarate main slider manager

	add_action('init', 'xt_main_slide_custom_init');  

	function xt_main_slide_custom_init()
	{

	  $labels = array(
		'name' => _x('Slides', 'post type general name', 'xt-main-slider'),
		'singular_name' => _x('Slide', 'post type singular name', 'xt-main-slider'),
		'add_new' => _x('New Slide', 'project', 'xt-main-slider'),
		'add_new_item' => __('Add New Slide', 'xt-main-slider'),
		'edit_item' => __('Edit Slide', 'xt-main-slider'),
		'new_item' => __('New Slide', 'xt-main-slider'),
		'view_item' => __('View Slide', 'xt-main-slider'),
		'search_items' => __('Search Slides', 'xt-main-slider'),
		'not_found' =>  __('No slides found', 'xt-main-slider'),
		'not_found_in_trash' => __('No slides found in Trash', 'xt-main-slider'),
		'parent_item_colon' => '',
		'menu_name' => __('Full Slides', 'xt-main-slider')

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
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail', 'page-attributes')
	  );

	 // Register Post Type
	  register_post_type('main-slide',$args);
	}
	
	// Change default WP messages when user saves a project, filter or portfolio

	add_filter('post_updated_messages', 'xt_main_slide_updated_messages');
	
	function xt_main_slide_updated_messages( $messages ) {
	  global $post, $post_ID;

	  $messages['project'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Slide updated. <a href="%s">View project</a>', 'xt-main-slider'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'xt-main-slider'),
		3 => __('Custom field deleted.', 'xt-main-slider'),
		4 => __('Slide updated.', 'xt-main-slider'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Slide restored to revision from %s', 'xt-main-slider'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Slide published. <a href="%s">View project</a>', 'xt-main-slider'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Slide saved.', 'xt-main-slider'),
		8 => sprintf( __('Slide submitted. <a target="_blank" href="%s">Preview slide</a>', 'xt-main-slider'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Slide scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Slide</a>', 'xt-main-slider'),
		  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Slide draft updated. <a target="_blank" href="%s">Preview Slide</a>', 'xt-main-slider'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  );

	  return $messages;
	}

	// Display slides JS var to be used in the file

	function xt_main_slides_display() {
		?>
		<script type="text/javascript">
			var XT_MAIN_SLIDES = '';
		<?php
			$main_slides = new WP_Query( array( 'post_status' => 'publish', 'post_type' => 'main-slide', 'posts_per_page' => -1, 'suppress_filters' => false ) );
			if($main_slides->have_posts()) :
				echo 'XT_MAIN_SLIDES = [';
				$slides = '';
				while( $main_slides->have_posts() ) : $main_slides->the_post();

					$image_id = get_post_thumbnail_id();
					$image_url = wp_get_attachment_image_src($image_id, 'full');
					$image_url = $image_url[0];

					$title = get_the_title();

					$slides .= "\n{image : '".$image_url."', title : '".$title." <div class=\"slidedescription\">".str_replace("'", "&#39;", do_shortcode(get_the_content()) )."</div>', thumb : '', url : ''},";
				endwhile;
				echo substr($slides, 0, -1);
				echo '];';
			endif;
			wp_reset_query();
		?>
		</script>
		<?php
	}

	add_action('wp_head', 'xt_main_slides_display');