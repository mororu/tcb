<?php

	function render($template, $list = array()) {

	//	extract($vars);
	//	print_r($day);
		
		if(is_array($list)){
		
			// If an array was passed, it will loop
			// through it, and include a partial view
			foreach($list as $item){
			
				// This will create a local variable
				// with the name of the object's class
			
				$cl = strtolower(get_class($k));
				$$cl = $k;
			
				include "$template.php";
			}
		}		
	}
	
	function writeLine($message) {
		echo $message . '<br />';
	}
	
?>