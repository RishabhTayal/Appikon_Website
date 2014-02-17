<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>

<div class="page-block" id="single-menu" name="single-menu">
	<div class="container">

		<div class="content-wrapper">
			<div class="content page page-full page-home notfound">
				<div id="page-content" role="main">
					
					<div class="big-404"><?php _e("Not Found", 'kutcher'); ?></div>
					<div class="sub-404"><?php _e("Sorry, we didn't found the page or post you are looking for.", 'kutcher'); ?></div>
					
				</div><!-- #content -->
			</div><!-- #primary -->
			
			<div class="xt-clear clear clearboth clearfix"></div>
		</div><!-- #content-wrapper -->

	</div> <!-- end container -->
</div>  <!-- .one-single-block -->

<?php get_footer(); ?>