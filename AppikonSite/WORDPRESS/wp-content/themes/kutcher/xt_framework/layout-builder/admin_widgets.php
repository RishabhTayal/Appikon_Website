<?php

	/// WIDGETS
						
	function widget_rich_text($content, $title) {
		global $idn;
		global $idw;
		//var_dump($idn);
		/** ul filter **/
		$content = str_replace("<ul>\t", "<ul>", $content);
		$content = str_replace("<ul>\r", "<ul>", $content);
		$content = str_replace("<ul>\n", "<ul>", $content);
		
		/** li filter **/
		$content = str_replace("\t<li>", "<li>", $content);
		$content = str_replace("\r<li>", "<li>", $content);
		$content = str_replace("\n<li>", "<li>", $content);
		
		/** /li filter **/
		$content = str_replace("</li>\t", "</li>", $content);
		$content = str_replace("</li>\r", "</li>", $content);
		$content = str_replace("</li>\n", "</li>", $content);



		$output = '
			
				<div class="wpts-widget rich_text">
				
				<input type="hidden" name="" class="wid-parent" />
					<h6><a href="#" class="edit-widget"># '.stripslashes($title).'</a><a href="#" class="remove-widget">X</a></h6>
					<input class="wid-1" type="hidden" value="widget" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']" />
					<input class="wid-2" type="hidden" value="rich_text" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']" />
					<textarea class="wid-3" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">'.stripslashes($content).'</textarea>
					<input class="wid-title" type="hidden" value="'.stripslashes($title).'" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']" />
				</div>
					<script>
						idn+= 4;
					</script>
		';
		
		return $output;
	}
	
	function widget_divider_line($content) {
		global $idn;
		global $idw;
		$output = '
			<div class="wpts-widget divider_line">
					<h6>Divider Normal<a class="remove-widget" href="#">X</a></h6>
					<input type="hidden" class="wid-1" value="widget" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">
					<input type="hidden" class="wid-2" value="divider_line" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">
					<textarea class="wid-3" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">[xt_divider style="normal"]</textarea>
					<input class="wid-title" type="hidden" value="Divider Normal" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']" />
				</div>
				<script>
					idn+= 4;
				</script>';
				
		return $output;
	}

	function widget_divider_dotted($content) {
		global $idn;
		global $idw;
		$output = '
			<div class="wpts-widget divider_line">
					<h6>Divider Dotted<a class="remove-widget" href="#">X</a></h6>
					<input type="hidden" class="wid-1" value="widget" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">
					<input type="hidden" class="wid-2" value="divider_dotted" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">
					<textarea class="wid-3" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">[xt_divider style="dotted"]</textarea>
					<input class="wid-title" type="hidden" value="Divider Dotted" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']" />
				</div>
				<script>
					idn+= 4;
				</script>';
				
		return $output;
	}

	function widget_divider_shadow($content) {
		global $idn;
		global $idw;
		$output = '
			<div class="wpts-widget divider_line">
					<h6>Divider Shadow<a class="remove-widget" href="#">X</a></h6>
					<input type="hidden" class="wid-1" value="widget" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">
					<input type="hidden" class="wid-2" value="divider_shadow" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">
					<textarea class="wid-3" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">[xt_divider style="shadow"]</textarea>
					<input class="wid-title" type="hidden" value="Divider Shadow" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']" />
				</div>
				<script>
					idn+= 4;
				</script>';
				
		return $output;
	}

	function widget_divider_vertical_line($content) {
		global $idn;
		global $idw;
		$output = '
			<div class="wpts-widget divider_line">
					<h6>Divider Vertical Line<a class="remove-widget" href="#">X</a></h6>
					<input type="hidden" class="wid-1" value="widget" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">
					<input type="hidden" class="wid-2" value="divider_vertical_line" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">
					<textarea class="wid-3" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">[xt_divider style="vertical-line"]</textarea>
					<input class="wid-title" type="hidden" value="Divider Vertical Line" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']" />
				</div>
				<script>
					idn+= 4;
				</script>';
				
		return $output;
	}
	
	function widget_divider_empty($content) {
		global $idn;
		global $idw;
		$output = '
			<div class="wpts-widget divider_empty">
					<h6>Empty Space<a class="remove-widget" href="#">X</a></h6>
					<input type="hidden" class="wid-1" value="widget" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">
					<input type="hidden" class="wid-2" value="divider_empty" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">
					<textarea class="wid-3" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']">[xt_empty_space]</textarea>
					<input class="wid-title" type="hidden" value="Empy Space" name="elements['.$idn.'][2]['; $output .= $idw; $idw++; $output .=']" />
				</div>
				<script>
					idn+= 4;
				</script>';
				
		return $output;
	}
						
?>