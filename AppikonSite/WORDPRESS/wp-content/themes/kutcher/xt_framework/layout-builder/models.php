<?php
	
	?>
	<script>
		var idn = 0;
	</script>
	<?php

	if($elements != "") :
				
		include("admin_widgets.php");
		include("admin_layouts.php");
				
		function readWidget($w) {
			$class = $w[1];
			$content = $w[2];
			$title = $w[3];
			$fn = 'widget_'.$class;
			return $fn($content, $title);
			//return $class.$content;
		}
						
		function readLayout($l) {
			$class = $l[1];
			$widgets = $l[2];
					
			$off = 0;
			$c = 0;
			$length = count($widgets);
			$output = '';
			
			global $idn;
			while($c < $length) {
				$output .= readWidget(array_slice($widgets, $off, 4));
				$c += 4;
				$off += 4;
			}
									
			//$fn = 'layout_'.$class;
			//$fn($output);
			layout_columns($output, $class);
			$idn++;
		}
						
			layout_b();
			$num = count($elements);
			$i = 0;
			//echo '<p>Begin</p>';
		foreach($elements as $element) {
			
			if($element[0] == "layout") {
				$i++;
				readLayout($element);
			}	
			if(strpos($element[1],"last") > 0 || $element[1] == "full")
			{
				
				layout_e();
				//echo '<p>End</p>';
				//echo '<p>Begin</p>'.($i).'-'.$num;
				if(($i) != $num || $i > $num)
					layout_b();
			}
		}
		
		
	endif;
?>