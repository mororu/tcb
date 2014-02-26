<?php
	
	namespace ch\tcbuttisholz\tcbtcr\lib;
	
	use ch\tcbuttisholz\tcbtcr\lib\Day;
	
	class Calendar {
	    /**
		 * @private 
		 * Debugger instance
		 */
		 private $debugger;
		 
		/**
		 * @private
		 * Array of day objects
		 */
		 private $days = array();
		  
		/**
		 * @public 
		 * Class construction
		 * 
		 * @param $debugger debugger object
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 16.02.2014
		 */
		 public function __construct($debugger) {
		 	$this->debugger = $debugger; 	
		 }
		
		/**
		 * @public 
		 * Creates the calendar list
		 * 
		 * @param $startTime first day of the calendar
		 * @param $daysToDisplay numbers of the days, which should be shown
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 16.02.2014
		 */
		 public function createCalender($startTime, $daysToDisplay) {
		 	
			$timestamp = $startTime;
			
		 	for ($i = 1; $i <= $daysToDisplay; $i++) {
		 		$this->days[] = Day::createDay($timestamp, $this->debugger);
				$timestamp = strtotime('+'.$i.' days', $startTime);
		 	}
			
			$this->debugger->debug("Days: {count($this->days)}");
		 }  
		 
		/**
		 * @public 
		 * Gets the array of the created days
		 * 
		 * @return array with the created day objects
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 16.02.2014
		 */
		 public function getDays() {
		 	return $this->days;
		 }
		
	}
?>