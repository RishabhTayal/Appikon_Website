<?php
	
	add_action("admin_init", "xt_slider_meta_box"); 

	/*** META DEFINITION ***/
	
	function xt_slider_meta_box(){  
        add_meta_box("xt_sliders", "Select your Slider", "xt_slider_meta_options", "page", "normal", "high");  	
	}
	
	/*** META OPTIONS ***/
	  
    function xt_slider_meta_options()
	{  
            global $post;  
            if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;  
            $custom = get_post_custom($post->ID);  
            $xt_slider = ( isset($custom['xt-slider-alias']) ) ? $custom["xt-slider-alias"][0] : '';  
    ?>  
		<div class="xt-metabox">

			<div class="xt-input">
				<label>Type your Slider Alias below: </label>
				<input type="text" name="xt-slider-alias" value="<?php echo $xt_slider; ?>" />
			</div>
						
		</div>
    <?php  
    }
	
	/*** SAVE OPTIONS ***/

	add_action('save_post', 'save_xt_slider');   
      
    function save_xt_slider(){  
        global $post;    
      
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){  
            return $post_id;  
        } else{  

            update_post_meta(@$post->ID, "xt-slider-alias", @$_POST["xt-slider-alias"]);  
        	
        }  
    }
	
?>