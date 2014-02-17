<?php

	/// WIDGETS
						
	function rich_text($content) {
	
		$content = stripslashes($content);
		
		/*
		remove_filter('the_content', 'my_the_content_filter');

		$content = apply_filters("the_content", $content);

		add_filter( 'the_content', 'my_the_content_filter' );
		*/

		return $content;
	}
	
	function divider_line($content) {

		$content = stripslashes($content);

		return do_shortcode($content);
	}

	function divider_dotted($content) {

		$content = stripslashes($content);

		return do_shortcode($content);
	}

	function divider_shadow($content) {

		$content = stripslashes($content);

		return do_shortcode($content);
	}

	function divider_vertical_line($content) {

		$content = stripslashes($content);

		return do_shortcode($content);
	}
	
	function divider_empty($content) {

		$content = stripslashes($content);
		
		return do_shortcode($content);
	}
						
?>