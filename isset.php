<?php  

// $car_id  = getget('car_id');

	function getIsset ($name, $default='') {
		if(isset($_GET[$name])) {
			return $_GET[$name];
		} 
		return $default;
	}

	function postIsset ($name, $default='') {
		if(isset($_POST[$name]) && $_POST[$name]) {
			return $_POST[$name];
		} 
		return $default;
	}

?>