	<?php
     
    $galleryID = rand(0, 1000);

    $args = array(
		'post_type' => 'attachment',
		'numberposts' => -1,
		'post_status' => null,
		'post_parent' => get_the_ID(),
		'orderby' => 'menu_order',
		'order' => 'ASC',
	);
																				  
	$attachments = get_posts( $args );
																				  
	if ( $attachments ) : ?>

		<div class="flexslider thumbnail post-gallery">
			<ul class="slides">
					<?php
						foreach ( $attachments as $attachment ) {
							$thumb = wp_get_attachment_image_src($attachment->ID, 'blog-size');
							$large = wp_get_attachment_image_src($attachment->ID, 'full');
					?>
						<li>
							<a href="<?php echo $large[0]; ?>" rel="prettyPhoto" title="<?php echo str_replace('"', '\'', $attachment->post_excerpt); ?>">
								<img src="<?php echo $thumb[0]; ?>" alt="" />
								<div class="post-thumb-hover">
									<span><i class="blog-icon-camera"></i></span>
								</div>
							</a>
						</li>
					
				<?php	
				} // foreach ?>
			</ul>
		</div>

	<?php endif; ?>

	<div class="post-details">

		<div class="post-format-icon">
			<span><i class="blog-icon-picture"></i></span>
		</div>

		<div class="post-infos">

			<div class="post-title">
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			</div>

			<div class="post-meta">
				<span class="date"><?php echo get_the_date(); ?></span>
				<span class="author"><?php _e("by", 'kutcher'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author(); ?></a></span>
				<span class="cats"><?php _e("In", 'kutcher'); ?> <?php the_category(', '); ?></span>
				<span class="comments"><a href="<?php comments_link(); ?>"><?php comments_number( __('No Comments', 'kutcher'), __('1 Comment', 'kutcher'), __('% Comments', 'kutcher') ); ?></a></span>
			</div>

			<div class="post-excerpt">
				<?php the_excerpt(); ?>
			</div>

			<div class="read-more">
				<a href="<?php the_permalink(); ?>"><?php _e("Read More...", 'kutcher'); ?></a>
			</div>

		</div>

		<div class="clear clearboth"></div>
	</div>