<?php
/************************
	Content Page No Title
************************/
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
			
			<div class="the-content">

				<?php if(!empty($post->post_excerpt)) : ?>
					<p class="lead" style="margin-bottom: 45px;"><?php echo get_the_excerpt(); ?></p>
				<?php endif; ?>
				
				<?php the_content(); ?>
			</div>

			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'kutcher' ), 'after' => '</div>' ) ); ?>

		</div> <!-- .entry-content -->

	</article> <!-- #post -->