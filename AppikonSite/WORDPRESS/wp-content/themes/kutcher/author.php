<?php

// Enqueue Styles

wp_enqueue_style( 'xt-flexslider-css' );
wp_enqueue_style( 'pretty-style' );
wp_enqueue_style( 'xt_blog_fonts' );

// Enqueue Scripts
wp_enqueue_script( 'jquery-pretty' );
wp_enqueue_script( 'xt-flexslider-js' );
wp_enqueue_script( 'xt-blog-js' );

get_header(); ?>

<div class="page-block" id="single-menu" name="single-menu">
	<div class="container">

		<div class="content-wrapper">

			<div class="one-single-title">
				<?php the_post(); ?>
				<h1><?php the_author_meta('display_name'); ?></h1>
				<?php rewind_posts(); ?>
			</div> <!-- .one-single-title -->

			<div class="content page page-left blog blog-large">
				<div id="page-content" role="main">

					<?php if ( have_posts() ) : ?>
						<?php get_template_part('xt_framework/layouts/blog/blog', 'archive'); ?>
					<?php endif; // end of the loop. ?>

				</div><!-- #content -->
			</div><!-- #primary -->

			<?php get_sidebar('right'); ?>
			
			<div class="xt-clear clear clearboth clearfix"></div>
		</div><!-- #content-wrapper -->

	</div> <!-- end container -->
</div>  <!-- .one-single-block -->

<?php 
	get_footer(); 
?>