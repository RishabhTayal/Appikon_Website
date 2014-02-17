		
		<?php function column($type) { ?>
		
			<!-- layout -->
				<div class="layout columns <?php echo str_replace("_last", " last", $type); ?>">
				
					<input type="hidden" name="" class="wid-parent" />
						<input type="hidden" name="" value="layout" class="wid-1" />
						<input type="hidden" name="" value="<?php echo $type; ?>" class="wid-2" />
							<div class="layout-content">
								
							</div> <!-- .layout-content -->
							<div class="layout-control">
								<?php require("select-widgets.php"); ?>
								<a href="#" class="add_widget_layout" id="">Add Widget</a>
							</div> <!-- layout.control -->
				</div> 
		
		<?php } ?>
		
		<!-- rich text -->
			<div id="rich_text">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				<!-- widget -->
				<div class="wpts-widget rich_text">
				
				<input type="hidden" name="" class="wid-parent" />
					<h6><a href="#" class="edit-widget">Editor</a><a href="#" class="remove-widget">X</a></h6>
					<input type="hidden" name="" value="widget" class="wid-1" />
					<input type="hidden" name="" value="rich_text" class="wid-2" />
					<textarea name="" class="wid-3"></textarea>
					<input class="wid-title" type="hidden" value="" name="" />
				</div>
			</div> <!-- .row -->
			</div>
		
		<!-- line -->
	
			<div id="divider_line">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				<!-- widget -->
				<div class="wpts-widget divider_line">
				
				<input type="hidden" name="" class="wid-parent" />
					<h6>Divider Line<a href="#" class="remove-widget">X</a></h6>
					<input type="hidden" name="" value="widget" class="wid-1" />
					<input type="hidden" name="" value="divider_line" class="wid-2" />
					<textarea name="" class="wid-3">[xt_divider style="normal"]</textarea>
					<input class="wid-title" type="hidden" value="" name="" />
				</div>
			</div> <!-- .row -->
			</div>

		<!-- dotted -->
	
			<div id="divider_dotted">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				<!-- widget -->
				<div class="wpts-widget divider_dotted">
				
				<input type="hidden" name="" class="wid-parent" />
					<h6>Divider Dotted<a href="#" class="remove-widget">X</a></h6>
					<input type="hidden" name="" value="widget" class="wid-1" />
					<input type="hidden" name="" value="divider_dotted" class="wid-2" />
					<textarea name="" class="wid-3">[xt_divider style="dotted"]</textarea>
					<input class="wid-title" type="hidden" value="" name="" />
				</div>
			</div> <!-- .row -->
			</div>

		<!-- shadow -->
	
			<div id="divider_shadow">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				<!-- widget -->
				<div class="wpts-widget divider_shadow">
				
				<input type="hidden" name="" class="wid-parent" />
					<h6>Divider Shadow<a href="#" class="remove-widget">X</a></h6>
					<input type="hidden" name="" value="widget" class="wid-1" />
					<input type="hidden" name="" value="divider_shadow" class="wid-2" />
					<textarea name="" class="wid-3">[xt_divider style="shadow"]</textarea>
					<input class="wid-title" type="hidden" value="" name="" />
				</div>
			</div> <!-- .row -->
			</div>

		<!-- vertical_line -->
	
			<div id="divider_vertical_line">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				<!-- widget -->
				<div class="wpts-widget divider_vertical_line">
				
				<input type="hidden" name="" class="wid-parent" />
					<h6>Divider Vertical Line<a href="#" class="remove-widget">X</a></h6>
					<input type="hidden" name="" value="widget" class="wid-1" />
					<input type="hidden" name="" value="divider_vertical_line" class="wid-2" />
					<textarea name="" class="wid-3">[xt_divider style="vertical-line"]</textarea>
					<input class="wid-title" type="hidden" value="" name="" />
				</div>
			</div> <!-- .row -->
			</div>

		<!-- empty -->
			
			<div id="divider_empty">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				<!-- widget -->
				<div class="wpts-widget divider_empty">
				
				<input type="hidden" name="" class="wid-parent" />
					<h6>Empty Space<a href="#" class="remove-widget">X</a></h6>
					<input type="hidden" name="" value="widget" class="wid-1" />
					<input type="hidden" name="" value="divider_empty" class="wid-2" />
					<textarea name="" class="wid-3">[xt_empty_space]</textarea>
					<input class="wid-title" type="hidden" value="" name="" />
				</div>
			</div> <!-- .row -->
			</div>
		
		<!-- full -->
		
		<div id="full">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				<!-- layout -->
				<div class="layout full">
				
					<input type="hidden" name="" class="wid-parent" />
						<input type="hidden" name="" value="layout" class="wid-1" />
						<input type="hidden" name="" value="full" class="wid-2" />
							<div class="layout-content">
								
							</div> <!-- .layout-content -->
							<div class="layout-control">
								<?php require("select-widgets.php"); ?>
								<a href="#" class="add_widget_layout" id="">Add Widget</a>
							</div> <!-- layout.control -->
				</div> 
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
<!-------------------------------
---------------------------------
	2 COLUMNS
