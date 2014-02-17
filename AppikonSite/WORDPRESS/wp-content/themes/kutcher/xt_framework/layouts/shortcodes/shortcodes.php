<?php
/***************************

	XT LATEST POTS

****************************/

/*-----------------------------------------------------------------------------------*/
/* [xt_latest_posts]
/*-----------------------------------------------------------------------------------*/

function xt_latest_posts($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'show_title' => 'yes',
		'show_meta' => 'yes',
		'columns' => '4',
		'categories' => '',
		'num' => '4',
	), $atts));

	// Enqueue Portfolio Styles
	wp_enqueue_style( 'xt_blog_fonts' );

	// Enqueue Portfolio Scripts
	wp_enqueue_script( 'xt-blog-js' );

	ob_start();

		$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $num,
		'category_name' => $categories
		);
		// get post items
		$query = new WP_Query($args);

		/*********************/
		// Display Projects
		/*********************/

		if($query->have_posts()) : ?>
			<div class="xt-posts-wrapper xt-posts-shortcode xt-posts-shortcode-<?php echo $columns; ?>">
				<?php	
				$count = 1;
				$mob_count = 1;
				while ( $query->have_posts() ) : $query->the_post();
				?>

					<?php
						// print correct class
						$_class = '';

						if($count == 1)
							$_class = 'post-first';

						if($count == $columns) {
							$_class = 'post-last';
							$count = 0;
						}

						$_mobclass = '';

						if($mob_count == 1)
							$_mobclass = 'post-odd';

						if($mob_count == 2)
							$_mobclass = 'post-even';

						// get project type

						$permalink = get_permalink();
						$title_permalink = get_permalink();
						$title_target = '';

						// get custom post info
						$_type = get_post_format();
						if( false === $_type )
							$_type = 'standard';

						$_icon = '<span><i class="blog-icon-doc-text"></i></span>';

						if($_type == 'image') {
							$_icon = '<span><i class="blog-icon-camera"></i></span>';
						}
						else if($_type == 'gallery') {
							$_icon = '<span><i class="blog-icon-picture"></i></span>';
						}
						else if($_type == 'link') {
							$_icon = '<span><i class="blog-icon-link"></i></span>';
						}
						else if($_type == 'quote') {
							$_icon = '<span><i class="blog-icon-quote"></i></span>';
						}
						else if($_type == 'video') {
							$_icon = '<span><i class="blog-icon-video"></i></span>';
						}
						else if($_type == 'audio') {
							$_icon = '<span><i class="blog-icon-note-beamed"></i></span>';
						}

					?>

					<?php
						$_tmpclass = 'four';
						if($columns == 3) $_tmpclass = 'three';
						if($columns == 2) $_tmpclass = 'two';
					?>
					<div class="post-item post-<?php echo $_tmpclass; ?> <?php echo $_class; ?> <?php echo $_mobclass; ?>">
						<div class="post-item-wrapper">
							<?php if( has_post_thumbnail() ) : ?>	
								<div class="thumbnail">
									<a href="<?php echo $permalink; ?>">
										<?php the_post_thumbnail('latest-posts-size', array('title' => get_the_title(), 'class' => '') ); ?>
										<div class="xt-post-hover">
											<?php echo $_icon; ?>
										</div>
									</a>
								</div> <!-- .thumbnail -->
							<?php endif; ?>

							<?php if($show_meta == 'yes' OR $show_title == 'yes') : ?>
								<div class="post-infos">

									<?php if($show_title == 'yes') { ?>
									<div class="post-title"><h1><a href="<?php echo $title_permalink; ?>"><?php the_title(); ?></a></h1></div>
									<?php } // show title? end ?>

									<?php if($show_meta == 'yes') { ?>
											<div class="post-meta">

											<span class="date"><?php echo get_the_date(); ?></span>
											 / 
											 <span class="comments"><a href="<?php comments_link(); ?>"><?php comments_number( __('No Comments', 'kutcher'), __('1 Comment', 'kutcher'), __('% Comments', 'kutcher') ); ?></a></span>

											</div>

									<?php } // show meta ? end ?>

								</div> <!-- .post-infos -->
							<?php endif; ?>

						</div> <!-- .post-item-wrapper -->
					</div> <!-- .post-item -->

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
			<div class="xt-clear"></div>
		<?php
		endif; // End IF $query have_posts()

		wp_reset_query();

	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}
