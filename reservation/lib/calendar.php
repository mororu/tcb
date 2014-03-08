<?php
	
	namespace ch\tcbuttisholz\tcbtcr\lib;
	
	use ch\tcbuttisholz\tcbtcr\lib\Day;
	use \ArrayIterator;
	use \IteratorAggregate;
	
	class Calendar implements \IteratorAggregate {
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
		 
		 
		 /**
		  * Returns an ArrayIterator for the daycollection
		  * 
		  * @access public
		  * @return Iterator for day array
		  *
		  * @author Manuel Wyss
		  * @version 0.1, 28.02.2014		  
		  */
		 public function getIterator() {
			 return new ArrayIterator($this->days);
		 }
		 
		 
		 public $bookings;
		 
		 public function compareCalendarWithBookings($bookings) {
			 
			 $iterator = $this->getIterator();
			 $this->bookings = $bookings;
			 
			 foreach($iterator as $key=>$object) {

				 $this->recursive($object);				 
			 }
		 }
		 
		 private function recursive($object) {
			 		 
			 if ($object instanceof IteratorAggregate) {
			 
				 foreach($object->getIterator() as $key=>$obj) {
					 $this->recursive($obj);
				 }
				 
			 } else {
			 	$this->checkCourtBooking($object);	 
			 }
		 }
		 
		 private function checkCourtBooking($court) {
								 		 
			foreach($this->bookings as $booking) {
				 if ($booking->getId() == $court->getId()) {
					$court->setBooking($booking);
				 }
			}
		 }
		
	}
?>