<?php
	
	include('debugger.php');
	include('abstract.php');
	
	use ch\tcbuttisholz\util\debug\TcbTcrPrint;
	use ch\tcbuttisholz\util\debug\TcbTcrLogger;
	use ch\tcbuttisholz\util\debug\DebuggerFactory;
	use ch\tcbuttisholz\util\business\Day;
	use ch\tcbuttisholz\util\business\Hour;
	use ch\tcbuttisholz\util\business\Booking;
	
	error_reporting(E_ALL);		
	
	/* Singleton Aufruf
	 * ----------------
	const DEBUG_MODE = 'log';			
	switch (DEBUG_MODE) {
		case 'debug':
			$debugger = TcbTcrPrint::getInstance();
			break;
		case 'log':
			$debugger = TcbTcrLogger::getInstance('./TcbTcr.log');
			break;
	}
	*/
	
	$day = strtotime(date('Y-m-d 00:00:00'));
	
	define('DEBUG_MODE', 'echo');
	$debugger = DebuggerFactory::createDebugger(DEBUG_MODE, 'TcbTcr.log');
			
	$obj = Day::getDay($day, $debugger)->getHoursPerDay(7,10);
	
	print_r($obj);

	
?>