add_shortcode('xt_latest_posts', 'xt_latest_posts');

/*-----------------------------------------------------------------------------------*/
/* [xt_latest_posts_list]
/*-----------------------------------------------------------------------------------*/

function xt_latest_posts_list($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'show_title' => 'yes',
		'show_meta' => 'yes',
		'show_excerpt' => 'yes',
		'excerpt_chars' => 200,
		'categories' => '',
		'num' => '4',
	), $atts));

	// Enqueue Portfolio Styles
	wp_enqueue_style( 'xt_blog_fonts' );

	ob_start();

		$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $num,
		'category_name' => $categories
		);
		// get post items
		$query = new WP_Query($args);

		/*********************/
		// Display Projects
		/*********************/

		if($query->have_posts()) : ?>
			<div class="xt-posts-list-wrapper xt-posts-list-shortcode">
				<?php	
				while ( $query->have_posts() ) : $query->the_post();
				?>

					<?php
						$permalink = get_permalink();

						// get custom post info
						$_type = get_post_format();
						if( false === $_type )
							$_type = 'standard';

						$_icon = '<span><i class="blog-icon-doc-text"></i></span>';

						if($_type == 'image') {
							$_icon = '<span><i class="blog-icon-camera"></i></span>';
						}
						else if($_type == 'gallery') {
							$_icon = '<span><i class="blog-icon-picture"></i></span>';
						}
						else if($_type == 'link') {
							$_icon = '<span><i class="blog-icon-link"></i></span>';
						}
						else if($_type == 'quote') {
							$_icon = '<span><i class="blog-icon-quote"></i></span>';
						}
						else if($_type == 'video') {
							$_icon = '<span><i class="blog-icon-video"></i></span>';
						}
						else if($_type == 'audio') {
							$_icon = '<span><i class="blog-icon-note-beamed"></i></span>';
						}

					?>

					<?php
					?>
					<div class="post-item">
						<div class="post-item-wrapper">

							<div class="post-format-icon">
								<?php echo $_icon; ?>
							</div>

							<?php if($show_meta == 'yes' OR $show_title == 'yes' OR $show_excerpt == 'yes') : ?>
								<div class="post-infos">

									<?php if($show_title == 'yes') { ?>
									<div class="post-title"><h1><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h1></div>
									<?php } // show title? end ?>

									<?php if($show_meta == 'yes') { ?>
											<div class="post-meta">

											<span class="date"><?php echo get_the_date(); ?></span>
											 / 
											 <span class="comments"><a href="<?php comments_link(); ?>"><?php comments_number( __('No Comments', 'kutcher'), __('1 Comment', 'kutcher'), __('% Comments', 'kutcher') ); ?></a></span>

											</div>

									<?php } // show meta ? end ?>

									<?php if($show_excerpt == 'yes') { ?>
										<?php if(get_the_excerpt() != '') :

											$_exc = get_the_excerpt();
											if(strlen($_exc) > $excerpt_chars)
												$_exc = substr($_exc, 0, $excerpt_chars).'...';

											?>
											<div class="post-excerpt"><?php echo '<p>'. $_exc .'</p>'; ?></div>
										<?php endif; ?>
									<?php } // show excerpt ? end ?>

									<div class="read-more">
										<a href="<?php the_permalink(); ?>"><?php _e("Read More...", 'kutcher'); ?></a>
									</div>

								</div> <!-- .post-infos -->

							<?php endif; ?>

							<div class="clear clearboth xt-clear"></div>

						</div> <!-- .post-item-wrapper -->
					</div> <!-- .post-item -->

				<?php
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
add_shortcode('xt_latest_posts_list', 'xt_latest_posts_list');