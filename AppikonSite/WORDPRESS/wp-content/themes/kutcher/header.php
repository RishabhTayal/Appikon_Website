<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Favicons -->

		<?php if( of_get_option('favicon_default') != '' ) : ?>
		<!-- Default Favicon -->
		<link href="<?php echo of_get_option('favicon_default'); ?>" rel="icon" type="image/x-icon" />
		<?php endif; ?>

		<?php if( of_get_option('favicon_retina_ipad') != '' ) : ?>
		<!-- For third-generation iPad with high-resolution Retina display: -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo of_get_option('favicon_retina_ipad'); ?>">
		<?php endif; ?>

		<?php if( of_get_option('favicon_retina_iphone') != '' ) : ?>
		<!-- For iPhone with high-resolution Retina display: -->
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo of_get_option('favicon_retina_iphone'); ?>">
		<?php endif; ?>

		<?php if( of_get_option('favicon_nonretina_ipad') != '' ) : ?>
		<!-- For first- and second-generation iPad: -->
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo of_get_option('favicon_nonretina_ipad'); ?>">
		<?php endif; ?>

		<?php if( of_get_option('favicon_nonretina_iphone') != '' ) : ?>
		<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
		<link rel="apple-touch-icon-precomposed" href="<?php echo of_get_option('favicon_nonretina_iphone'); ?>">
		<?php endif; ?>

	<!-- Title-->
	<title><?php
		global $page, $paged;

		wp_title( '-', true, 'right' );
		bloginfo( 'name' );

		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " - $site_description";
	?></title>

	<!-- Meta -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php if(of_get_option('disable_responsive') == false) : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php endif; ?>
	
	<!-- Utils -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<script type="text/javascript">
		var THEME_DIR = '<?php echo THEME_DIR; ?>';
	</script>
	
	<!-- WP_Head -->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
	<!-- Start Homepage -->
	<div id="homepage">
		
		<div class="container">
			<div class="sixteen columns">
				<a id="logo" class="logo" href="<?php echo wpml_get_home_url(); ?>"><?php echo get_bloginfo('name'); ?></a>
				<?php if( of_get_option('wpml_header') ) : ?>
					<div id="lang-logo-selector">
						<span id="lang-logo-selector-inner">
							<?php language_selector_flags(); ?>
						</span>
					</div>
				<?php endif; ?>
			</div>
			
			<div class="slider-text">
				<div class="sixteen columns">
					<div class="line"></div>
				</div>
				
				<div class="twelve columns">
					<div id="slidecaption"></div>
				</div>
				
				<div class="four columns">
					<?php if( wp_count_posts( 'main-slide' )->publish > 1 ) : ?> 
						<a id="prevslide" class="load-item"><i class="icon-chevron-left"></i></a>
						<a id="nextslide" class="load-item"><i class="icon-chevron-right"></i></a>
					<?php endif; ?>
				</div>
			</div>
			
		</div>
	</div>
	<!-- End Homepage -->
	
	
	<!-- Start Navigation -->
	<nav>
	
		<div class="container">
			
			<div class="twelve columns">
				
				<?php

					// Get posts IDs from backend
					$theme_pages_ids_opts = of_get_option('pages');
					//var_dump($theme_pages_ids_opts);

					$menuLeft = '';
					$classNumber = '';

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

						$menuCounter = 0;

						while( $theme_pages_posts->have_posts() ) : $theme_pages_posts->the_post();

							$slug = get_the_slug().'-menu';
							$title = get_the_title();
							$link = '#'.$slug;

							/* Custom Title */
							$cTitle = get_post_meta( get_the_ID(), 'menu-name', true );
							if($cTitle != '')
								$title = $cTitle;

							// If the page is external, remove the # anchor
							if($theme_pages_external[get_the_ID()] == 'y' )
								$link = get_permalink();

							// If we're in a single page, single post (blog or post), remove the #
							if(!is_front_page() && $theme_pages_external[get_the_ID()] != 'y')
								$link =  wpml_get_home_url() .'#'.$slug;

							$menuCode = '<li><a href="'.$link.'">'.$title.'</a></li>';

							$menuLeft .= $menuCode;

							$menuCounter++;
						endwhile;

						if($menuCounter > 6)
							$classNumber = ' more-than-six';

						wp_reset_postdata();

					endif;
				?>

				<!-- Start Nav Links -->
				<ul id="nav" class="links<?php echo $classNumber; ?>">
					<?php echo $menuLeft; ?>
					<li><a class="to-top" href="#homepage"><i class="icon-chevron-up"></i><span><?php _e('Home', 'kutcher'); ?></span></a></li>
				</ul>
				<!-- End Nav Links -->
				
			</div>
			
			<div class="three columns">
			
				<!-- Social Icons -->	
				<ul class="social-icons">

					<?php if(of_get_option('social_fb') != '') : ?>
						<li><a href="<?php echo of_get_option('social_fb'); ?>" target="_blank"><i class="icon-facebook"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_twitter') != '') : ?>
						<li><a href="<?php echo of_get_option('social_twitter'); ?>" target="_blank"><i class="icon-twitter"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_vimeo') != '') : ?>
						<li><a href="<?php echo of_get_option('social_vimeo'); ?>" target="_blank"><i class="icon-vimeo"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_pinterest') != '') : ?>
						<li><a href="<?php echo of_get_option('social_pinterest'); ?>" target="_blank"><i class="icon-pinterest"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_github') != '') : ?>
						<li><a href="<?php echo of_get_option('social_github'); ?>" target="_blank"><i class="icon-github"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_gplus') != '') : ?>
						<li><a href="<?php echo of_get_option('social_gplus'); ?>" target="_blank"><i class="icon-google-plus"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_linkedin') != '') : ?>
						<li><a href="<?php echo of_get_option('social_linkedin'); ?>" target="_blank"><i class="icon-linkedin"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_youtube') != '') : ?>
						<li><a href="<?php echo of_get_option('social_youtube'); ?>" target="_blank"><i class="icon-youtube"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_skype') != '') : ?>
						<li><a href="<?php echo of_get_option('social_skype'); ?>" target="_blank"><i class="icon-skype"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_lastfm') != '') : ?>
						<li><a href="<?php echo of_get_option('social_lastfm'); ?>" target="_blank"><i class="icon-lastfm"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_reddit') != '') : ?>
						<li><a href="<?php echo of_get_option('social_reddit'); ?>" target="_blank"><i class="icon-reddit"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_delicious') != '') : ?>
						<li><a href="<?php echo of_get_option('social_delicious'); ?>" target="_blank"><i class="icon-delicious-sign"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_wordpress') != '') : ?>
						<li><a href="<?php echo of_get_option('social_wordpress'); ?>" target="_blank"><i class="icon-wordpress"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_blogger') != '') : ?>
						<li><a href="<?php echo of_get_option('social_blogger'); ?>" target="_blank"><i class="icon-blogger"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_tumblr') != '') : ?>
						<li><a href="<?php echo of_get_option('social_tumblr'); ?>" target="_blank"><i class="icon-tumblr"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_flickr') != '') : ?>
						<li><a href="<?php echo of_get_option('social_flickr'); ?>" target="_blank"><i class="icon-flickr"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_soundcloud') != '') : ?>
						<li><a href="<?php echo of_get_option('social_soundcloud'); ?>" target="_blank"><i class="icon-soundcloud"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_spotify') != '') : ?>
						<li><a href="<?php echo of_get_option('social_spotify'); ?>" target="_blank"><i class="icon-spotify"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_yahoo') != '') : ?>
						<li><a href="<?php echo of_get_option('social_yahoo'); ?>" target="_blank"><i class="icon-yahoo"></i></a></li>
					<?php endif; ?>
					<?php if(of_get_option('social_evernote') != '') : ?>
						<li><a href="<?php echo of_get_option('social_evernote'); ?>" target="_blank"><i class="icon-evernote"></i></a></li>
					<?php endif; ?>

				</ul>
				<!-- End Icons -->
			
			</div>
		
		</div>
	
	</nav>
	<!-- End Navigation -->	
