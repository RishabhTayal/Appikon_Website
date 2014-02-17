<?php
/**
 * Template Name: Portfolio Grid 4 Columns
 */

// Enqueue Portfolio Styles
wp_enqueue_style( 'pretty-style' );
wp_enqueue_style( 'xt_portfolio_fonts' );
wp_enqueue_style( 'xt_portfolio_styles' );

// Enqueue Portfolio Scripts
wp_enqueue_script( 'jquery-pretty' );
wp_enqueue_script( 'portfolio-pretty-init' );
wp_enqueue_script( 'xt_portfolio_isotope' );
wp_enqueue_script( 'xt_portfolio_init' );

if(!is_front_page())
get_header(); ?>

<?php if(!is_front_page()) : ?>
<div class="page-block" id="single-menu" name="single-menu">
	<div class="container">
<?php endif; ?>

		<div class="content-wrapper">
			<div class="content page page-full page-portfolio page-portfolio-grid">
				<div id="page-content" role="main">

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<h1 class="entry-title"><?php the_title(); ?></h1>
							</header>

							<div class="entry-content">
								<div class="the-content">

										<?php if(!empty($post->post_excerpt)) : ?>
											<p class="lead" style="margin-bottom: 45px;"><?php echo get_the_excerpt(); ?></p>
										<?php endif; ?>

										<?php 
											// Insert 4 Columns Portfolio
											get_template_part('xt_framework/portfolio/portfolio', 'four'); 
										?>

								</div>
							</div><!-- .entry-content -->
						</article><!-- #post -->

				</div><!-- #content -->
			</div><!-- .page-portfolio -->
		</div> <!-- .content-wrapper -->

<?php if(!is_front_page()) : ?>
	</div> <!-- end container -->
</div>  <!-- .one-single-block -->
<?php endif; ?>

<?php 
if(!is_front_page())
	get_footer(); 
?>