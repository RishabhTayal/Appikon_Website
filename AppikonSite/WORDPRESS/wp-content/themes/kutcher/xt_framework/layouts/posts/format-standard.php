
	<?php if( has_post_thumbnail() ) : ?>	
		<div class="thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('blog-size', array('title' => get_the_title(), 'class' => '') ); ?>
				<div class="post-thumb-hover">
					<span><i class="blog-icon-doc-text"></i></span>
				</div>
			</a>
		</div>
	<?php endif; ?>

	<div class="post-details">

		<div class="post-format-icon">
			<span><i class="blog-icon-doc-text"></i></span>
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