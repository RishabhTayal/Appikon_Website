<?php
	get_header(); // get the header.php file	
?>

	<?php

			// Get posts IDs from backend
			$theme_pages_ids_opts = of_get_option('pages');

			$menuLeft = '';

			if($theme_pages_ids_opts != '') :

			$theme_pages_ids_opts = substr_replace( $theme_pages_ids_opts, "", -1); // Removes last char of Ids, the ; in the case

			$theme_pages_ids_opts = explode(";", $theme_pages_ids_opts);

			foreach ($theme_pages_ids_opts as $id) {
				$id = explode(',', $id);

				if(function_exists('icl_object_id'))
					$id[0] = icl_object_id($id[0], 'page', false);

				$theme_pages_ids[] = $id[0];

				$theme_pages_external[ $id[0] ] = $id[1];	
			}

			//var_dump($theme_pages_ids);
			//var_dump($theme_pages_external);

			$theme_pages_args = array( 'post__in' => $theme_pages_ids, 'post_type' => 'page', 'orderby' => 'post__in',
				'posts_per_page' => -1 );
			$theme_pages_posts = new WP_Query( $theme_pages_args );

			$currentPage = 0; // 0 => first
			$parallaxCounter = 0;
			$tweetCounter = 0;

			while( $theme_pages_posts->have_posts() ) : $theme_pages_posts->the_post();

				if($theme_pages_external[get_the_ID()] != 'y' ) :

					$slug = get_the_slug();
					$title = get_the_title();
					$link = '#'.$slug;

					$template = get_post_meta( get_the_ID(), '_wp_page_template', true );

					if($template != 'page-templates/page-content-contact.php') :
				?>
					<?php

						// Parallax Type
						$parallax_type = get_post_meta( get_the_ID(), 'parallax-type', true );
						$parallax_status = get_post_meta( get_the_ID(), 'parallax-status', true );
						$parallax_ID = get_the_ID();
					?>

						<div class="page-block" id="<?php echo $slug; ?>-menu" name="<?php echo $slug; ?>-menu">
							<div class="container">
							
								<?php
									if($template == 'default') :
								?>
									<div class="one-single-title">
										<h1><?php the_title(); ?></h1>
									</div> <!-- .one-single-title -->
								
									<div class="the-content">

										<?php if(!empty($post->post_excerpt)) : ?>
											<p class="lead" style="margin-bottom: 45px;"><?php echo get_the_excerpt(); ?></p>
										<?php endif; ?>

										<?php the_content(); ?>	
									</div> <!-- .the-content -->

								<?php
									else : ?>

									<?php
									$template_part = str_replace('page-templates/', '', $template);
									$template_part = str_replace('.php', '', $template_part);
											
									$template_part = explode('-', $template_part, 2);
											
									get_template_part("page-templates/".$template_part[0], $template_part[1]);
									?>

								<?php endif; ?>
								
							</div> <!-- end container -->
						</div>  <!-- .one-single-block -->
						
						<div class="clearboth xt-clear clear"></div>

					<?php else : // Else if $template != contact.php ?>

						<div class="contact-block" id="<?php echo $slug; ?>-menu" name="<?php echo $slug; ?>-menu">
							<div class="pattern"></div>
							<div class="container">
								<div class="sixteen columns">
								<div class="card">
									<h1 class="white"><?php the_title(); ?></h1>
									<?php
									$template_part = str_replace('page-templates/', '', $template);
									$template_part = str_replace('.php', '', $template_part);
											
									$template_part = explode('-', $template_part, 2);
											
									get_template_part("page-templates/".$template_part[0], $template_part[1]);
									?>

								</div>
								</div>
							</div>
						</div>

					<?php endif; // end if $template != contact.php ?>

					<?php if($parallax_status == '' && $template != 'page-templates/page-content-contact.php') : 
					?>

					<!-- Start Parallax Background -->	
					<div id="parallax<?php echo $parallaxCounter; ?>" class="parallax-block">
						<div class="bg bg<?php echo $parallaxCounter; ?>"></div>
						<div class="pattern"></div>
						<div class="container parallax-<?php echo $parallax_type; ?>">
							<div class="vertical-wrapper">
								<div class="vertical-text">

								<?php
									// QUOTE TYPE

									if($parallax_type == 'quote') {
										$quote_content = get_post_meta( $parallax_ID, 'quote-content', true );
										$quote_author = get_post_meta( $parallax_ID, 'quote-author', true );
										//var_dump(get_post_meta( $parallax_ID ) );
									?>

									<p class="prlx-quote"><?php echo $quote_content; ?></p>
									
									<?php if($quote_author != '') : ?>
										<div class="prlx-author"><?php echo $quote_author; ?></div>
									<?php endif; ?>

								<?php
									} ?>

								<?php
									// QUOTE TYPE

									if($parallax_type == 'tweet') { 

										$twitter_acc = get_post_meta( $parallax_ID, 'twitter-acc', true );
									?>

									<div class="sixteen columns">
										<div class="vertical-text">
											<div class="tweet-parallax" id="lasttweet<?php echo $tweetCounter; ?>">
												<?php echo do_shortcode('[rotatingtweets screen_name="xiaothemes" include_rts="1" tweet_count="1" no_rotate="1" show_follow="1" show_meta_via="0" show_meta_screen_name="0"]'); ?>
											</div>
										</div>
									</div>

								<?php
										$tweetCounter++;
									} ?>

								<?php
									// QUOTE TYPE

									if($parallax_type == 'rich') { 
										$rich_parallax = get_post_meta( $parallax_ID, 'parallax_custom_content', true );
									?>

										<?php
										remove_filter('the_content', 'xt_the_content_filter', 99);

										echo apply_filters('the_content', $rich_parallax);

										add_filter( 'the_content', 'xt_the_content_filter', 99);
										?>


								<?php
									} ?>

								</div>
							</div> <!-- .vertical-wrapper -->
						</div>
					</div>
					<!-- End Parallax Background -->
					<?php
						$parallaxCounter++;
					endif; // parallax activated!
					?>

			<?php
					
					$currentPage++;
				endif; // if $pTemplate !- 'external'

			endwhile;

			wp_reset_postdata();

		endif; // if $theme_pages_ids != ''
	?>


<?php
	get_footer(); // get the footer.php file	
?>