<?php
/**
 * Default Function (DO NOT modify)
**/

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

function optionsframework_theme_name() {
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	return $themename;
}

/**
 * XT Options Array
 */

function optionsframework_options() {

	/* Original and Google Fonts */

	$typography_mixed_fonts = array_merge( options_typography_get_os_fonts() , options_typography_get_google_fonts() );
	asort($typography_mixed_fonts);

	/* Layout: Header */



	/* Layout: Content */

		$content_bg = array(
			'color' => '',
			'image' => '',
			'repeat' => 'repeat',
			'position' => 'top center',
			'attachment'=>'scroll' );

	/* Layout: Footer */

		

	/* Layout: Down Footer */

		

	// Image Paths
	$imagepath =  get_template_directory_uri() . '/xt_framework/options/schemes/';

	$options = array();

	/***********************
		SECTION: General Settings
	************************/
	$options[] = array(
		'name' => __('General Settings', 'options_framework_theme'),
		'type' => 'heading');

		// Pages Selector
		$options[] = array(
		'name' => __('Select the Pages', 'options_framework_theme'),
		'desc' => __('Select all the pages that will be used to build the home.', 'options_framework_theme'),
		'id' => 'pages',
		'type' => 'page_selector');

		// Logo
		$options[] = array(
		'name' => __('Logo', 'options_framework_theme'),
		'desc' => __('W  P   L   O  C  K  E  R .C O M - Upload the default logo', 'options_framework_theme'),
		'id' => 'logo',
		'type' => 'upload');

		// Logo Retina
		$options[] = array(
		'name' => __('Logo Retina', 'options_framework_theme'),
		'desc' => __('Upload the optional retina ready logo, upload the double sized logo here', 'options_framework_theme'),
		'id' => 'logo_retina',
		'type' => 'upload');

		/********************/

		// Favicon
		$options[] = array(
		'name' => __('Default Favicon', 'options_framework_theme'),
		'desc' => __('Upload default favicon to desktop and fallback (16x16)', 'options_framework_theme'),
		'id' => 'favicon_default',
		'type' => 'upload');

		// Favicon Non Retina iPhone, iPod Touch
		$options[] = array(
		'name' => __('Non-Retina iPhone, iPod Touch and Android 2.1+ Favicon', 'options_framework_theme'),
		'desc' => __('Upload non-retina favicon to iPhone, iPod Touch and Android 2.1+ (57x57)', 'options_framework_theme'),
		'id' => 'favicon_nonretina_iphone',
		'type' => 'upload');

		// Favicon Non Retina iPad
		$options[] = array(
		'name' => __('Non-Retina iPad Favicon', 'options_framework_theme'),
		'desc' => __('Upload non-retina favicon to iPad (72x72)', 'options_framework_theme'),
		'id' => 'favicon_nonretina_ipad',
		'type' => 'upload');

		// Favicon Retina iPhone
		$options[] = array(
		'name' => __('Retina iPhone Favicon', 'options_framework_theme'),
		'desc' => __('Upload retina favicon to iPhone (114x114)', 'options_framework_theme'),
		'id' => 'favicon_retina_iphone',
		'type' => 'upload');

		// Favicon Retina iPad
		$options[] = array(
		'name' => __('Retina iPad Favicon', 'options_framework_theme'),
		'desc' => __('Upload retina favicon to iPad (144x144)', 'options_framework_theme'),
		'id' => 'favicon_retina_ipad',
		'type' => 'upload');

		/******************/

		$options[] = array(
		'name' => __('Google Analytics Track Code', 'options_framework_theme'),
		'desc' => __('Type your Google Analytics Track code, like: UA-4045XXXX-X. <a href="https://support.google.com/analytics/answer/1008080?hl=en" target="_blank">Help</a>.', 'options_framework_theme'),
		'id' => 'gcode',
		'std' => '', // use something like #2accee
		'type' => 'text' );

	/***********************
		SECTION: Layout
	************************/
	$options[] = array(
		'name' => __('Layout', 'options_framework_theme'),
		'type' => 'heading');

		$options[] = array(
		'name' => __('Disable Responsive Layout?', 'options_framework_theme'),
		'desc' => __('Check this to disable responsiveness', 'options_framework_theme'),
		'id' => 'disable_responsive',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Enable Footer Flags at Header?', 'options_framework_theme'),
		'desc' => __('Only works if WPML plugin is installed.', 'options_framework_theme'),
		'id' => 'wpml_header',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Enable Footer Flags at Footer?', 'options_framework_theme'),
		'desc' => __('Only works if WPML plugin is installed.', 'options_framework_theme'),
		'id' => 'wpml_footer',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Inner Pages Header Height', 'options_framework_theme'),
		'desc' => __('Type the header height when viewing inner pages, like 300px or 100%.', 'options_framework_theme'),
		'id' => 'header_height',
		'std' => '250px', // use something like #2accee
		'type' => 'text' );

	$options[] = array(
		'name' => __('Inner Pages Logo Distance', 'options_framework_theme'),
		'desc' => __('Type the logo margin top when viewing inner pages, like 40px or 20% for example.', 'options_framework_theme'),
		'id' => 'header_logopos',
		'std' => '70px', // use something like #2accee
		'type' => 'text' );

	/***********************
		SECTION: Skins
	************************/
	$options[] = array(
		'name' => __('Skins', 'options_framework_theme'),
		'type' => 'heading');

		$options[] = array(
			'name' => "Default Skins",
			'desc' => "Select a default skin to theme",
			'id' => "default_skin",
			'std' => "default",
			'type' => "images",
			'options' => array(
				'default' => $imagepath . 'default.png',
				'orange' => $imagepath . 'orange.png',
				'green' => $imagepath . 'green.png',
				'blue' => $imagepath . 'blue.png',
				'pink' => $imagepath . 'pink.png',
				'gray' => $imagepath . 'gray.png',
				'red' => $imagepath . 'red.png')
		);

		$options[] = array(
		'name' => __('Custom Base Color', 'options_framework_theme'),
		'desc' => __('Select the base color to build a custom skin.', 'options_framework_theme'),
		'id' => 'base_color',
		'std' => '', // use something like #2accee
		'type' => 'color' );

		$options[] = array(
		'name' => __('Custom Highlight Color', 'options_framework_theme'),
		'desc' => __('Select the highlight color to build a custom skin, this is used to hover colors for example.', 'options_framework_theme'),
		'id' => 'highlight_color',
		'std' => '', // use something like #2accee
		'type' => 'color' );
		
	/***********************
		SECTION: Header
	************************/
	$options[] = array(
		'name' => __('Header', 'options_framework_theme'),
		'type' => 'heading');

		$options[] = array(
		'name' => __('Main Menu', 'options_framework_theme'),
		'desc' => __('Define main menu color.', 'options_framework_theme'),
		'id' => 'main_menu_color',
		'std' => '', // use something like #2accee
		'type' => 'color' );

		$options[] = array( 'name' => 'Main Menu Fonts',
		'desc' => 'Configure the fonts of main menu (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'main_menu_font',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts )
		);

		$options[] = array(
		'name' => __('Main Menu Link Hover', 'options_framework_theme'),
		'desc' => __('Select the color to main menu link in hover status.', 'options_framework_theme'),
		'id' => 'main_menu_link_hover',
		'std' => '', // use something like #2accee
		'type' => 'color' );

		$options[] = array( 'name' => 'Slider Header Font',
		'desc' => 'Configure the fonts of main top slider header (big title) (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'slider_header_font',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts )
		);

		$options[] = array( 'name' => 'Slider Description Font',
		'desc' => 'Configure the fonts of main top slider header (big title) (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'slider_desc_font',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts )
		);

		$options[] = array(
		'name' => __('Facebook Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_fb',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Twitter Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_twitter',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Vimeo Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_vimeo',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Pinterest Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_pinterest',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Github Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_github',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Google+ Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_gplus',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('LinkedIn Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_linkedin',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Youtube Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_youtube',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Blogger Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_blogger',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Tumblr Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_tumblr',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Flickr Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_flickr',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('SoundCloud Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_soundcloud',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Skype Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_skype',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('LastFM Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_lastfm',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Reddit Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_reddit',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Delicious Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_delicious',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('WordPress Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_wordpress',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Spotify Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_spotify',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Yahoo Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_yahoo',
		'std' => '', // use something like #2accee
		'type' => 'text' );

		$options[] = array(
		'name' => __('Evernote Profile URL', 'options_framework_theme'),
		'desc' => __('Type your social profile URL including prefix http:// - leave blank to don\'t display the icon.', 'options_framework_theme'),
		'id' => 'social_evernote',
		'std' => '', // use something like #2accee
		'type' => 'text' );

	/***********************
		SECTION: Theme Parts
	************************/
	$options[] = array(
		'name' => __('Theme Parts', 'options_framework_theme'),
		'type' => 'heading');

		$options[] = array( 'name' => 'Page Title Fonts',
		'desc' => 'Configure the fonts of page title (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'theme_parts_title_font',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts )
		);

		$options[] = array(
		'name' => __('Lead Text Color', 'options_framework_theme'),
		'desc' => __('Define the color of lead text.', 'options_framework_theme'),
		'id' => 'theme_parts_lead',
		'std' => '', // use something like #2accee
		'type' => 'color' );

		$options[] = array(
		'name' => __('Input Forms Background', 'options_framework_theme'),
		'desc' => __('Define the background of inputs, like text fields, textareas and others.', 'options_framework_theme'),
		'id' => 'theme_parts_input_bg',
		'std' => '', // use something like #2accee
		'type' => 'color' );

		$options[] = array(
		'name' => __('Input Forms Border Color', 'options_framework_theme'),
		'desc' => __('Define the border of inputs, like text fields, textareas and others.', 'options_framework_theme'),
		'id' => 'theme_parts_input_border',
		'std' => '', // use something like #2accee
		'type' => 'color' );

		$options[] = array(
		'name' => __('Input Forms Text Color', 'options_framework_theme'),
		'desc' => __('Define the text color of inputs, like text fields, textareas and others.', 'options_framework_theme'),
		'id' => 'theme_parts_input_color',
		'std' => '', // use something like #2accee
		'type' => 'color' );

	/***********************
		SECTION: Content
	************************/
	$options[] = array(
		'name' => __('Content', 'options_framework_theme'),
		'type' => 'heading');

		$options[] = array(
		'name' =>  __('Content Background', 'options_framework_theme'),
		'desc' => __('Define here the content background', 'options_framework_theme'),
		'id' => 'content_bg',
		'std' => $content_bg,
		'type' => 'background' );

		$options[] = array( 'name' => 'Heading 1',
		'desc' => 'Configure the fonts of H1 (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'content_h1',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts)
		);

		$options[] = array( 'name' => 'Heading 2',
		'desc' => 'Configure the fonts of H2 (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'content_h2',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts)
		);

		$options[] = array( 'name' => 'Heading 3',
		'desc' => 'Configure the fonts of H3 (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'content_h3',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts)
		);

		$options[] = array( 'name' => 'Heading 4',
		'desc' => 'Configure the fonts of H4 (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'content_h4',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts)
		);

		$options[] = array( 'name' => 'Heading 5',
		'desc' => 'Configure the fonts of H5 (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'content_h5',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts)
		);

		$options[] = array( 'name' => 'Heading 6',
		'desc' => 'Configure the fonts of H6 (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'content_h6',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts)
		);

		$options[] = array( 'name' => 'Paragraph',
		'desc' => 'Configure the fonts of P (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'content_p',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts)
		);

		$options[] = array( 'name' => 'List',
		'desc' => 'Configure the fonts of list element (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'content_li',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts)
		);

		$options[] = array(
		'name' => __('Content Link', 'options_framework_theme'),
		'desc' => __('Select the color to content link in normal status.', 'options_framework_theme'),
		'id' => 'content_a',
		'std' => '', // use something like #2accee
		'type' => 'color' );

		$options[] = array(
		'name' => __('Content Link Hover', 'options_framework_theme'),
		'desc' => __('Select the color to content link in hover status.', 'options_framework_theme'),
		'id' => 'content_a_hover',
		'std' => '', // use something like #2accee
		'type' => 'color' );

	/***********************
		SECTION: Sidebar
	************************/
	$options[] = array(
		'name' => __('Sidebar', 'options_framework_theme'),
		'type' => 'heading');

		$options[] = array( 'name' => 'Widget Title Fonts',
		'desc' => 'Configure the fonts of widget title (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'sidebar_title_font',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts )
		);

		$options[] = array( 'name' => 'Widget Text Fonts',
		'desc' => 'Configure the fonts of widget text/content (size, font family, style, line height and color).<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'sidebar_font',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts )
		);

		$options[] = array(
		'name' => __('Widget Link Color', 'options_framework_theme'),
		'desc' => __('Select the color of widget links.', 'options_framework_theme'),
		'id' => 'sidebar_a',
		'std' => '', // use something like #2accee
		'type' => 'color' );

		$options[] = array(
		'name' => __('Widget Link Color Hover', 'options_framework_theme'),
		'desc' => __('Select the color of widget links when hovered.', 'options_framework_theme'),
		'id' => 'sidebar_a_hover',
		'std' => '', // use something like #2accee
		'type' => 'color' );

		$options[] = array(
		'name' => __('Input Forms Background', 'options_framework_theme'),
		'desc' => __('Define the background of inputs, like text fields, textareas and others.', 'options_framework_theme'),
		'id' => 'sidebar_input_bg',
		'std' => '', // use something like #2accee
		'type' => 'color' );

		$options[] = array(
		'name' => __('Input Forms Border Color', 'options_framework_theme'),
		'desc' => __('Define the border of inputs, like text fields, textareas and others.', 'options_framework_theme'),
		'id' => 'sidebar_input_border',
		'std' => '', // use something like #2accee
		'type' => 'color' );

		$options[] = array(
		'name' => __('Input Forms Text Color', 'options_framework_theme'),
		'desc' => __('Define the text color of inputs, like text fields, textareas and others.', 'options_framework_theme'),
		'id' => 'sidebar_input_color',
		'std' => '', // use something like #2accee
		'type' => 'color' );

	/***********************
		SECTION: Footer
	************************/
	$options[] = array(
		'name' => __('Footer', 'options_framework_theme'),
		'type' => 'heading');

		$options[] = array(
		'name' => __('Footer Copyright', 'options_framework_theme'),
		'desc' => __('T H E M E   SHA R ED   O N    W  P  L O  C  K  E  R .C OM - Edit here the footer text to be displayed', 'options_framework_theme'),
		'id' => 'footer_copyright',
		'std' => 'Put your copyright text here.',
		'type' => 'textarea');

		$options[] = array( 'name' => 'Footer Text',
		'desc' => 'Configure the fonts of footer text (size, font family, style, line height and color.<br /><strong>Font Family and Font Size are mandatory!</strong><br /><small>Note: almost fonts do not have all the font styles avaliable. Check the avaliable styles at <a href="http://www.google.com/fonts/" target="_blank">Google Webfonts</a>.</small>',
		'id' => 'footer_text',
		'std' => array( 'size' => '', 'face' => '', 'color' => '', 'style' => '', 'line_height' => ''),
		'type' => 'typography',
		'options' => array(
			'faces' => $typography_mixed_fonts)
		);

	/***********************
		SECTION: Custom
	************************/
	$options[] = array(
		'name' => __('Custom', 'options_framework_theme'),
		'type' => 'heading' );

		$options[] = array(
		'name' => __('Custom CSS', 'options_framework_theme'),
		'desc' => __('Write your own Custom CSS rules', 'options_framework_theme'),
		'id' => 'custom_css',
		'std' => '',
		'type' => 'textarea');

	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	/*
	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}
	*/

});
</script>

<?php
}