<?php
/**
 * Template Name: Blog Large
 */
 
// Enqueue Styles

wp_enqueue_style( 'xt-flexslider-css' );
wp_enqueue_style( 'pretty-style' );
wp_enqueue_style( 'xt_blog_fonts' );

// Enqueue Scripts
wp_enqueue_script( 'jquery-pretty' );
wp_enqueue_script( 'xt-flexslider-js' );
wp_enqueue_script( 'xt-blog-js' );

if(!is_front_page())
get_header(); ?>

<?php if(!is_front_page()) : ?>
<div class="page-block" id="single-menu" name="single-menu">
	<div class="container">
<?php endif; ?>

		<div class="content-wrapper">

			<div class="one-single-title">
				<h1><?php the_title(); ?></h1>
			</div> <!-- .one-single-title -->

			<div class="content page page-left blog blog-large">
				<div id="page-content" role="main">

					<?php if ( have_posts() ) : ?>
						<?php get_template_part('xt_framework/layouts/blog/blog', 'large'); ?>
					<?php endif; // end of the loop. ?>

				</div><!-- #content -->
			</div><!-- #primary -->

			<?php get_sidebar('right'); ?>
			
			<div class="xt-clear clear clearboth clearfix"></div>
		</div><!-- #content-wrapper -->

<?php if(!is_front_page()) : ?>
	</div> <!-- end container -->
</div>  <!-- .one-single-block -->
<?php endif; ?>

<?php 
if(!is_front_page())
	get_footer(); 
?>