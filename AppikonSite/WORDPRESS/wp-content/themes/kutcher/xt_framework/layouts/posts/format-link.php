	<div class="post-details">

		<div class="post-format-icon">
			<span><i class="blog-icon-link"></i></span>
		</div>

		<div class="post-infos">

			<div class="post-title post-title-link">
				<h1><a href="<?php echo get_post_meta(get_the_ID(), '_format_link_url', true); ?>" target="_blank"><?php the_title(); ?></a></h1>
			</div>

			<div class="read-more">
				<a href="<?php the_permalink(); ?>"><?php _e("Read More...", 'kutcher'); ?></a>
			</div>

		</div>

		<div class="clear clearboth"></div>
	</div>