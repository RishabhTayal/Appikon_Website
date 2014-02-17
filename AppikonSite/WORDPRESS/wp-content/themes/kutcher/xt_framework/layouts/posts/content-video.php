
	<div class="post-video">
		<?php
		
		$videoEmbed = get_post_meta(get_the_ID(), '_format_video_embed', true);
			
		if($videoEmbed != '') :
		?>
		<div class="video-frame">
			<div class="video-fluid-wrapper" style="padding-top: 56.25%;">
				<?php echo $videoEmbed; ?>
			</div>
		</div>
		<?php endif; ?>

	</div>

	<div class="post-details">

		<div class="post-format-icon">
			<span><i class="blog-icon-video"></i></span>
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

			<div class="post-content">
				<div class="the-content">
					<?php the_content(); ?>
				</div>
			</div>

		</div>

		<div class="clear clearboth"></div>
	</div>