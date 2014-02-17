<?php
/*****************
	XT Portfolio 3 Columns Layout
******************/

	// get portfolio selected to this page
	$portfolioType = get_post_meta($post->ID, 'portfolio-type', true);

	// get project items from the portfolio selected
	$query = new WP_Query(array('post_type' => 'project', 'posts_per_page' => -1, 'type-portfolio' => $portfolioType));

	// get filters
	$filters = get_terms("filter-portfolio");
	
	if( count($filters) > 0 ) :
		?>

		<div class="xt-filters-wrapper">
			<ul class="xt-filters">
				<li><i class="icon-reorder"></i></li>
				<li><a class="current" href="#" data-filter="*"><?php _e("All", 'kutcher'); ?></a></li>
				<?php
					foreach ( $filters as $filter ) {
						$filterName = strtolower($filter->name);
						$filterName = str_replace(' ', '-', $filterName);
								
						echo '<li><a href="#'.$filterName.'" data-filter=".'.$filterName.'">'.$filter->name.'</a></li>';
					}
				?>
			</ul>
		</div> <!-- .xt-filters-wrapper -->

		<!-- The script below just remove the NOT used Filters, the ones that don't have items linked to the filter -->
		<script type="text/javascript">
			jQuery(document).ready(function() {
								
				jQuery(".xt-filters-wrapper a").each( function(e, i) {
					var attr = jQuery(this).attr("data-filter");
									
					if(jQuery(attr).length <= 0) {
						jQuery('.xt-filters-wrapper a[data-filter="'+attr+'"]').parent().remove();
					}
				});	

			});
		</script>

		<?php
	endif; // end filters IF

	/*********************/
	// Display Projects
	/*********************/

	if($query->have_posts()) : ?>
		<div class="xt-projects-wrapper xt-isotope">
			<?php	
			$count = 1;
			while ( $query->have_posts() ) : $query->the_post();
			?>

				<?php
				// get filters to the project
				$filters = get_the_terms(get_the_ID(), "filter-portfolio");

				// filter classes
				$filterClasses = '';

				// filter pritable to show to users
				$filterPrintable = "";

				if ( $filters && ! is_wp_error( $filters ) ) : 
					$ids = array();
					$cats = array();
					foreach ( $filters as $filter ) {
						$cats[] = $filter->name;
						$ids[] = strtolower($filter->name);
					}
						$ids = str_replace(' ', '-', $ids);	

						// join ids in a single string
						$filterClasses = join( " ", $ids );

						// join IDs splitted by comma
						$filterPrintable = join( ", ", $cats);
					endif;							
				?>

				<?php
					// print correct class
					$_class = '';

					if($count == 1)
						$_class = 'project-first';

					if($count == 4) {
						$_class = 'project-last';
						$count = 0;
					}

					// get project type

					$permalink = get_permalink();
					$title_permalink = get_permalink();
					$title_target = '';

					// get custom post info
					$_type = get_post_meta($post->ID, 'project-type', true);
					$_icon = '<span><i class="xt-portfolio-icon-plus-circle"></i></span>';
					$_target = '';
					$_rel = '';
					$mfp = '';

					if($_type == 'default') {
						$external = get_post_meta($post->ID, 'external-url', true);
						if($external != '')
							$permalink = $title_permalink = $external;
						$_target = $title_target = ' target="'.get_post_meta($post->ID, 'target', true).'"';
						$_rel = '';
					}
					else if($_type == 'lightbox') {
						// change icon
						$_icon = '<span><i class="xt-portfolio-icon-picture"></i></span>';

						$largeImg = get_post_meta($post->ID, 'lightbox-image', true);
						$permalink = $largeImg;
						$_rel = ' rel="portfolio-prettyPhoto"';
						$mfp = 'mfp-image';
					}
					else if($_type == 'vimeo') {
						// change icon
						$_icon = '<span><i class="xt-portfolio-icon-video"></i></span>';

						$vimeo = get_post_meta($post->ID, 'vimeo-id', true);
						$permalink = 'http://vimeo.com/'.$vimeo;
						$_rel = ' rel="portfolio-prettyPhoto"';
						$mfp = 'mfp-iframe';
					}
					else if($_type == 'youtube') {
						// change icon
						$_icon = '<span><i class="xt-portfolio-icon-video"></i></span>';

						$youtube = get_post_meta($post->ID, 'youtube-id', true);
						$permalink = 'http://www.youtube.com/watch?v='.$youtube;
						$_rel = ' rel="portfolio-prettyPhoto"';
						$mfp = 'mfp-iframe';
					}

				?>
				<div class="project-item project-four <?php echo $_class; ?> <?php echo $filterClasses; ?>">
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

						<div class="project-infos">
							<div class="project-title"><h1><a href="<?php echo $title_permalink; ?>"<?php echo $title_target; ?>><?php the_title(); ?></a></h1></div>
							<?php if(get_the_excerpt() != '') : ?>
								<div class="project-excerpt"><?php echo '<p>'.get_the_excerpt().'</p>'; ?></div>
							<?php endif; ?>
						</div> <!-- .project-infos -->
					</div> <!-- .project-item-wrapper -->
				</div> <!-- .project-item -->

			<?php
				// increase counter
				$count++;
			endwhile;
			?>

			<div class="xt-clear"></div>
		</div> <!-- .xt-projects-wrapper -->
	<?php
	endif; // End IF $query have_posts()