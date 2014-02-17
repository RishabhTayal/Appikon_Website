<?php
/*******************
	SINGLE PROJECT RIGHT SIDEBAR LAYOUT
********************/

	$_type = get_post_meta($post->ID, 'project-type', true);

?>

	<div class="project-media project-media-full">
	<?php

		if($_type == 'default') {

			$args = array(
				'post_type' => 'attachment',
				'numberposts' => -1,
				'post_status' => null,
				'post_parent' => $post->ID,
				'post__not_in'	=> array( get_post_thumbnail_id() ),
				'orderby' => 'menu_order',
				'order' => 'ASC',
			);
																				  
			$attachments = get_posts( $args );
																				  
			if ( $attachments ) {
				$output = '
				<div class="flexslider xt-flexslider xt-portfolio-slider">
					<ul class="slides">';
														
				foreach ( $attachments as $attachment ) {
					$thumb = wp_get_attachment_image_src($attachment->ID, 'blog-size');
					$large = wp_get_attachment_image_src($attachment->ID, 'full');

					$output .= '
						<li>
							<a href="'.$large[0].'" rel="single-prettyPhoto" class="mfp-image" title="'.str_replace('"', '\'', $attachment->post_excerpt).'">
								<img src="'.$thumb[0].'" alt="" />
								<div class="xt-project-hover">
									<span><i class="xt-portfolio-icon-picture"></i></span>
								</div>
							</a>
						</li>';
				}
														
				$output .= '
					</ul>
				</div>';

				$output .= '
				<script type="text/javascript" charset="utf-8">
					jQuery(document).ready(function() {
						jQuery(".xt-flexslider").flexslider({
							animation: "slide", // fade or slides
							smoothHeight: true,
							slideshow: true, // false to disable autoplay
							controlNav: true,
							directionNav: true
						});

						jQuery(".slides li a").hover(function() {
							jQuery(this).find(".xt-project-hover").fadeIn("fast");
						}, function() {
							jQuery(this).find(".xt-project-hover").fadeOut("fast");
						});

					});
				</script>';

				echo $output;
			}

		}
		else if($_type == 'lightbox') {
			
			$largeImg = get_post_meta($post->ID, 'lightbox-image', true);

			$output = '<a href="'.$largeImg.'" class="single-featured mfp-image" rel="single-prettyPhoto">';

				$output .= get_the_post_thumbnail(get_the_ID(), 'full');
									
				$output .= '<div class="xt-project-hover">
								<span><i class="xt-portfolio-icon-picture"></i></span>
							</div>';

			$output .= '</a>';

			$output .= '
				<script type="text/javascript">
					jQuery(document).ready(function() {

						jQuery(".single-featured").hover(function() {
							jQuery(this).find(".xt-project-hover").fadeIn("fast");
						}, function() {
							jQuery(this).find(".xt-project-hover").fadeOut("fast");
						});

					});
				</script>
			';

			echo $output;

		}
		else if($_type == 'vimeo') {

			$vimeo = get_post_meta($post->ID, 'vimeo-id', true);			
			echo "<div class='video-frame'><div class='video-fluid-wrapper' style='padding-top: 56.25%;'><iframe src='http://player.vimeo.com/video/".$vimeo."?&amp;byline=0&amp;portrait=0' frameborder='0'></iframe></div></div>";
		}
		else if($_type == 'youtube') {
			
			$youtube = get_post_meta($post->ID, 'youtube-id', true);
			echo "<div class='video-frame'><div class='video-fluid-wrapper' style='padding-top: 56.25%;'><iframe src='http://www.youtube.com/embed/".$youtube."' frameborder='0'></iframe></div></div>";
		}

	?>
	</div> <!-- .project-media -->

	<div class="project-content project-content-full">

		<div class="post-navigation">
			<div class="previous-post">
				<?php previous_post_link('%link', '<i class="icon-arrow-left"></i> '.__('PREVIOUS', 'kutcher')); ?> 
			</div>
			<div class="next-post">
				<?php next_post_link('%link', __('NEXT', 'kutcher') . ' <i class="icon-arrow-right"></i>'); ?>
			</div>
			<div class="clear clearboth xt-clear"></div>
		</div>

		<div class="the-content single-the-content">
			<?php the_content(); ?>
		</div>

	</div> <!-- .project-content -->

	<div class="xt-clear"></div>

	<?php
		$related = get_post_meta($post->ID, 'related', true);

		if($related != 'no')
			get_template_part('xt_framework/portfolio/single', 'related');
	?>