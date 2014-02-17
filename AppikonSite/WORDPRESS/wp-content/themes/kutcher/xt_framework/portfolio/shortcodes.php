<?php
/***************************

	XT LATEST PROJECTS SHORTCODES

****************************/

/*-----------------------------------------------------------------------------------*/
/* [xt_latest_projects]
/*-----------------------------------------------------------------------------------*/

function xt_latest_projects($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'show_title' => 'yes',
		'show_excerpt' => 'yes',
		'columns' => '3',
		'categories' => '',
		'excerpt_chars'=> 80,
		'num' => '4',
		'portfolio' => '',
		'offset' => '0'
	), $atts));

	// Enqueue Portfolio Styles
	wp_enqueue_style( 'pretty-style' );
	wp_enqueue_style( 'xt_portfolio_fonts' );
	wp_enqueue_style( 'xt_portfolio_styles' );

	// Enqueue Portfolio Scripts
	wp_enqueue_script( 'jquery-pretty' );
	wp_enqueue_script( 'portfolio-pretty-init' );
	wp_enqueue_script( 'xt_portfolio_shortcodes_init' );

	ob_start();

		// get portfolio selected to this page
		$portfolioType = '';

		// get project items from the portfolio selected
		$query = new WP_Query(array('post_type' => 'project', 'posts_per_page' => $num, 'offset' => $offset,
		'type-portfolio' => $portfolio, 'filter-portfolio' => $categories));

		/*********************/
		// Display Projects
		/*********************/

		if($query->have_posts()) : ?>
			<div class="xt-projects-wrapper xt-projects-shortcode xt-projects-shortcode-<?php echo $columns; ?>">
				<?php	
				$count = 1;
				$mob_count = 1;
				while ( $query->have_posts() ) : $query->the_post();
				?>

					<?php
						// print correct class
						$_class = '';

						if($count == 1)
							$_class = 'project-first';

						if($count == $columns) {
							$_class = 'project-last';
							$count = 0;
						}

						$_mobclass = '';

						if($mob_count == 1)
							$_mobclass = 'project-odd';

						if($mob_count == 2)
							$_mobclass = 'project-even';

						// get project type

						$permalink = get_permalink();
						$title_permalink = get_permalink();
						$title_target = '';

						// get custom post info
						$_type = get_post_meta(get_the_ID(), 'project-type', true);
						$_icon = '<span><i class="xt-portfolio-icon-plus-circle"></i></span>';
						$_target = '';
						$_rel = '';
						$mfp = '';

						if($_type == 'default') {
							$external = get_post_meta(get_the_ID(), 'external-url', true);
							if($external != '')
								$permalink = $title_permalink = $external;
							$_target = $title_target = ' target="'.get_post_meta(get_the_ID(), 'target', true).'"';
							$_rel = '';
						}
						else if($_type == 'lightbox') {
							// change icon
							$_icon = '<span><i class="xt-portfolio-icon-picture"></i></span>';

							$largeImg = get_post_meta(get_the_ID(), 'lightbox-image', true);
							$permalink = $largeImg;
							$_rel = ' rel="portfolio-prettyPhoto"';
							$mfp = 'mfp-image';
						}
						else if($_type == 'vimeo') {
							// change icon
							$_icon = '<span><i class="xt-portfolio-icon-video"></i></span>';

							$vimeo = get_post_meta(get_the_ID(), 'vimeo-id', true);
							$permalink = 'http://vimeo.com/'.$vimeo;
							$_rel = ' rel="portfolio-prettyPhoto"';
							$mfp = 'mfp-iframe';
						}
						else if($_type == 'youtube') {
							// change icon
							$_icon = '<span><i class="xt-portfolio-icon-video"></i></span>';

							$youtube = get_post_meta(get_the_ID(), 'youtube-id', true);
							$permalink = 'http://www.youtube.com/watch?v='.$youtube;
							$_rel = ' rel="portfolio-prettyPhoto"';
							$mfp = 'mfp-iframe';
						}

					?>

					<?php
						$_tmpclass = 'four';
						if($columns == 3) $_tmpclass = 'three';
						if($columns == 2) $_tmpclass = 'two';
					?>
					<div class="project-item project-<?php echo $_tmpclass; ?> <?php echo $_class; ?> <?php echo $_mobclass; ?>">
						<div class="project-item-wrapper">
							<?php if( has_post_thumbnail() ) : ?>	
								<div class="thumbnail">
									<a href="<?php echo $permalink; ?>"<?php echo $_target; ?><?php echo $_rel; ?> class="<?php echo $mfp; ?>">
										<?php the_post_thumbnail('xt-portfolio', array('title' => get_the_title(), 'class' => '') ); ?>
										<div class="xt-project-hover">
											<?php echo $_icon; ?>
										</div>
									</a>
								</div> <!-- .thumbnail -->
							<?php endif; ?>

							<?php if($show_excerpt == 'yes' OR $show_title == 'yes') : ?>
								<div class="project-infos">

									<?php if($show_title == 'yes') { ?>
									<div class="project-title"><h1><a href="<?php echo $title_permalink; ?>"<?php echo $title_target; ?>><?php the_title(); ?></a></h1></div>
									<?php } // show title? end ?>

									<?php if($show_excerpt == 'yes') { ?>
										<?php if(get_the_excerpt() != '') :

											$_exc = get_the_excerpt();
											if(strlen($_exc) > $excerpt_chars)
												$_exc = substr($_exc, 0, $excerpt_chars).'...';

											?>
											<div class="project-excerpt"><?php echo '<p>'. $_exc .'</p>'; ?></div>
										<?php endif; ?>
									<?php } // show excerpt ? end ?>

								</div> <!-- .project-infos -->
							<?php endif; ?>

						</div> <!-- .project-item-wrapper -->
					</div> <!-- .project-item -->

				<?php
					if($count == 0)
						echo '<div class="xt-clear"></div>';

					// increase counter
					$mob_count++;
					if($mob_count > 2) {
						$mob_count = 1;
						echo '<div class="xt-mob-clear"></div>';
					}

					$count++;
				endwhile;
				?>

				<div class="xt-clear"></div>
			</div> <!-- .xt-projects-wrapper -->
		<?php
		endif; // End IF $query have_posts()

		wp_reset_query();

	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
