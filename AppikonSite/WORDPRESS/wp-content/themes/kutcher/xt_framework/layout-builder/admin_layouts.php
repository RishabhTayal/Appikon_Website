<?php

	/// LAYOUTS
	
	global $idn;
	global $idw;
	$idn = 0;
	$idw = 0;

	/*** LAYOUT BEGINS ***/
	
	function layout_b() {
		?>
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
		<?php
	}
	
	function layout_e() {
		global $idn;
		//var_dump($idn);
		?>
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		<?php
	}
	
/****************************************
	FULL WIDTH
****************************************/
						
	function layout_full($content) {
		global $idn;
		?>
			<!-- layout -->
				<div class="layout full">
				
					<input type="hidden" name="elements[<?php echo $idn; ?>]" class="wid-parent" />
						<input type="hidden" name="elements[<?php echo $idn; ?>][0]" value="layout" class="wid-1" />
						<input type="hidden" name="elements[<?php echo $idn; ?>][1]" value="full" class="wid-2" />
							<div class="layout-content">
							<?php
							echo $content;
							?>
							</div> <!-- .layout-content -->
							<div class="layout-control">
								<?php require("select-widgets.php"); ?>
								<a href="#" class="add_widget_layout" id="">Add Widget</a>
							</div> <!-- layout.control -->
				</div>
				<script>
					idn++;
				</script>				
		<?php
	}
	
	/***************************************************************************/
	
	function layout_columns($content, $type) {
		global $idn;
		if($type == "full") {
			layout_full($content);
			return; 
		}
		?>
			<!-- layout -->
				<div class="layout <?php echo str_replace("_last", " last", $type); ?>">
				
					<input type="hidden" name="elements[<?php echo $idn; ?>]" class="wid-parent" />
						<input type="hidden" name="elements[<?php echo $idn; ?>][0]" value="layout" class="wid-1" />
						<input type="hidden" name="elements[<?php echo $idn; ?>][1]" value="<?php echo $type; ?>" class="wid-2" />
							<div class="layout-content">
								<?php echo $content; ?>
							</div> <!-- .layout-content -->
							<div class="layout-control">
								<?php require("select-widgets.php"); ?>
								<a href="#" class="add_widget_layout" id="">Add Widget</a>
							</div> <!-- layout.control -->
				</div> 
				<script>
					idn++;
				</script>	
		<?php
		
	}
	
?>