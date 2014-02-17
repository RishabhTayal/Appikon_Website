<?php

	/* Fields to check custom Google Fonts */

	global $_gfontFields;

	$_gfontFields = array(
		'main_menu_font',
		'sub_menu_font',
		'content_h1',
		'content_h2',
		'content_h3',
		'content_h4',
		'content_h5',
		'content_h6',
		'content_p',
		'footer_text',
		'slider_header_font',
		'slider_desc_font',
		'theme_parts_title_font',
		'sidebar_title_font',
		'sidebar_font',
	);

	require_once('font_list.php');
	
	/**
	 * Checks font options to see if a Google font is selected.
	 * If so, options_typography_enqueue_google_font is called to enqueue the font.
	 * Ensures that each Google font is only enqueued once.
	 */
	if ( !function_exists( 'options_typography_google_fonts' ) ) {
		function options_typography_google_fonts() {

			global $_gfontFields;

			$all_google_fonts = array_keys( options_typography_get_google_fonts() );
			// Define all the options that possibly have a unique Google font
			/*
			$google_font = of_get_option('google_font', 'Rokkitt, serif');
			$google_mixed = of_get_option('google_mixed', false);
			$google_mixed_2 = of_get_option('google_mixed_2', 'Arvo, serif');
			*/
			// Get the font face for each option and put it in an array
			/*
			$selected_fonts = array(
				$google_font['face'],
				$google_mixed['face'],
				$google_mixed_2['face'] );
				*/

			$selected_fonts = array();

			foreach ($_gfontFields as $font) {
				$fontField = of_get_option($font, false);

				$selected_fonts[] = $fontField['face'];				
			}

			// Remove any duplicates in the list
			$selected_fonts = array_unique($selected_fonts);
			// Check each of the unique fonts against the defined Google fonts
			// If it is a Google font, go ahead and call the function to enqueue it
			foreach ( $selected_fonts as $font ) {
				if ( in_array( $font, $all_google_fonts ) ) {
					options_typography_enqueue_google_font($font);
				}
			}
		}
	}
	add_action( 'wp_enqueue_scripts', 'options_typography_google_fonts' );
	/**
	 * Enqueues the Google $font that is passed
	 */
	function options_typography_enqueue_google_font($font) {
		$font = explode(',', $font);
		$font = $font[0];
		// Certain Google fonts need slight tweaks in order to load properly
		// Like our friend "Raleway"
		if ( $font == 'Raleway' )
			$font = 'Raleway:100';
		$font = str_replace(" ", "+", $font);
		wp_enqueue_style( "options_typography_$font", "http://fonts.googleapis.com/css?family=$font:300,400,700,400italic,700italic,100,900", false, null, 'all' );
	}