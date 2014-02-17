<?php
/*
 *	Print style at wp_head hook with all custom changes made! *
*/

add_action('wp_head', 'xt_print_custom_head_styles', 99);
function xt_print_custom_head_styles() {
	?>
	<style type="text/css">
		/* Logo CSS rule */

		#logo {
			display: none;
		}

		<?php if(of_get_option('logo') != '') : ?>
			#logo {
				background-image: url('<?php echo of_get_option('logo'); ?>');
				background-repeat: no-repeat;
				overflow: hidden;
				text-indent: -9999px;

				<?php 
					$logo = str_replace(' ', '%20', of_get_option('logo'));
					list($width, $height) = @getimagesize( $logo ) ;
				?>

				width: <?php echo $width; ?>px;
				height: <?php echo $height; ?>px;
				display: block;
			}
		<?php endif; ?>

		<?php if(of_get_option('logo_retina') != '') : ?>
			@media all and (-webkit-min-device-pixel-ratio: 1.5) {
				#logo {
					background-image: url('<?php echo of_get_option('logo_retina'); ?>');
					background-size: <?php echo $width; ?>px <?php echo $height; ?>px;
				}
			}
		<?php endif; ?>

		/* Header Inner and Logo Position */

		#homepage {
			height: <?php echo of_get_option('header_height'); ?>;
		}

		.logo {
			top: <?php echo of_get_option('header_logopos'); ?>;
		}
	</style>
	<?php
}

