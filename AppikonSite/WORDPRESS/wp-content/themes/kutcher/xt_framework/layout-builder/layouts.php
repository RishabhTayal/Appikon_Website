<?php

	/// LAYOUTS
	
	function full($output) {

		$_return = '';

		//$_return .= '<div class="builder-full">';
		$_return .= $output; 
		//$_return .= '</div>';

		return $_return; 
	}
	
	function builder_column($output, $type) {

		$_return = '';

		//var_dump($output);

		if($type == "full") : 
			$_return .= full($output); 
			return $_return; 
		endif;
		
		$class = str_replace("_last", " last", $type);

		$_return .= '<div class="'.$class.'">';
			$_return .= $output; 
		$_return .= '</div>';
		if(strpos($class,"last") > 0) 
			$_return .= '<div class="clearboth"></div>';

		return $_return; 
	}
						
	function one_half($output) {

		$_return = '';

		$_return .= '<div class="one_half">';
		$_return .= $output; 
		$_return .= '</div>';

		return $_return; 
	}
						
	function one_half_last($output) {

		$_return = '';

		$_return .= '<div class="one_half last">';
		$_return .=  $output; 
		$_return .= '</div>';
		$_return .= '<div class="clearboth"></div>';

		return $_return; 
	}
	
	function one_third($output) {

		$_return = '';

		$_return .= '<div class="one_third">';
		$_return .=  $output; 
		$_return .= '</div>';

		return $_return; 
	}
						
	function one_third_last($output) {

		$_return = '';

		$_return .= '<div class="one_third last">';
		$_return .= $output; 
		$_return .= '</div>';
		$_return .= '<div class="clearboth"></div>';

		return $_return; 
	}
						
?>