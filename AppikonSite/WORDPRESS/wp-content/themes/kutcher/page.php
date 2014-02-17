<?php
if(!is_front_page())
	get_header(); ?>

<div class="page-block" id="single-pagemenu" name="single-page-menu">
	<div class="container">

		<div class="content-wrapper">
			<div class="content page page-full">
				<div id="page-content" role="main">

					<?php
					if(is_front_page()) : ?>
					
						<?php get_template_part('xt_framework/layouts/pages/content', 'page'); ?>	
						
					<?php else : ?>
					
						<?php while ( have_posts() ) : the_post(); ?>				
							<?php get_template_part('xt_framework/layouts/pages/content', 'page'); ?>
						<?php endwhile; // end of the loop. ?>
						
					<?php endif; ?>

				</div><!-- #content -->
			</div><!-- #primary -->
			
			<div class="xt-clear clear clearboth clearfix"></div>
		</div><!-- #content-wrapper -->
		
	</div> <!-- end container -->
</div>  <!-- .one-single-block -->

<?php 
if(!is_front_page())
	get_footer(); 
?>