add_shortcode('xt_latest_projects', 'xt_latest_projects');

/*-----------------------------------------------------------------------------------*/
/* [xt_latest_projects_mansory]
/*-----------------------------------------------------------------------------------*/

function xt_latest_projects_mansory($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'show_title' => 'yes',
		'show_excerpt' => 'yes',
		'columns' => '3',
		'categories' => '',
		'excerpt_chars'=> 0,
		'num' => '4',
		'portfolio' => '',
		'offset' => '0'
	), $atts));

	// Enqueue Portfolio Styles
	wp_enqueue_style( 'pretty-style' );
	wp_enqueue_style( 'xt_portfolio_fonts' );
	wp_enqueue_style( 'xt_portfolio_styles' );

	// Enqueue Portfolio Scripts
	wp_enqueue_script( 'jquery-pretty' );
	wp_enqueue_script( 'portfolio-pretty-init' );
	wp_enqueue_script( 'jquery_debouncedresize' );
	wp_enqueue_script( 'xt_portfolio_isotope' );
	wp_enqueue_script( 'xt_portfolio_mansory_init_shortcodes' );

	ob_start();

		// get portfolio selected to this page
		$portfolioType = '';

		// get project items from the portfolio selected
		$query = new WP_Query(array('post_type' => 'project', 'posts_per_page' => $num, 'offset' => $offset,
		'type-portfolio' => $portfolio, 'filter-portfolio' => $categories));

		/*********************/
		// Display Projects
		/*********************/

		if($query->have_posts()) : ?>
			<div class="xt-projects-wrapper xt-projects-wrapper-mansory">
				<?php	
				$count = 1;
				$mob_count = 1;
				while ( $query->have_posts() ) : $query->the_post();
				?>

					<?php
						// print correct class
						$_class = '';

						if($count == 1)
							$_class = 'project-first';

						if($count == $columns) {
							$_class = 'project-last';
							$count = 0;
						}

						$_mobclass = '';

						if($mob_count == 1)
							$_mobclass = 'project-odd';

						if($mob_count == 2)
							$_mobclass = 'project-even';

						// get project type

						$permalink = get_permalink();
						$title_permalink = get_permalink();
						$title_target = '';

						// get custom post info
						$_type = get_post_meta(get_the_ID(), 'project-type', true);
						$_icon = '<span><i class="xt-portfolio-icon-plus-circle"></i></span>';
						$_target = '';
						$_rel = '';
						$mfp = '';

						if($_type == 'default') {
							$external = get_post_meta(get_the_ID(), 'external-url', true);
							if($external != '')
								$permalink = $title_permalink = $external;
							$_target = $title_target = ' target="'.get_post_meta(get_the_ID(), 'target', true).'"';
							$_rel = '';
						}
						else if($_type == 'lightbox') {
							// change icon
							$_icon = '<span><i class="xt-portfolio-icon-picture"></i></span>';

							$largeImg = get_post_meta(get_the_ID(), 'lightbox-image', true);
							$permalink = $largeImg;
							$_rel = ' rel="portfolio-prettyPhoto"';
							$mfp = 'mfp-image';
						}
						else if($_type == 'vimeo') {
							// change icon
							$_icon = '<span><i class="xt-portfolio-icon-video"></i></span>';

							$vimeo = get_post_meta(get_the_ID(), 'vimeo-id', true);
							$permalink = 'http://vimeo.com/'.$vimeo;
							$_rel = ' rel="portfolio-prettyPhoto"';
							$mfp = 'mfp-iframe';
						}
						else if($_type == 'youtube') {
							// change icon
							$_icon = '<span><i class="xt-portfolio-icon-video"></i></span>';

							$youtube = get_post_meta(get_the_ID(), 'youtube-id', true);
							$permalink = 'http://www.youtube.com/watch?v='.$youtube;
							$_rel = ' rel="portfolio-prettyPhoto"';
							$mfp = 'mfp-iframe';
						}

					?>

					<?php
						$_tmpclass = 'four';
						if($columns == 3) $_tmpclass = 'three';
						if($columns == 2) $_tmpclass = 'two';
					?>
					<div class="project-item project-<?php echo $_tmpclass; ?> <?php echo $_class; ?> <?php echo $_mobclass; ?>">
						<div class="project-item-wrapper">
							<?php if( has_post_thumbnail() ) : ?>	
								<div class="thumbnail">
									<a href="<?php echo $permalink; ?>"<?php echo $_target; ?><?php echo $_rel; ?> class="<?php echo $mfp; ?>">
										<?php the_post_thumbnail('xt-portfolio', array('title' => get_the_title(), 'class' => '') ); ?>
										<div class="xt-project-hover">
											<?php echo $_icon; ?>
										</div>
									</a>
								</div> <!-- .thumbnail -->
							<?php endif; ?>

							<?php if($show_excerpt == 'yes' OR $show_title == 'yes') : ?>
								<div class="project-infos">

									<?php if($show_title == 'yes') { ?>
									<div class="project-title"><h1><a href="<?php echo $title_permalink; ?>"<?php echo $title_target; ?>><?php the_title(); ?></a></h1></div>
									<?php } // show title? end ?>

									<?php if($show_excerpt == 'yes') { ?>
										<?php if(get_the_excerpt() != '') :

											$_exc = get_the_excerpt();
											if(strlen($_exc) > $excerpt_chars && $excerpt_chars != 0)
												$_exc = substr($_exc, 0, $excerpt_chars).'...';

											?>
											<div class="project-excerpt"><?php echo '<p>'. $_exc .'</p>'; ?></div>
										<?php endif; ?>
									<?php } // show excerpt ? end ?>

								</div> <!-- .project-infos -->
							<?php endif; ?>

						</div> <!-- .project-item-wrapper -->
					</div> <!-- .project-item -->

				<?php
					if($count == 0)
						echo '<div class="xt-clear"></div>';

					// increase counter
					$mob_count++;
					if($mob_count > 2) {
						$mob_count = 1;
						echo '<div class="xt-mob-clear"></div>';
					}

					$count++;
				endwhile;
				?>

				<div class="xt-clear"></div>
			</div> <!-- .xt-projects-wrapper -->
		<?php
		endif; // End IF $query have_posts()

		wp_reset_query();

	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
add_shortcode('xt_latest_projects_mansory', 'xt_latest_projects_mansory');