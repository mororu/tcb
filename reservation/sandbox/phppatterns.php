<html>
	<head>
		<title>JQM</title>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
	</head>
	<body>
		<div id="index=" data-role="page" style="padding: 20px;">
<?php
	
	include('utils/debugger.php');
	include('utils/abstract.php');
	include('utils/renderer.php');
	
	use ch\tcbuttisholz\util\debug\TcbTcrPrint;
	use ch\tcbuttisholz\util\debug\TcbTcrLogger;
	use ch\tcbuttisholz\util\debug\DebuggerFactory;
	use ch\tcbuttisholz\util\business\Day;
	use ch\tcbuttisholz\util\business\Hour;
	use ch\tcbuttisholz\util\business\Booking;
	use ch\tcbuttisholz\util\renderer\Renderer;
	
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
	
	$calendar = array();
	
	for ($i=0; $i<3; $i++) {
		$calendar[] = Day::getDayList(strtotime('+'.$i.' days', $day), $debugger)->getHoursPerDay(7,10);
	}		
	
	//$obj = Day::getDay($day, $debugger)->getHoursPerDay(10,10);
	
	$renderer = new Renderer($debugger);
	
	$renderer->renderDayList($calendar);
	
	print_r($obj);

	
?>
		</div>
	</body>
</html>