<?php 
	
	class Booking {
		
		protected $id;
		protected $day;
		protected $time;
		protected $court;
		protected $players = array(); // Array of players
		protected $description;
		protected $bookingType;
		protected $debugger;
		protected $logger;
		
		public function __construct($debugger) {
			$this->debugger = $debugger;
		}
		
		public function addToPlayers($id, Player $player) {
			$this->players[$id] = $player;
		}
		
		public function setLogger(Logger $logger) {
			$this->logger = $logger;
		}
	}
	
	class Player {
		
		protected $id;
		protected $name;
		protected $surname;
		
		public function __construct() {
			
		}
	}
	
	interface Logger {
		const LEVEL_INFO = 1;
		const LEVEL_WARN = 2;
		const LEVEL_ERROR = 4;
		
		public function logEntry($level, $message);
	}
	
	class DateTimeLogger implements Logger {
		public function logEntry($level, $message) {
			$date = date('Y-m-d');
			$datetime = date('Y-m-d H:i:s');
			error_log("{$datetime}|{$text}\n", 3, "./TcbTcr-{$date}.log");
		}
	}

	interface Debugger {
		public function debug($message);
	}
	
	class TcbTcrEcho implements Debugger {
		public function debug($message) {
			echo "{$message}\n";
		}
	}
	
	class TcbTcrLog implements Debugger {
		public function debug($message) {
			error_log(date('Y-m-d H:i:s').": {$message}\n", 3, './TcbTcr.log');
		}
	}

?>