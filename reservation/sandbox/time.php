<?php 
		
	$time = strtotime("2014-01-27 08:00:00");
	$times = array();
	
	for ($i=0; $i<=10; $i++) {
		$times[] = strtotime("+".$i." hours", $time);
	}
	
	foreach($times as $t) {
		echo date('d.m.Y H:i', $t);
	}
	
?>