add_action('wp_footer', 'xt_print_custom_styles', 99);
function xt_print_custom_styles() {
	?>
	<style type="text/css">

		/* Main Background */

		<?php xt_printBg('body_bg', 'body'); ?>

		/* Color Schemes */
		<?php

		$_baseColor = '';
		$_darkerColor = '';
		$_lighterColor = '';

		if( of_get_option('default_skin') != 'default' ) :
			// Orange
			if( of_get_option('default_skin') == 'orange') {
				$_baseColor = '#1c1f26';
				$_darkerColor = '#000108';
				$_lighterColor = '#f44f1d';
			}
			// Green
			else if( of_get_option('default_skin') == 'green') {
				$_baseColor = '#1c1f26';
				$_darkerColor = '#000108';
				$_lighterColor = '#9cc93b';
			}
			// Blue
			else if( of_get_option('default_skin') == 'blue') {
				$_baseColor = '#1c1f26';
				$_darkerColor = '#000108';
				$_lighterColor = '#529cda';
			}
			// Pink
			else if( of_get_option('default_skin') == 'pink') {
				$_baseColor = '#1c1f26';
				$_darkerColor = '#000108';
				$_lighterColor = '#e49fec';
			}
			// Gray
			else if( of_get_option('default_skin') == 'gray') {
				$_baseColor = '#1c1f26';
				$_darkerColor = '#000108';
				$_lighterColor = '#cacaca';
			}
			// Red
			else if( of_get_option('default_skin') == 'red') {
				$_baseColor = '#1c1f26';
				$_darkerColor = '#000108';
				$_lighterColor = '#e44343';
			}

		endif; // default skin IF

		// Custom Base color
		if( of_get_option('base_color') != '') {
			$_baseColor = of_get_option('base_color');
			$_darkerColor = xt_getColor($_baseColor, -30);
			//$_lighterColor = xt_getColor($_baseColor, 60);
		}

		if( of_get_option('highlight_color') != '') {
			$_lighterColor = of_get_option('highlight_color');
		}

		?>

		/* Scheme Specific Styles */

		<?php if( $_baseColor != '' ) : ?>

			/*===========================
				Skins
			============================*/

				.my-wrapper nav {
					background: rgba(<?php echo xt_hex2rgb($_baseColor); ?>, 0.85);
				}

				#lang-logo-selector-inner {
					background: rgba(<?php echo xt_hex2rgb($_baseColor); ?>, 0.6);
				}

				#lang_sel_footer {
					background: <?php echo $_baseColor; ?>;
				}

				.links a.to-top i {
					background: <?php echo xt_getColor($_baseColor, 80); ?>;
				}

				.social-icons li a {
					background: <?php echo xt_getColor($_baseColor, 40); ?>;
				}

				.social-icons li a:hover {
					background: <?php echo $_lighterColor; ?>;
				}

				body,
				.links a.to-top i,
				.post-title a,
				.pages li a.current,
				.navigation a.previous, .navigation a.next,
				body .post.post-large .post-details .post-infos .post-title h1 a,
				body .post.post-large .post-details .post-infos .post-title h1 a:visited,
				body .post.post-medium .post-details .post-infos .post-title h1 a,
				body .post.post-medium .post-details .post-infos .post-title h1 a:visited,
				body .post-single .post-details .post-infos .post-title h1 a,
				body .post-single .post-details .post-infos .post-title h1 a:visited,
				body .navigation a:hover, .navigation a.active,
				body .navigation .page-arrows .prev,
				body .navigation .page-arrows .next,
				body .comments .blog_comment_det .blog_comment_name_det a,
				.post-navigation a,
				body .accordions .accordion-title a, body .toggle .toggle-title a,
				body .accordions .accordion-title a:after, body .toggle .toggle-title a:after,
				body .member-block .member-social .zocial-icon-wrap,
				body .block-font-icon .block-icon-wrapper .icon-wrap:hover i, body .block-font-icon .block-icon-wrapper .icon-wrap:hover [class^="font-icon-"]:before,
				.page-block input[type="text"]:focus,
				.page-block input[type="password"]:focus,
				.page-block input[type="email"]:focus,
				.page-block textarea:focus,
				body .wpcf7-form input[type="text"]:focus,
				body .wpcf7-form input[type="password"]:focus,
				body .wpcf7-form input[type="email"]:focus,
				body .wpcf7-form textarea:focus,
				body .xt-column-pricing h1,
				body .xt-column-pricing h2,
				body .xt-column-pricing h3,
				body .xt-posts-wrapper .post-item .post-infos h1 a, body .post-item .post-infos h1 a:visited,
				body .xt-posts-list-wrapper .post-item .post-infos .post-title h1 a,
				.project-item .project-infos h1 a, .project-item .project-infos h1 a:visited,
				.the-content h1, .the-content h2, .the-content h3, .the-content h4, .the-content h5, .the-content h6  {
					color: <?php echo $_baseColor; ?>;
				}

				a,
				.container .overlay-content.social-icons li a,
				.option-set li a.selected,
				.option-set li a:hover,
				.post-title a:hover,
				.post-tags li a:hover,
				.tags-list li a:hover,
				a.twfd-author:hover,
				body .post.post-large .post-details .post-infos .post-title h1 a:hover,
				body .post.post-medium .post-details .post-infos .post-title h1 a:hover,
				body .post-single .post-details .post-infos .post-title h1 a:hover,
				body .post.post-large .post-details .post-meta span a,
				body .post.post-medium .post-meta span a,
				body .post-single .post-details .post-meta span a,
				.sidebar .widget a:hover,
				body .xt-filters-wrapper ul.xt-filters li a:hover, body .xt-filters-wrapper ul.xt-filters li a.current,
				body .cats-arch-tags-widget .panes ul li a:hover, .links a:hover,
				body .tp-caption.very-big,
				.links a:hover, .links.more-than-six a:hover {
					color: <?php echo $_lighterColor; ?>;
				}

				/* Backgrounds & Borders */

				::-moz-selection {background: <?php echo $_lighterColor; ?>;color: #ffffff; }
				::selection {background: <?php echo $_lighterColor; ?>;color: #ffffff; }

				.overlay,
				.post-navigation a:hover,
				body .button.button-default:hover,
				body .xt-column-pricing .button.button:hover,
				body .button.button-default:focus,
				body .xt-column-pricing .button.button:focus,
				body .skill-bar .skill-wrapper .skill-progress,
				body .member-block .member-social .zocial-icon-wrap:hover,
				.page-block input[type="submit"]:hover,
				body .widget_ns_mailchimp input[type="submit"]:hover,
				body .wpcf7-form input[type="submit"]:hover,
				body .xt-posts-list-wrapper .post-item .post-format-icon span,
				.widget .tagcloud a:hover,
				body .tp-caption.default-heading,
				body .button.button.button-default.button-normal:hover {
					background: <?php echo $_lighterColor; ?>;
					border-color: <?php echo $_lighterColor; ?>;
					color: #ffffff;
				}

				body .navigation .page-arrows a:hover {
					background: <?php echo $_lighterColor; ?>;
					border-color: <?php echo $_lighterColor; ?>;
				}

				body .xt_tabs_framed_container .panes {
					border-color: <?php echo $_lighterColor; ?>;
				}

				body .navigation .page-numbers a {
					border-color: <?php echo $_lighterColor; ?>;
				}

				body .sidebar .widget_nav_menu .menu li.current-menu-item a {
					background-color: <?php echo $_baseColor; ?>;
					border-color: <?php echo $_baseColor; ?>;
				}

				body .post.post-large .post-details .post-format-icon,
				body .post.post-large .post-details .post-format-icon span,
				body .post.post-medium .side-post .post-format-icon,
				body .post-single .post-details .post-format-icon span,
				body .button.button-default,
				body .button.button-default:active,
				body .button,
				body .xt-column-pricing .button.button, 
				body .button:active,
				body .xt-column-pricing .button.button:active,
				body ul.xt_tabs_button a,
				.page-block input[type="submit"], 
				body .widget_ns_mailchimp input[type="submit"],
				.page-block input[type="submit"]:active,
				body .widget_ns_mailchimp input[type="submit"]:active,
				body .wpcf7-form input[type="submit"],
				body .wpcf7-form input[type="submit"]:active {
					background: <?php echo $_baseColor; ?>;
					border-color: <?php echo $_baseColor; ?>;
				}

				body .post-single .post-tags p a:hover, body .post-single .share-post .share-icons a:hover,
				body .comments .blog_comment_user span,
				body .accordions .accordion-title.accordion-active a, body .toggle .toggle-title.toggle-active a,
				body ul.xt_tabs_framed li.current a,
				body ul.xt_tabs_button a:hover,
				body ul.xt_tabs_button li.current a,
				body ul.xt_tabs_vertical li.current a,
				body .xt-column-pricing .pricing-top {
					background: <?php echo $_lighterColor; ?>;
					border-color: <?php echo $_lighterColor; ?>;
				}

				body #respond input[type="submit"], body #respond input[type="submit"]:active, body #respond input[type="submit"]:hover {
					background: <?php echo $_baseColor; ?> !important;
				}

				body #respond input[type="submit"]:hover {
					background: <?php echo $_lighterColor; ?> !important;
				}

				body .project-item .thumbnail .xt-project-hover,
				body .project-media .xt-project-hover,
				body .post .thumbnail .post-thumb-hover {
					background: rgba(<?php echo xt_hex2rgb($_lighterColor); ?>, 0.6);
				}

				body .accordions .accordion-title a:hover, body .toggle .toggle-title a:hover,
				body ul.xt_tabs_framed a:hover,
				body ul.xt_tabs_vertical a:hover {
					background: <?php echo $_lighterColor; ?>;
				}

				.zocial-icon-wrap:hover, body .card .zocial-icon-wrap:hover, body .card .zocial-icon-wrap.zocial-twitter-2:hover {
					background: <?php echo $_lighterColor; ?>;
				}

				body .callout-box, body .callout-box.callout-minimal, body .blockquote blockquote, body blockquote {
					border-color: <?php echo $_lighterColor; ?>;
				}

		<?php endif; ?>

		/*===========================
			Header 
		===========================*/

			<?php if( of_get_option('main_menu_color') != '' ) : 

				$_mainMenuBg = of_get_option('main_menu_color');
			?>

			.my-wrapper nav {
				background: rgba(<?php echo xt_hex2rgb($_mainMenuBg); ?>, 0.85);
			}

			.links a.to-top i {
				background: <?php echo xt_getColor($_mainMenuBg, 45); ?>;
			}

			.social-icons li a {
				background: <?php echo xt_getColor($_mainMenuBg, -30); ?>;
			}

			.social-icons li a:hover {
				background: <?php echo xt_getColor($_mainMenuBg, 45); ?>;
			}

			<?php endif; ?>

			<?php xt_printFont('main_menu_font', '.links a, .links.more-than-six a'); ?>

			<?php xt_printColor('main_menu_link_hover', '.links a:hover'); ?>

			<?php xt_printFont('slider_header_font', '#slidecaption'); ?>
			<?php xt_printFont('slider_desc_font', '.slidedescription'); ?>

		/*===========================
			Theme Parts
		===========================*/

			<?php xt_printFont('theme_parts_title_font', '.page-block .one-single-title h1, .page .one-single-title h1, .single-project .one-single-title h1, .entry-header h1'); ?>
			<?php xt_printColor('theme_parts_lead', 'p.lead, .the-content p.lead'); ?>

			<?php xt_printColorBg('theme_parts_input_bg', 'body .wpcf7-form input[type="text"], body .wpcf7-form input[type="password"], 
				body .wpcf7-form input[type="email"], body .wpcf7-form textarea, body .wpcf7-form select, body #respond input[type="text"], 
				body #respond textarea, .page-block input[type="text"], .page-block input[type="password"], .page-block input[type="email"], 
				.page-block textarea, .page-block select, body .wpcf7-form input[type="text"]:focus, body .wpcf7-form input[type="password"]:focus, 
				body .wpcf7-form input[type="email"]:focus, body .wpcf7-form textarea:focus, body .wpcf7-form select:focus, body #respond input[type="text"]:focus, 
				body #respond textarea:focus, .page-block input[type="text"]:focus, .page-block input[type="password"]:focus, .page-block input[type="email"]:focus, 
				.page-block textarea:focus, .page-block select:focus'); ?>

			<?php xt_printColor('theme_parts_input_color', 'body .wpcf7-form input[type="text"], body .wpcf7-form input[type="password"], 
				body .wpcf7-form input[type="email"], body .wpcf7-form textarea, body .wpcf7-form select, body #respond input[type="text"], 
				body #respond textarea, .page-block input[type="text"], .page-block input[type="password"], .page-block input[type="email"], 
				.page-block textarea, .page-block select, body .wpcf7-form input[type="text"]:focus, body .wpcf7-form input[type="password"]:focus, 
				body .wpcf7-form input[type="email"]:focus, body .wpcf7-form textarea:focus, body .wpcf7-form select:focus, body #respond input[type="text"]:focus, 
				body #respond textarea:focus, .page-block input[type="text"]:focus, .page-block input[type="password"]:focus, .page-block input[type="email"]:focus, 
				.page-block textarea:focus, .page-block select:focus'); ?>

			<?php xt_printColorBorder('theme_parts_input_border', 'body .wpcf7-form input[type="text"], body .wpcf7-form input[type="password"], 
				body .wpcf7-form input[type="email"], body .wpcf7-form textarea, body .wpcf7-form select, body #respond input[type="text"], 
				body #respond textarea, .page-block input[type="text"], .page-block input[type="password"], .page-block input[type="email"], 
				.page-block textarea, .page-block select, body .wpcf7-form input[type="text"]:focus, body .wpcf7-form input[type="password"]:focus, 
				body .wpcf7-form input[type="email"]:focus, body .wpcf7-form textarea:focus, body .wpcf7-form select:focus, body #respond input[type="text"]:focus, 
				body #respond textarea:focus, .page-block input[type="text"]:focus, .page-block input[type="password"]:focus, .page-block input[type="email"]:focus, 
				.page-block textarea:focus, .page-block select:focus'); ?>

		/*===========================
			Sidebar
		===========================*/

			<?php xt_printFont('sidebar_title_font', '.sidebar .widget .widgettitle'); ?>
			<?php xt_printFont('sidebar_font', '.sidebar .widget, .sidebar .widget p, .sidebar .widget .textwidget, .sidebar .widget ul li, .sidebar .widget ol li'); ?>

			<?php xt_printColor('sidebar_a', '.sidebar .widget a, .sidebar .widget a:visited'); ?>
			<?php xt_printColor('sidebar_a_hover', '.sidebar .widget a:hover'); ?>

		/*===========================
			Content 
		===========================*/

			<?php xt_printBg('content_bg', '.page-block'); ?>

			<?php xt_printFont('content_h1', '.the-content h1'); ?>
			<?php xt_printFont('content_h2', '.the-content h2'); ?>
			<?php xt_printFont('content_h3', '.the-content h3'); ?>
			<?php xt_printFont('content_h4', '.the-content h4'); ?>
			<?php xt_printFont('content_h5', '.the-content h5'); ?>
			<?php xt_printFont('content_h6', '.the-content h6'); ?>
			<?php xt_printFont('content_p', '.the-content p'); ?>
			<?php xt_printFont('content_li', '.the-content li'); ?>

			<?php xt_printColor('content_a', '.the-content a'); ?>
			<?php xt_printColor('content_a_hover', '.the-content a:hover'); ?>

			<?php xt_printColorBg('sidebar_input_bg', '.sidebar .widget input, .sidebar .widget select, .sidebar .widget textarea,
				.sidebar .widget input:focus, .sidebar .widget select:focus, .sidebar .widget textarea:focus'); ?>

			<?php xt_printColor('sidebar_input_color', '.sidebar .widget input, .sidebar .widget select, .sidebar .widget textarea,
				.sidebar .widget input:focus, .sidebar .widget select:focus, .sidebar .widget textarea:focus'); ?>

			<?php xt_printColorBorder('sidebar_input_border', '.sidebar .widget input, .sidebar .widget select, .sidebar .widget textarea,
				.sidebar .widget input:focus, .sidebar .widget select:focus, .sidebar .widget textarea:focus'); ?>

		/*===========================
			Footer
		===========================*/

			<?php xt_printFont('footer_text', '.copyright p, .archive .copyright p, .single .copyright p, .page .copyright p, .error404 .copyright p'); ?>

		/*===========================
			Custom CSS
		===========================*/

		<?php echo of_get_option('custom_css'); ?>

	</style>
	<?php
}

/*
 * Print BG CSS Rule
*/

function xt_printBg($field, $selector) {
	$field = of_get_option($field);

	if($field['color'] OR $field['image'] != '') :

		echo $selector . ' {';

			$bg = '';

			if($field['image'] != '')
				$bg = 'url("'.$field['image'].'")';

			echo 'background: '.$field['color'].' '.$bg.' '.$field['repeat'].' '.$field['attachment'].' '.$field['position'].';';

		echo '}';

	endif;
}

/*
 * Print Font CSS Rule
*/

function xt_printFont($field, $selector) {
	$field = of_get_option($field);

	$color = '';

	$rules = '';

	// Rules

	if($field['line_height'] != '') $field['line_height'] = '/'.$field['line_height'];

	if($field['face'] != '' && $field['size'] != '') :
		
		$rules .= 'font: '.$field['style'].' '.$field['size'].$field['line_height'].' '.$field['face'].';';

	elseif($field['face'] == '' && $field['size'] != '') :

		$rules .= 'font-size: '.$field['size'].';';

	elseif($field['size'] == '' && $field['face'] != '') :

		$rules .= 'font-family: '.$field['face'].';';
	
	endif;

	if($field['color'] != '') :
		
		$rules .= 'color: '.$field['color']. ';';
	
	endif;

	if($rules != '') 
		echo $selector . ' { '.$rules.' }';
}

function xt_printColor($field, $selector) {
	$field = of_get_option($field);

	if($field != '') :

		echo $selector . ' {';

			echo 'color: '.$field.';';

		echo '}';

	endif;
}

function xt_printColorBg($field, $selector) {
	$field = of_get_option($field);

	if($field != '') :

		echo $selector . ' {';

			echo 'background-color: '.$field.';';

		echo '}';

	endif;
}

function xt_printColorBorder($field, $selector) {
	$field = of_get_option($field);

	if($field != '') :

		echo $selector . ' {';

			echo 'border-color: '.$field.';';

		echo '}';

	endif;
}

/*
 *	Color Adjusts to get sub levels of color
 */

function xt_getColor($hex, $steps) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max(-255, min(255, $steps));

	// Format the hex color string
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) {
		$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
	}

	// Get decimal values
	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));

	// Adjust number of steps and keep it inside 0 to 255
	$r = max(0,min(255,$r + $steps));
	$g = max(0,min(255,$g + $steps));
	$b = max(0,min(255,$b + $steps));

	$r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
	$g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
	$b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

	return '#'.$r_hex.$g_hex.$b_hex;
}

function xt_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}