<?php
	// get related filters
	$terms = get_the_terms( get_the_ID() , 'filter-portfolio');

	// get possible portfolios
	$portfolios = array();

	$terms_portfolio = get_the_terms( get_the_ID() , 'type-portfolio');
	if(!empty($terms_portfolio)) {
		foreach ($terms_portfolio as $term_portfolio) {
			$portfolios[] = $term_portfolio->slug;
		}
		$portfolios = implode(",", $portfolios);
	}

	$do_not_duplicate[] = get_the_ID();

	// if found something
	if(!empty($terms)) {
		//var_dump($terms_portfolio);
?>

<div class="single-project-related">
	<div class="xt-related-headline">
		<h1><?php _e('Related Projects', 'kutcher'); ?></h1>
	</div>

	<div class="xt-projects-wrapper xt-related-wrapper">

	<?php
	$max = 0;
	$count = 1;
	$mob_count = 1;
	foreach ($terms as $term) {
		if($max < 4) :
			query_posts( array(
				'filter-portfolio' => $term->slug,
				'type-portfolio' => $portfolios,
				'showposts' => 4,
				'posts_per_page' => 4,
				'ignore_sticky_posts' => 1,
				'post__not_in' => $do_not_duplicate ) );
					
			if(have_posts()){
				
				while ( have_posts() == true && $max < 4 ) : the_post(); $do_not_duplicate[] = get_the_ID(); ?>

						<?php
							// print correct class
							$_class = '';

							if($count == 1)
								$_class = 'project-first';

							if($count == 4) {
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
							$permalink_title = get_permalink();

							// get custom post info
							$_type = get_post_meta(get_the_ID(), 'project-type', true);
							$_icon = '<span><i class="xt-portfolio-icon-plus-circle"></i></span>';
							$_target = '';
							$_rel = '';
							$mfp = '';

							if($_type == 'default') {
								$external = get_post_meta(get_the_ID(), 'external-url', true);
								if($external != '')
									$permalink = $permalink_title = $external;
								$_target = ' target="'.get_post_meta(get_the_ID(), 'target', true).'"';
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
						<div class="project-item project-four <?php echo $_class; ?> <?php echo $_mobclass; ?>">
							<div class="project-item-wrapper">
								<?php if( has_post_thumbnail() ) : ?>	
									<div class="thumbnail">
										<a href="<?php echo $permalink; ?>"<?php echo $_target; ?><?php echo $_rel; ?> class="<?php echo $mfp; ?>">
											<?php the_post_thumbnail('xt-portfolio-related', array('title' => get_the_title(), 'class' => '') ); ?>
											<div class="xt-project-hover">
												<?php echo $_icon; ?>
											</div>
										</a>
									</div> <!-- .thumbnail -->
								<?php endif; ?>

								<div class="project-infos">
									<div class="project-title"><h1><a href="<?php echo $permalink_title; ?>"<?php echo $_target; ?>><?php the_title(); ?></a></h1></div>
									<?php if(get_the_excerpt() != '') : ?>
										<div class="project-excerpt"><?php echo '<p>'.get_the_excerpt().'</p>'; ?></div>
									<?php endif; ?>
								</div> <!-- .project-infos -->
							</div> <!-- .project-item-wrapper -->
						</div> <!-- .project-item -->

					<?php
						// increase counter
						$count++;

						$mob_count++;
						if($mob_count > 2) {
							$mob_count = 1;
							echo '<div class="xt-mob-clear"></div>';
						}
					?>

					<?php $max++; ?>
				<?php 
				endwhile; 
				wp_reset_query();


			} // have_posts if
		endif; // max < 4
	} // foreach

	echo '<div class="xt-clear"></div>
		</div>';

	echo '
		<script type="text/javascript">
			jQuery(document).ready(function() {

				jQuery(".project-item .thumbnail a").hover(function() {
					jQuery(this).find(".xt-project-hover").fadeIn("fast");
				}, function() {
					jQuery(this).find(".xt-project-hover").fadeOut("fast");
				});

			});
		</script>
		';
	?>

</div> <!-- .single-project-related -->

<?php
	}
?>