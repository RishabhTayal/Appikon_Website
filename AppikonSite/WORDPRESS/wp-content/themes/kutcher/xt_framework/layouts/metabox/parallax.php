<?php
	
	add_action("admin_init", "xt_pages_meta_box"); 

	/*** META DEFINITION ***/
	
	function xt_pages_meta_box(){  
        add_meta_box("xt_parallax_options", "Parallax Background Options" , "xt_parallax_meta_options", "page", "normal", "high");	
        add_meta_box("xt_menu_options", "Menu Display Options" , "xt_menu_meta_options", "page", "side");	
	}

	/*** MENU DISPLAY OPTIONS ***/

	function xt_menu_meta_options()
	{  
		global $post;  
		global $post_id;

		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;  

		// Get post custom fields arrays
		$custom = get_post_custom($post->ID);

		// Name to Menu
		$menu_name = (isset($custom["menu-name"])) ? $custom["menu-name"][0] : '';

		// External
		//$menu_external = (isset($custom["menu-external"])) ? $custom["menu-external"][0] : '';

	?>

		<?php wp_nonce_field( basename( __FILE__ ), 'xt_menu_meta_nonce' ); ?>

		<div class="xt-input">
			<label>Menu Name</label>
			<input type="text" name="menu-name" value="<?php echo $menu_name; ?>" /><br />
			<i>This name will be displayed at menu. Leave blank and the title will be used.</i>
		</div>

	<?php
	}

	/*** SAVE OPTIONS ***/

	add_action('save_post', 'save_xt_menu');   

	function save_xt_menu(){  
		global $post;
		global $post_id;

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;  

		if(!isset( $_POST['xt_menu_meta_nonce']) || !wp_verify_nonce( $_POST['xt_menu_meta_nonce'], basename( __FILE__ ) ) ) return $post_id;

		update_post_meta($post->ID, "menu-name", $_POST["menu-name"]);
    }
	
	/*** PARALLAX OPTIONS ***/
	  
    function xt_parallax_meta_options()
	{  
        global $post;  
		global $post_id;

		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;  

		// Get post custom fields arrays
		$custom = get_post_custom($post->ID); 

		// Parallax Status
		$parallax_status = (isset($custom["parallax-status"])) ? $custom["parallax-status"][0] : '';

		// Parallax Type
		$parallax_type = (isset($custom["parallax-type"])) ? $custom["parallax-type"][0] : 'default';

		/* Parallax Img */
		$parallax_img = (isset($custom["parallax-img"])) ? $custom["parallax-img"][0] : '';

		/* Parallax Height */
		$parallax_height = (isset($custom["parallax-height"])) ? $custom["parallax-height"][0] : '440';

		/* Quote Type */
		$quote_content = (isset($custom["quote-content"])) ? $custom["quote-content"][0] : '';
		$quote_author = (isset($custom["quote-author"])) ? $custom["quote-author"][0] : '';

		/* Tweet */
		$twitter_acc = (isset($custom["twitter-acc"])) ? $custom["twitter-acc"][0] : '';

		/* Rich */
		$rich_parallax = (isset($custom["parallax_custom_content"])) ? $custom["parallax_custom_content"][0] : '';

	?>  

		<div class="xt-metabox">
		
			<div class="xt-title"><h2>Parallax Settings</h2></div>

			<?php wp_nonce_field( basename( __FILE__ ), 'xt_parallax_meta_nonce' ); ?>

			<div id="xt-height" class="xt-input">
				<label><input type="checkbox" name="parallax-status" value="off" <?php if($parallax_status == 'off') echo 'checked="checked"'; ?> /> Check this to disable the parallax for this page.</label>
			</div>

			<div id="xt-bigimage" class="xt-input">
				<div class="xt-preview">
					<?php if($parallax_img != '') : ?>
					<img src="<?php echo $parallax_img; ?>" alt="" />
					<?php endif; ?>
				</div>

				<label>Upload Parallax Background Image</label>
				<input type="text" class="upload-admin-input" name="parallax-img" value="<?php echo $parallax_img; ?>" /> 
				<input class="button button-primary upload-admin" type="button" value="Upload" />

				<div class="xt-clear"></div>
			</div>

			<div id="xt-height" class="xt-input">
				<label>Block Height (default: 440)</label>
				<input type="text" name="parallax-height" value="<?php echo $parallax_height; ?>" />
			</div>

			<div class="xt-input type-selector">
				<label>Parallax Content</label>
				<span class="xt-radio">
				<input type="radio" name="parallax-type" rel="default" value="default"<?php if($parallax_type == 'default') echo ' checked="checked"'; ?> /> None
				</span>

				<span class="xt-radio">
				<input type="radio" name="parallax-type" rel="quote" value="quote"<?php if($parallax_type == 'quote') echo ' checked="checked"'; ?> /> Quote
				</span>

				<span class="xt-radio">
				<input type="radio" name="parallax-type" rel="tweet" value="tweet"<?php if($parallax_type == 'tweet') echo ' checked="checked"'; ?> /> Tweet
				</span>

				<span class="xt-radio">
				<input type="radio" name="parallax-type" rel="rich" value="rich"<?php if($parallax_type == 'rich') echo ' checked="checked"'; ?> /> Rich Editor
				</span>
			</div>

			<div id="xt-default" class="xt-input default-id"<?php if($parallax_type != 'default') echo ' style="display: none;"'; ?>>
				<p><i>None options avaliable to this type, only the image will be showed.</i></p>
			</div>

			<!-- QUOTE TYPE -->

			<div id="xt-quote" class="xt-input quote-id"<?php if($parallax_type != 'quote') echo ' style="display: none;"'; ?>>
				<label>Quote Content</label>
				<textarea name="quote-content" style="width: 350px; height: 100px;"><?php echo $quote_content; ?></textarea>
			</div>

			<div id="xt-quote-author" class="xt-input quote-id"<?php if($parallax_type != 'quote') echo ' style="display: none;"'; ?>>
				<label>Quote Author</label>
				<input type="text" name="quote-author" value="<?php echo $quote_author; ?>" />
			</div>

			<!-- TWEET -->

			<div id="xt-tweet" class="xt-input tweet-id"<?php if($parallax_type != 'tweet') echo ' style="display: none;"'; ?>>
				<label>Twitter Account</label>
				<input type="text" name="twitter-acc" value="<?php echo $twitter_acc; ?>" />
			</div>

			<!-- RICH EDITOR -->

			<div id="xt-rich" class="xt-input rich-id"<?php if($parallax_type != 'rich') echo ' style="display: none;"'; ?>>
				<label>Custom Rich Content</label>
				<?php wp_editor($rich_parallax, 'parallax_custom_content' ); ?>
			</div>

			<script type="text/javascript">
				//<![CDATA[
				jQuery(document).ready(function() {

					jQuery('.type-selector input[type="radio"]').change(function() {
						/* hide everybody! */
						jQuery('.default-id, .quote-id, .tweet-id, .rich-id').css("display", "none");

						/* show only the selected */
						jQuery('.' + jQuery(this).attr('rel') + '-id').css("display", "block");
					});

				});
				//]]>
			</script>

		</div>
    <?php  
    }
	
	/*** SAVE OPTIONS ***/

	add_action('save_post', 'save_xt_parallax');   

	function save_xt_parallax(){  
		global $post;
		global $post_id;

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;  

		if(!isset( $_POST['xt_parallax_meta_nonce']) || !wp_verify_nonce( $_POST['xt_parallax_meta_nonce'], basename( __FILE__ ) ) ) return $post_id;

		if(isset($_POST['parallax-status']))
			update_post_meta($post->ID, "parallax-status", $_POST["parallax-status"]);
		else
			update_post_meta($post->ID, "parallax-status", '');

		update_post_meta($post->ID, "parallax-type", $_POST["parallax-type"]);
		update_post_meta($post->ID, "parallax-img", $_POST["parallax-img"]);
		update_post_meta($post->ID, "parallax-height", $_POST["parallax-height"]);

		update_post_meta($post->ID, "quote-content", $_POST["quote-content"]);
		update_post_meta($post->ID, "quote-author", $_POST["quote-author"]);

		update_post_meta($post->ID, "twitter-acc", $_POST["twitter-acc"]);

		update_post_meta($post->ID, "parallax_custom_content", $_POST["parallax_custom_content"]);
    }
	
?>