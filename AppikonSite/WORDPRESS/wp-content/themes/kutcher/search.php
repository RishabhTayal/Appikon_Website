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
				<h1><?php printf( __( '"%s"', 'kutcher' ), get_search_query()); ?></h1>
			</div>

			<div class="content page page-left blog blog-large">
				<div id="page-content" role="main">

					<?php if ( have_posts() ) : ?>
						<?php get_template_part('xt_framework/layouts/blog/blog', 'archive'); ?>
					<?php else : ?>

						<div class="message-error">
							<?php _e("None results using these terms, please try again!", 'kutcher'); ?>
						</div>

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