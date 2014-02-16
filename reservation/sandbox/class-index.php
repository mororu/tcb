<?php 
		
	include("class.php");

	const DEBUG_MODE = 'log';
	
	switch (DEBUG_MODE) {
		case 'debug':
			$debugger = new TcbTcrEcho();
			break;
		case 'log':
			$debugger = new TcbTcrLog();
			break;
	}
	
	$booking = new Booking($debugger);
	$logger = new DateTimeLogger();
	$booking->setLogger($logger);
	
	print_r($booking);
	
	echo '<br /><br />';
	
	echo date('d.m.Y H:i', strtotime('now'));
	
?>