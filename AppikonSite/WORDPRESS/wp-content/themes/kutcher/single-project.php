<?php
 
// Enqueue Portfolio Styles
wp_enqueue_style( 'pretty-style' );
wp_enqueue_style( 'xt-flexslider-css' );
wp_enqueue_style( 'xt_portfolio_fonts' );
wp_enqueue_style( 'xt_portfolio_styles' );

// Enqueue Portfolio Scripts
wp_enqueue_script( 'jquery-pretty' );
wp_enqueue_script( 'xt-flexslider-js' );
wp_enqueue_script( 'portfolio-pretty-init' );

get_header(); ?>


<div class="page-block" id="single-project-pagemenu" name="single-page-menu">
	<div class="container">

			<div id="content-wrapper">

				<?php while ( have_posts() ) : the_post(); ?>

					<div class="one-single-title">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</div>

					<?php 
						$layout = 'left';
						
						$_l =  get_post_meta($post->ID, 'layout', true);
						
						if($_l == 'right_sidebar')
							$layout = 'right';
						if($_l == 'full')
							$layout = 'full';
						
						// Require Selected Layout
						get_template_part('xt_framework/portfolio/single', $layout); 
					?>
					
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content-wrapper -->

	</div> <!-- end container -->
</div>  <!-- .one-single-block -->

<?php get_footer(); ?>