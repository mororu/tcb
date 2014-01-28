<?php
	
	include('debugger.php');
	
	use ch\tcbuttisholz\util\debug\TcbTcrPrint;
	use ch\tcbuttisholz\util\debug\TcbTcrLogger;
	use ch\tcbuttisholz\util\debug\DebuggerFactory;
	
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
	
	define('DEBUG_MODE', 'log');
	$debugger = DebuggerFactory::createDebugger(DEBUG_MODE, 'TcbTcr.log');
	
	print_r($debugger);
	$debugger->debug('Die Macht sei mit dir: '.get_class($debugger));

	
?>