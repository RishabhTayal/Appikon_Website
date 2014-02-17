<?php
/****************************
	NAME: XIAOTHEMES LAYOUT BUILDER
	VERSION: 2.0
	AUTHOR: RAFAEL ANGELINE (XIAOTHEMES)
****************************/

	/****************
		ENQUEUE STYLES AND SCRIPTS
	****************/

	add_action('admin_init', 'xt_layout_builder');
	function xt_layout_builder()
	{
		/* Theme URI */
		$dir = get_template_directory_uri();

		/* Thickbox and Media Uploader */
		wp_enqueue_style('thickbox');	

		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		
		/* jQuery UI Components */
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('	jquery-ui-mouse');
		wp_enqueue_script('jquery-ui-sortable');
		
		/* Layout Builder CSS Style */
		wp_enqueue_style("wpts-builder-css", $dir."/xt_framework/layout-builder/layout-builder.css", false, "1.0", "all");
				
		/* Layout Builder Editor Script */
		wp_register_script('wpts-builder-js', $dir.'/xt_framework/layout-builder/layout-builder.js', array('jquery','media-upload','thickbox'), "1.0");
		wp_enqueue_script('wpts-builder-js');
			
		/* WP Editor */
		wp_enqueue_script('editor');
	}
	
	/*******************
		CONFIGURATION SCRIPTS
	********************/
	
	add_action('admin_head', 'xt_add_tinymce');
	function xt_add_tinymce() {
		?>
		<script type="text/javascript">
		// <![CDATA[
		jQuery(document).ready(function($) {		
			jQuery("#wp-tw-wrap").appendTo("#lb-editor-recipient");	
			jQuery("#wp-tw-wrap").css("display", "block");	
		});
		// ]]>
		</script>

		<style type='text/css'>

			#wp-tw-wrap { display: none; }
			#tw { margin: 0; }
			.mceLayout {
				border: 1px solid #ccc;
			}
		</style>
		<?php
	}
	

	/********************
		METABOX INIT
	*********************/

	add_action("admin_init", "layout_builder_meta");     
    function layout_builder_meta() {  
        add_meta_box("builder-meta", "Layout Builder", "layout_builder_options", "page", "normal", "high");  
        add_meta_box("builder-meta", "Layout Builder", "layout_builder_options", "post", "normal", "high");  
    }    
      
	/*********************
		METABOX CONTENT
	**********************/
	  
    function layout_builder_options() {  
		
		/* Add Editor to be used by LB */
		add_action( 'edit_page_form', 'xt_layout_builder_editor' );
		
		add_action( 'edit_form_advanced', 'xt_layout_builder_editor' );
		function xt_layout_builder_editor() {		
			$content = '';
			wp_editor( $content, 'tw');
		}

		/* Get Vars */
        global $post;  
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;  
        $custom = get_post_custom($post->ID); 
		
		$el = @$custom["elements"];
		$usebuilder = @$custom["usebuilder"][0];  
		$elements = maybe_unserialize(@$custom["elements"][0]); 

		if (@base64_decode( $elements, true )) {
				
			$elements = base64_decode( $elements );
			$elements = maybe_unserialize( $elements );
		}

		if(isset($custom["import"][0])) :
			if($custom["import"][0] != '' && $custom["import"][0] != null) {

				$imp = $custom["import"][0];
				$imp = base64_decode($imp);
				$imp = maybe_unserialize($imp);
				if (@base64_decode( $imp[0], true )) {
					$imp = base64_decode($imp[0]);
				}
				$imp = maybe_unserialize($imp);
				$elements = $imp;

				update_post_meta($post->ID, "import", null);
			} 
		endif;  
    ?>  
		
		<!-- TOP OF BUILDER -->

		<div class="wpts-title wpts-title-cyan"><h2>Layout Builder</h2></div>
		
		<div class="builder-enable">
			<input type="checkbox" name="usebuilder" <?php if($usebuilder) echo 'checked="checked"'; ?> /> Use Layout Builder on this page?
		</div>
		
		<!-- CLONE AREA -->

		<div class="builder-clone">
			<?php require_once("clone.php"); ?>
		</div> 

		<!-- LAYOUT BUILDER CONTROLS TOP -->
		
		<div class="builder-controls">
			<?php require("select-all.php"); ?>
			<a href="#" class="add_widget button button-primary button-large" id="add_widget_top">Add Column(s)</a>
		</div>

		<!-- LAYOUT BUILDER MODAL WINDOW -->
		
		<div class="builder-modal">	
			<div class="builder-modal-content">
				
				<div class="text-rich-area" style="height: 94% !important;">
					
					<div class="editor-name">
						<label>Widget Name:</label> <input type="text" id="editor-widget-name" />
					</div>

					<!-- It will receive the editor created before -->
					<div id="lb-editor-recipient"></div>
					
				</div> <!-- .text-rich-area -->

				<div class="save-rich">
					<a href="#" class="save-rich-button">Save</a> <a href="#" class="cancel-rich-button">Cancel</a>
				</div>

			</div>			
		</div> <!-- buider-modal -->

		<!-- LAYOUT BUILDER WIDGETS -->

		<div class="builder-content">
		
			<?php require_once("models.php"); ?>
				
		</div> <!-- .builder-content -->

		<!-- LAYOUT BUILDER CONTROLS BOTTOM -->
		
		<div class="builder-controls">
			<?php require("select-all.php"); ?>
			<a href="#" class="add_widget button button-primary button-large" id="add_widget_bottom">Add Column(s)</a>
		</div> <!-- .builder-controls -->
		
		<!-- EXPORT/IMPORT TOOLS -->

		<div class="export-layout">
			<h2><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/xt_framework/layout-builder/images/seta.png" title="Export" /> Export Content</a></h2>
			<textarea class="export"><?php echo base64_encode(serialize($el)); ?></textarea>
		</div>
		
		<div class="import-layout">
			<h2><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/xt_framework/layout-builder/images/seta2.png" title="Import" /> Import Content</a></h2>
			<textarea name="importing" class="import"></textarea>
		</div>
		
		<div class="clearboth"></div>

	
    <?php  		
    }  

    /***********
    	SAVE LAYOUT BUILDER OPTIONS
    ***********/
	
	add_action('save_post', 'layout_builder_save');   
      
    function layout_builder_save(){  
		global $post;

		if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {  
			return $post_id;  
		} else {

			if(isset($_POST["importing"])) :
				if($_POST["importing"] != "")	
					update_post_meta(@$post->ID, "import", $_POST["importing"]);
			endif;

			update_post_meta(@$post->ID, "usebuilder", @$_POST["usebuilder"]);  

			if(isset($_POST["elements"])) :
				$els = serialize($_POST["elements"]);
				$els = base64_encode( $els );
				update_post_meta(@$post->ID, "elements", $els );
			else:
				$els = serialize('');
				$els = base64_encode( $els );
				update_post_meta(@$post->ID, "elements", $els );
			endif;

		}
	}
