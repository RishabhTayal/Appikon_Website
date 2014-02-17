	
	jQuery(document).ready(function() {
		
		var wpts_meta_field = null;
		var storeSendToEditor = window.send_to_editor;
				
		jQuery('.upload-admin').live("click", function() {
			wpts_meta_field = jQuery(this).siblings(".upload-admin-input");
			formfield = jQuery(this).siblings(".upload-admin-input").attr('name');
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			
			window.send_to_editor = function(html) {
				imgurl = jQuery('img',html).attr('src');
				wpts_meta_field.val(imgurl);
				tb_remove();
				window.send_to_editor = storeSendToEditor;
			}
			
			return false;
		});
	
	});