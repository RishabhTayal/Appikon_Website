<?php
/**
 * Template Name: Page with Left Sidebar No Title
 */

if(!is_front_page())
	get_header();
?>

<?php if(!is_front_page()) : ?>
<div class="page-block" id="single-menu" name="single-menu">
	<div class="container">
<?php endif; ?>

		<div class="content-wrapper">
			<div class="content page page-right">
				<div id="page-content" role="main">

					<?php
					if(is_front_page()) : ?>
					
						<?php get_template_part('xt_framework/layouts/pages/content', 'pagehome'); ?>	
						
					<?php else : ?>
					
						<?php while ( have_posts() ) : the_post(); ?>				
							<?php get_template_part('xt_framework/layouts/pages/content', 'pagehome'); ?>
						<?php endwhile; // end of the loop. ?>
						
					<?php endif; ?>

				</div><!-- #content -->
			</div><!-- #primary -->

			<?php get_sidebar('left'); ?>
			
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