<?php
/**
 * Template Name: Page Contact Layout
 */

if(!is_front_page()) :
	get_header(); 
	the_post();
endif;
?>

<?php if(!is_front_page()) : ?>
<div class="contact-block" id="<?php echo get_the_slug(); ?>-menu" name="<?php echo get_the_slug(); ?>-menu">
	<div class="pattern"></div>
		<div class="container">
			<div class="sixteen columns">
			<div class="card">
				<h1 class="white"><?php the_title(); ?></h1>
<?php endif; ?>

<div class="content-wrapper">
	<div class="content page page-full page-contact">
		<div id="page-content" role="main">

			<?php
			if(is_front_page()) : ?>
			
				<?php get_template_part('xt_framework/layouts/pages/content', 'pagehome'); ?>	
				
			<?php else : ?>
			
				<?php get_template_part('xt_framework/layouts/pages/content', 'pagehome'); ?>
				
			<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	
	<div class="xt-clear clear clearboth clearfix"></div>
</div><!-- #content-wrapper -->

<?php if(!is_front_page()) : ?>
		</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php 
if(!is_front_page())
	get_footer(); 
?>