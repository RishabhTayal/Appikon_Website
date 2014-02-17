/****************************
	NAME: XIAOTHEMES LAYOUT BUILDER
	VERSION: 2.0
	AUTHOR: RAFAEL ANGELINE (XIAOTHEMES)
****************************/

	/**************
		STRING UTILS FUNCTION
	***************/

	function replaceAll(string, token, newtoken) {
		while (string.indexOf(token) != -1) {
			string = string.replace(token, newtoken);
		}
		return string;
	}

	jQuery(document).ready( function($) {
	
		/********************
			VARS AND CONFIGS
		*********************/

		var currentWidget;
		var tid = 'tw';
		
		jQuery( ".builder-content" ).sortable();
		jQuery( ".layout-content" ).sortable();
		
		/********************
			SAVE RICH TEXT
		********************/

		jQuery(".save-rich-button").live("click", function() {

			tinyMCE.execCommand('mceRemoveControl', false, tid);

			jQuery("#tw-html").click();
			jQuery("#tw-html").click();

			var rich = jQuery("#tw").val();
			
			currentWidget.find("textarea").val( rich );
			var title = jQuery("#editor-widget-name").val();
			
			currentWidget.find(".wid-title").val( title );
			currentWidget.find(".edit-widget").html( '# ' + title );

			jQuery("#tw-tmce").click();
			jQuery("#tw-tmce").click();
			
			tinyMCE.execCommand('mceAddControl', false, tid);

			jQuery('.builder-modal').css("display", "none");

			return false;
		});
		
		/*****************
			CANCEL RICH TEXT
		*****************/	

		jQuery(".cancel-rich-button").live("click", function() {

			jQuery("#tw-tmce").click();
			jQuery("#tw-tmce").click();

			jQuery('.builder-modal').css("display", "none");

			return false;
		});
		
		/***************
			EDIT RICH TEXT
		***************/		

		jQuery(".edit-widget").live("click", function(e) {

			e.preventDefault();

			currentWidget = jQuery(this).parents(".wpts-widget");
			var c = currentWidget.find("textarea").val();
			var title = currentWidget.find(".wid-title").val();

			tinyMCE.execCommand('mceRemoveControl', false, tid);

			jQuery("#tw-html").click();
			jQuery("#tw-html").click();

			jQuery("#tw").val(c);

			jQuery("#tw-tmce").click();

			jQuery("#editor-widget-name").val(title);

			tinyMCE.execCommand('mceAddControl', false, tid);

			jQuery('.builder-modal').css("display", "block");

			return false;
		});
		
		/********************
			REMOVE ROW
		********************/	

		jQuery(".remove-row").live("click", function() {
			if(confirm("Have sure you need delete this row?")) {
				jQuery(this).parents(".row").remove();
			}
			return false;
		});
		
		/*********************
			REMOVE WIDGET
		**********************/	

		jQuery(".remove-widget").live("click", function() {
			if(confirm("Have sure you need delete this row?")) {
				jQuery(this).parents(".wpts-widget").remove();
			}
			return false;
		});

		/*******************
			ADD WIDGETS
		********************/

		jQuery("#add_widget_top").live("click", function() {
			var type = jQuery(this).siblings(".widget_selector").val();
			
			var row = jQuery("#"+type + " .row").clone();
			eval("layout(row)");
			
			return false;
		});
		
		jQuery("#add_widget_bottom").live("click", function() {
			var type = jQuery(this).siblings(".widget_selector").val();
			
			var row = jQuery("#"+type + " .row").clone();
			eval("layout_bottom(row)");
			
			return false;
		});

		/******************
			ADD LAYOUT WIDGET
		******************/	

		jQuery(".add_widget_layout").live("click", function() {

			var type = jQuery(this).siblings(".widget_selector").val();
			var row = jQuery("#"+type + " .row ."+type+"").clone();
			var parent = jQuery(this).parents(".layout");
			var elp = parent.find("input:first").attr("name");
				
			row.find(".wid-parent").remove();

			row.find(".wid-1").attr("name", elp + "[2]["+idn+"]");
			idn++;
				
			row.find(".wid-2").attr("name", elp + "[2]["+idn+"]");
			idn++;
				
			row.find(".wid-3").attr("name", elp + "[2]["+idn+"]");
			idn++;
				
			row.find(".wid-title").attr("name", elp + "[2]["+idn+"]");
			idn++;
				
			parent.children(".layout-content").append(row);
			idn++;

			jQuery( ".layout-content" ).sortable();
			jQuery( ".layout-content" ).disableSelection();

			return false;
		});
				
		/*******************
			WIDGETS
		*******************/
					
		function addtolayout(parent, row) {		
			jQuery(".builder-content").prepend(row);
		}
			
		/* Rich Text Widget :: rich_text */
		function rich_text(row) {
			row.find(".wid-parent").attr("name", "elements["+idn+"]");
			row.find(".wid-1").attr("name", "elements["+idn+"][0]");
			row.find(".wid-2").attr("name", "elements["+idn+"][1]");
			row.find(".wid-3").attr("name", "elements["+idn+"][2]");
			row.find(".wid-title").attr("name", "elements["+idn+"][3]");
			jQuery(".builder-content").prepend(row);
		}
		
		/*********************
			LAYOUTS
		*********************/
		
		/* Layout :: layout */
		function layout(row) {
			row.find(".layout").each(function(i, e) {
				var t = jQuery(this);
				t.find(".wid-parent").attr("name", "elements["+idn+"]");
				t.find(".wid-1").attr("name", "elements["+idn+"][0]");
				t.find(".wid-2").attr("name", "elements["+idn+"][1]");
				idn++;
			});
			jQuery(".builder-content").prepend(row);
		}
			
		/** Layout Bottom :: layout **/
		function layout_bottom(row) {
			row.find(".layout").each(function(i, e) {
				var t = jQuery(this);
				t.find(".wid-parent").attr("name", "elements["+idn+"]");
				t.find(".wid-1").attr("name", "elements["+idn+"][0]");
				t.find(".wid-2").attr("name", "elements["+idn+"][1]");
					idn++;
			});
			jQuery(".builder-content").append(row);
		}
		
		/******************
			TOGGLE IMPORT/EXPORT
		******************/
		
		jQuery(".export-layout a, .import-layout a").live("click", function() {
			jQuery(this).parent().siblings("textarea").slideToggle("fast");	
			return false;
		});
	
	});