<?php
/************************
	Content Page
************************/
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="one-single-title">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

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