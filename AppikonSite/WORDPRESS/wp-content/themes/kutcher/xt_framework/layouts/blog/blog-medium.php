<?php

/* Blog Medium Template */

global $numposts;

$per_page = $numposts;

// Args

$args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => $per_page,
	'paged' => get_query_var('paged')
	);

// Blog Query
$blog_query = new WP_Query( $args );

if($blog_query->have_posts()) : ?>

	<div class="post-list">

		<?php
		// The Loop
		while ( $blog_query->have_posts() ) :
			$blog_query->the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('post-medium'); ?>>

				<?php
					$format = get_post_format();
					if( false === $format )
						$format = 'standard';

					get_template_part( 'xt_framework/layouts/posts/format-medium', $format );
				?>

			</article>
			<?php
		endwhile;
		?>

	</div> <!-- .post-list -->

	<?php
		xt_nav_pagination(4, $blog_query->max_num_pages);
endif;

// Restore original Post Data
wp_reset_postdata();