---------------------------------
--------------------------------->

		<!-- 50% 50% -->
		
		<div id="50_50">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_half"); ?>
				
				<?php column("one_half_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>

		<!-- 25% 75% -->
		
		<div id="25_75">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_fourth"); ?>
				
				<?php column("three_fourth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
		<!-- 75% 25% -->
		
		<div id="75_25">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("three_fourth"); ?>
				
				<?php column("one_fourth_last"); ?>

				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
		<!-- 66% 33% -->
		
		<div id="66_33">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("two_third"); ?>
				
				<?php column("one_third_last"); ?>

				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
		<!-- 33% 66%-->
		
		<div id="33_66">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_third"); ?>
				
				<?php column("two_third_last"); ?>

				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
		<!-- 20 80-->
		
		<div id="20_80">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_fifth"); ?>
				
				<?php column("four_fifth_last"); ?>

				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
		<!-- 80 20-->
		
		<div id="80_20">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("four_fifth"); ?>
				
				<?php column("one_fifth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>

<!-------------------------------
---------------------------------
	3 COLUMNS
---------------------------------
--------------------------------->		

	<!-- 33% 33% 33% -->
	
		<div id="33_33_33">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_third"); ?>
			
				<?php column("one_third"); ?>
				
				<?php column("one_third_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
	<!-- 25 25 50 -->
	
		<div id="25_25_50">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_fourth"); ?>
			
				<?php column("one_fourth"); ?>
				
				<?php column("one_half_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
	<!-- 25 50 25 -->
	
		<div id="25_50_25">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_fourth"); ?>

				<?php column("one_half"); ?>
				
				<?php column("one_fourth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
	<!-- 50 25 25 -->
	
		<div id="50_25_25">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_half"); ?>
				
				<?php column("one_fourth"); ?>
				
				<?php column("one_fourth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
	<!-- 20 20 60 -->
	
		<div id="20_20_60">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_fifth"); ?>
				
				<?php column("one_fifth"); ?>
				
				<?php column("three_fifth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
	<!-- 20 60 20 -->
	
		<div id="20_60_20">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_fifth"); ?>

				<?php column("three_fifth"); ?>
				
				<?php column("one_fifth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
	<!-- 60 20 20 -->
	
		<div id="60_20_20">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("three_fifth"); ?>
				
				<?php column("one_fifth"); ?>

				<?php column("one_fifth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
<!-------------------------------
---------------------------------
	4 COLUMNS
---------------------------------
--------------------------------->		

	<!-- 25 25 25 25 -->
	
		<div id="25_25_25_25">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_fourth"); ?>
			
				<?php column("one_fourth"); ?>
				
				<?php column("one_fourth"); ?>
				
				<?php column("one_fourth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
	<!-- 20 20 20 40 -->
	
		<div id="20_20_20_40">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_fifth"); ?>
			
				<?php column("one_fifth"); ?>
				
				<?php column("one_fifth"); ?>
				
				<?php column("two_fifth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
	<!-- 20 20 40 20 -->
	
		<div id="20_20_40_20">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_fifth"); ?>
			
				<?php column("one_fifth"); ?>
				
				<?php column("two_fifth"); ?>
				
				<?php column("one_fifth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
	<!-- 20 40 20 20 -->
	
		<div id="20_40_20_20">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_fifth"); ?>
			
				<?php column("two_fifth"); ?>
				
				<?php column("one_fifth"); ?>
								
				<?php column("one_fifth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
	<!-- 40 20 20 20 -->
	
		<div id="40_20_20_20">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("two_fifth"); ?>
				
				<?php column("one_fifth"); ?>

				<?php column("one_fifth"); ?>
								
				<?php column("one_fifth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>	
		
		
		<!-- 20_20_20_20_20 -->
		
		<div id="20_20_20_20_20">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_fifth"); ?>
				
				<?php column("one_fifth"); ?>
				
				<?php column("one_fifth"); ?>
				
				<?php column("one_fifth"); ?>
								
				<?php column("one_fifth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>
		
		<!-- 15_15_15_15_15_15 -->
		
		<div id="15_15_15_15_15_15">
			<div class="row">
				<div class="remove-wrap"><a href="#" class="remove-row">X</a></div>
				
				<?php column("one_sixth"); ?>
				
				<?php column("one_sixth"); ?>
				
				<?php column("one_sixth"); ?>
				
				<?php column("one_sixth"); ?>
				
				<?php column("one_sixth"); ?>
								
				<?php column("one_sixth_last"); ?>
				
				<div class="builder-clear"></div>
			</div> <!-- .row -->
		</div>