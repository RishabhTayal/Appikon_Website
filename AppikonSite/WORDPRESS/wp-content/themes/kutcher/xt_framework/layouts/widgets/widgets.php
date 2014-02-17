<?php

/*****************
	Twitter Feed Widget
******************/

class XTTwitterFeeds extends WP_Widget {

	function XTTwitterFeeds() {
		$widget_ops = array( 'classname' => 'twitter-feeds', 'description' => __('A widget that displays a Twitter account feeds', 'kutcher') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'twitter-feed-widget' );
		
		$this->WP_Widget( 'twitter-feed-widget', __('XT - Twitter Feeds', 'kutcher'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );	
		$account = $instance['account'];
		$num = $instance['num'];
		
		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;
		
		echo do_shortcode('[xt_twitter username="'.$account.'" count="'.$num.'"]');
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['account'] = strip_tags( $new_instance['account'] );
		$instance['num'] = strip_tags( $new_instance['num'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => 'Recent Tweets', 'account' => __('', 'kutcher'), 'num' => 2 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'account' ); ?>"><?php _e('Twitter Account:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'account' ); ?>" name="<?php echo $this->get_field_name( 'account' ); ?>" value="<?php echo $instance['account']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e('Tweets Number:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo $instance['num']; ?>" style="width:100%;" />
		</p>
		
	<?php
	}
}

/***********************************************/
/* Categories / Archives / Tags Widget
/***********************************************/


class XTOrganizerTabs extends WP_Widget {

	function XTOrganizerTabs() {
		$widget_ops = array( 'classname' => 'organizer-tabs', 'description' => __('Display a widget with Categories - Tags - Archives', 'kutcher') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'organizer-tabs-widget' );
		
		$this->WP_Widget( 'organizer-tabs-widget', __('XT - Categories, Tags, Archives', 'kutcher'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );		

		ob_start();	
		?>
		<li class="cats-arch-tags-widget">
			[xt_tabs_framed]
					
				[xt_tab title="<?php _e("Categories", 'kutcher'); ?>" icon="th-list"]
					<ul>
                       	<?php
						$categories=  get_categories(); 
						$count = count($categories);
						$current = 1;
						foreach ($categories as $category) {
							$class = '';
							if($current == $count) $class = ' class="last-child"';
							$output = '<li'.$class.'><a href="'.get_category_link( $category->cat_ID ).'">'.$category->name.'</a><span>'.$category->count.'</span></li>';
							echo $output;
							$current++;
						}
						?>
                    </ul>
				[/xt_tab]

				[xt_tab title="<?php _e("Tags", 'kutcher'); ?>" icon="tags"]
					<ul>
                        <?php
						$tags =  get_tags(); 
						$count = count($tags);
						$current = 1;
						foreach ($tags as $tag) {
							$class = '';
							if($current == $count) $class = ' class="last-child"';
							$output = '<li'.$class.'><a href="'.get_tag_link( $tag->term_id ).'">'.$tag->name.'</a><span>'.$tag->count.'</span></li>';
							echo $output;
							$current++;
						}
						?>
                    </ul>
				[/xt_tab]

				[xt_tab title="<?php _e("Archives", 'kutcher'); ?>" icon="bookmark"]
					<ul>
                        <?php
						$archives = wp_get_archives( array( 'show_post_count' => true, 'echo' => false ) );
						$archives = str_replace("(", "<span>", $archives);
						$archives = str_replace(")", "</span>", $archives);
						echo $archives;
						?>
                    </ul>
				[/xt_tab]
                    
            [/xt_tabs_framed]
        </li>
					
		<?php

		$output = do_shortcode( ob_get_contents() );

		ob_end_clean();

		echo $output;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		?>
		<p>None options avaliable to this widget.</p>
		<?php
	?>

	<?php
	}
}

/*****************
	Latest Projects Widget
******************/

class XTLatestProjects extends WP_Widget {

	function XTLatestProjects() {
		$widget_ops = array( 'classname' => 'latest-projects', 'description' => __('A widget that displays a latest projects grid', 'kutcher') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'latest-projects-widget' );
		
		$this->WP_Widget( 'latest-projects-widget', __('XT - Latest Projects', 'kutcher'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );	
		$columns = $instance['columns'];
		$num = $instance['num'];
		$offset = $instance['offset'];
		$categories = $instance['categories'];
		$portfolio = $instance['portfolio'];
		
		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;
		
		echo do_shortcode('[xt_latest_projects show_title="no" show_excerpt="no" columns="'.$columns.'" num="'.$num.'" offset="'.$offset.'" categories="'.$categories.'" portfolio="'.$portfolio.'"]');
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['columns'] = strip_tags( $new_instance['columns'] );
		$instance['num'] = strip_tags( $new_instance['num'] );
		$instance['offset'] = strip_tags( $new_instance['offset'] );
		$instance['categories'] = strip_tags( $new_instance['categories'] );
		$instance['portfolio'] = strip_tags( $new_instance['portfolio'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => 'Latest Projects', 'columns' => '3', 'num' => '4', 'offset' => '0', 'categories' => '', 'portfolio' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php _e('Columns:', 'kutcher'); ?></label>
			<select id="<?php echo $this->get_field_id( 'columns' ); ?>" name="<?php echo $this->get_field_name( 'columns' ); ?>">
				<option value="2"<?php if($instance['columns'] == '2') echo ' selected="selected"'; ?>>2</option>
				<option value="3"<?php if($instance['columns'] == '3') echo ' selected="selected"'; ?>>3</option>
				<option value="4"<?php if($instance['columns'] == '4') echo ' selected="selected"'; ?>>4</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e('Number of Projects:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo $instance['num']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'offset' ); ?>"><?php _e('(Optional) Offset:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'offset' ); ?>" name="<?php echo $this->get_field_name( 'offset' ); ?>" value="<?php echo $instance['offset']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e('(Optional) Filters:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" value="<?php echo $instance['categories']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'portfolio' ); ?>"><?php _e('(Optional) Portfolio:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'portfolio' ); ?>" name="<?php echo $this->get_field_name( 'portfolio' ); ?>" value="<?php echo $instance['portfolio']; ?>" style="width:100%;" />
		</p>
				
	<?php
	}
}

/**********************************************/
/* RECENT / POPULAR / COMMENTS - TABS WIDGETS */
/**********************************************/

class XTPostTabs extends WP_Widget {

	function XTPostTabs() {
		$widget_ops = array( 'classname' => 'post-tabs', 'description' => __('Display a widget with Recent - Popular - Comments Feeds', 'kutcher') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'post-tabs-widget' );
		
		$this->WP_Widget( 'post-tabs-widget', __('XT - Recent, Popular, Comments', 'kutcher'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );	

		ob_start();	
		?>

		<li class="recent-popular-comments">
			[xt_tabs_framed]
					
				[xt_tab title="<?php _e("Recent", 'kutcher'); ?>" icon="magic"]
					<ul>
									<?php
									$count = $instance["count-recent"];
									
									$query = array('showposts' => $count, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
									$r = new WP_Query($query);
									
									if ($r->have_posts()) :

										$currentPost = 0;
										
										while ($r->have_posts()) :
											$r->the_post();
											if($currentPost < $count) {
												$currentPost++;
											}
											?>
													<li<?php if($currentPost == $count)  echo ' class="last-child"'; ?>>
														<div class="rpc_post_title">
															<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
														</div>
														<div class="rpc_post_date"><?php echo get_the_date(); ?></div>
														<div class="rpc_post_comments"><a href="<?php comments_link(); ?>"><?php comments_number( 'No Comments', '1 Comment', __('% Comments', 'kutcher') ); ?></a></div>
													</li>
											<?php
	
										endwhile;
									else :
									?>
																			
									<?php
									endif;
									wp_reset_query();
									?>
                                </ul>
				[/xt_tab]

				[xt_tab title="<?php _e("Popular", 'kutcher'); ?>" icon="star"]
					 <ul>
                                    <?php
									$count = $instance["count-popular"];
									
									$query = array('showposts' => $count, 'nopaging' => 0, 'orderby'=> 'comment_count', 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
									$r = new WP_Query($query);
									
									if ($r->have_posts()) :

										$currentPost = 0;
										
										while ($r->have_posts()) :
											$r->the_post();
											if($currentPost < $count) {
												$currentPost++;
											}
											?>
													<li<?php if($currentPost == $count)  echo ' class="last-child"'; ?>>
														<div class="rpc_post_title">
															<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
														</div>
														<div class="rpc_post_date"><?php echo get_the_date(); ?></div>
														<div class="rpc_post_comments"><a href="<?php comments_link(); ?>"><?php comments_number( 'No Comments', '1 Comment', __('% Comments', 'kutcher') ); ?></a></div>
													</li>
											<?php
	
										endwhile;
									else :
									?>
																			
									<?php
									endif;
									wp_reset_query();
									?>
                                </ul>
				[/xt_tab]

				[xt_tab title="<?php _e("Comments", 'kutcher'); ?>" icon="microphone"]
					<ul>
                                    <?php
									$count = $instance["count-comments"];
									$args = array(
										'status' => 'approve',
										'number' => $count,
									);
									$comments = get_comments($args);
									$currentPost = 0;
									foreach($comments as $comment) :
										if($currentPost < $count) {
											$currentPost++;
										}
									?>
										<li<?php if($currentPost == $count)  echo ' class="last-child"'; ?>>
											<div class="rpc_post_title">
												<a href="<?php echo str_replace("comments", "comment", get_comments_link( $comment->comment_post_ID )).'-'.$comment->comment_ID; ?>"><?php echo substr ( $comment->comment_content, 0, 80 ); ?>...</a>
											</div>
											<div class="rpc_post_date"><?php echo get_the_date(); ?></div>
											<div class="rpc_post_comments"><a href="<?php echo str_replace("comments", "comment", get_comments_link( $comment->comment_post_ID )).'-'.$comment->comment_ID; ?>"><?php echo $comment->comment_author; ?></a></div>
										</li>
									<?php
									endforeach;
									?>
                                </ul>
				[/xt_tab]
                    
            [/xt_tabs_framed]
        </li>

		<?php

		$output = do_shortcode( ob_get_contents() );

		ob_end_clean();

		echo $output;

	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['count-recent'] = $new_instance['count-recent'];
		$instance['count-popular'] = $new_instance['count-popular'];
		$instance['count-comments'] = $new_instance['count-comments'];

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'count-recent' => 3, 'count-popular' => 3, 'count-comments' => 5 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'count-recent' ); ?>"><?php _e('Recent Posts Number:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'count-recent' ); ?>" name="<?php echo $this->get_field_name( 'count-recent' ); ?>" value="<?php echo $instance['count-recent']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count-popular' ); ?>"><?php _e('Recent Popular Number:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'count-popular' ); ?>" name="<?php echo $this->get_field_name( 'count-popular' ); ?>" value="<?php echo $instance['count-popular']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'count-comments' ); ?>"><?php _e('Comments Number:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'count-comments' ); ?>" name="<?php echo $this->get_field_name( 'count-comments' ); ?>" value="<?php echo $instance['count-comments']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}

/*****************
	Facebook Box Widget
******************/

class XTFacebookBox extends WP_Widget {

	function XTFacebookBox() {
		$widget_ops = array( 'classname' => 'facebookbox-feeds', 'description' => __('A widget that displays a Facebook Like Box', 'kutcher') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'facebook-box-widget' );
		
		$this->WP_Widget( 'facebook-box-widget', __('XT - Facebook Box', 'kutcher'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );	
		$account = $instance['account'];
		
		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;
		
		echo do_shortcode('[xt_fb_box href="'.$account.'"]');
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['account'] = strip_tags( $new_instance['account'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => 'Like Box', 'account' => __('', 'kutcher'), 'num' => 2 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'account' ); ?>"><?php _e('Facebook Page Address:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'account' ); ?>" name="<?php echo $this->get_field_name( 'account' ); ?>" value="<?php echo $instance['account']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}

/*****************
	Flickr Feeds Widget
******************/

class XTFlickr extends WP_Widget {

	function XTFlickr() {
		$widget_ops = array( 'classname' => 'flickr-feeds', 'description' => __('A widget that displays a Flickr account feeds', 'kutcher') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'flickr-feed-widget' );
		
		$this->WP_Widget( 'flickr-feed-widget', __('XT - Flickr Feeds', 'kutcher'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );	
		$account = $instance['account'];
		$num = $instance['num'];
		
		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;
		
		echo do_shortcode('[xt_flickr count="'.$num.'" id="'.$account.'" display="latest"]');
		//[xt_flickr count="6" id="52617155@N08" display="latest"]
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['account'] = strip_tags( $new_instance['account'] );
		$instance['num'] = strip_tags( $new_instance['num'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => 'Flickr Feed', 'account' => __('', 'kutcher'), 'num' => 2 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'account' ); ?>"><?php _e('Flickr Account:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'account' ); ?>" name="<?php echo $this->get_field_name( 'account' ); ?>" value="<?php echo $instance['account']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e('Photo Number:', 'kutcher'); ?></label>
			<input id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo $instance['num']; ?>" style="width:100%;" />
		</p>
		
	<?php
	}
}
