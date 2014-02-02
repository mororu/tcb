<?php
	namespace ch\tcbuttisholz\util\debug;
	
	/**
	 * Debug interface
	 */
	interface Debugger {
		public function debug($message);
	}
	
	class DebuggerFactory {
			
		static public function createDebugger($type, $logfile = null) {
			switch(strtolower($type)) {
				case 'echo':
					$debugger = TcbTcrPrint::getInstance();
					break;
				case 'log':
					$debugger = TcbTcrLogger::getInstance($logfile);
					break;
				default:
					throw new UnknownDebuggerException();				
			}
			return $debugger;
		}		
	}	
		
	/**
	 * Print the debug information in the browser
	 */
	class TcbTcrPrint implements Debugger {
	
		private static $instance = null;
		
		protected function __construct() {}
		
		private function __clone() {}
	
		public static function getInstance() {
			if(self::$instance == null) {
				self::$instance = new TcbTcrPrint();
			}
			return self::$instance;
		}
			
		public function debug($message) {
			echo "{$message}<br />";
		}
	}
	
	/**
	 * Logging the debug information into logfile
	 */
	class TcbTcrLogger implements Debugger {
		
		protected $logfile = null;
		private static $instances = array();
		
		public static function getInstance($logfile) {
			if (!isset(self::$instances[$logfile])) {
				self::$instances[$logfile] = new TcbTcrLogger($logfile);
			}
			return self::$instances[$logfile];
		}
		
		protected function __construct($logfile) {
			$this->logfile = $logfile;
		}
		
		private function __clone() {}
		
		public function debug($message) {
			$date = date('Y-m-d');
			$datetime = date('Y-m-d H:i:s');
			error_log("{$datetime}|{$message}\n", 3, $this->logfile);
		}
	}

?>