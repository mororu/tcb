<?php
	
	namespace ch\tcbuttisholz\tcbtcr\lib;
	
	use ch\tcbuttisholz\tcbtcr\lib\Booking;
	use ch\tcbuttisholz\tcbtcr\lib\Court;
	use \ArrayIterator;
	use \IteratorAggregate;
		
	class Hour implements \IteratorAggregate {
		
		/**
		 * @private 
		 * Timestamp of the created hour
		 */
		 private $timestamp;
		 
		/**
		 * @private 
		 * Starttime of the hour
		 */
		 private $startTime;
		 
		/**
		 * @private
		 * Endtime of the hour
		 */
		 private $endTime;
		 
		/**
		 * @private
		 * Debugger 
		 */
		 private $debugger;
		
		/** 
		 * @private
		 * Array of courts
		 */
		 private $courts = array();
		 
		/**
		 * @public 
		 * Constructor
		 * 
		 * @param $debugger debugger instance
		 * @param $timestamp timestamp of the hour
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 16.02.2014
		 */
		 public function __construct($timestamp, $debugger) {
		 	$this->timestamp = $timestamp;
			$this->debugger = $debugger;
		 }
		 
		/**
		 * @public
		 * Get the timestamp of the hour
		 * 
		 * @return $timestamp
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function getTimestamp() {
		 	return $this->timestamp;
		 }
		 
		/**
		 * @public abstract
		 * Instantiate a new hour object and returns it
		 * 
		 * @param $timestamp timestamp for the hour
		 * @param $debugger debugger instance
		 * @return the hour object
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 16.02.2014
		 */
		 public static function createHour($timestamp, $debugger) {
		 	$hour = new Hour($timestamp, $debugger);
			
			for($i=1; $i<=3; $i++) {
				$hour->addCourt(Court::createCourt($timestamp, $i));
			}
			
			return $hour;		 	
		 }
		 
		/**
		 * @public 
		 * Adds a court object to the courts array
		 * 
		 * @param court instance
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function addCourt($court) {
		 	array_push($this->courts, $court);
		 }
		 
		/**
		 * @public
		 * Returns the startTime of timestamp in the format HH:mm
		 * 
		 * @return time string in format HH:MM
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 16.02.2014
		 */
		 public function getStartTime() {
		 	$this->startTime = $this->timestamp;
		 	return date('H:i', $this->startTime);
		 }
		 
		 /**
		 * @public
		 * Returns the end time of the hour object.
		 * end time -> timestamp + 1 hour
		 * 
		 * @return time string in format HH:MM
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 16.02.2014
		 */
		 public function getEndTime() {
		 	$this->endTime = strtotime('+ 1 hour', $this->timestamp);
			return date('H:i', $this->endTime);
		 }
		 
		/**
		 * @public 
		 * Returns the court array
		 * 
		 * @return $courts
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function getCourts() {
		 	return $this->courts;
		 }
		 
		 
		 /**
		  * Return an ArrayIterator of the courtcollection
		  * 
		  * @access public
		  * @return ArrayIterator of courtcollection
		  *
		  * @author Manuel Wyss
		  * @version 0.1, 28.02.2014
		  */
		 public function getIterator() {
			 return new ArrayIterator($this->courts);
		 }
		 
		 
		 /**
		  * Checks if the current hour has free courts
		  * 
		  * @access public
		  * @return void
		  */
		 public function hasFreeCourts() {
			 
			 $hasFreeCourts = false;
			 
			 if ($this->courts) {
				 foreach($this->courts as $court) {
					 if($court->getBooking() == null) {
						 $hasFreeCourts = true;
						 break;
					 }
				 }
			 } 
			 return $hasFreeCourts;			
		 }
	}
?>