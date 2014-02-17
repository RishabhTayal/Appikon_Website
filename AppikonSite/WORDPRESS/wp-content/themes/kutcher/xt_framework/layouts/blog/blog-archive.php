<?php

/* Blog Archive Template */

if(have_posts()) : ?>

	<div class="post-list">

		<?php
		// The Loop
		while (have_posts() ) : the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('post post-large'); ?>>

				<?php
					$format = get_post_format();
					if( false === $format )
						$format = 'standard';

					get_template_part( 'xt_framework/layouts/posts/format', $format );
				?>

			</article>
			<?php
		endwhile;
		?>

	</div> <!-- .post-list -->

	<?php
		xt_nav_pagination(4);
endif;