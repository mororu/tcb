<?php
	
	namespace ch\tcbuttisholz\tcbtcr\lib;
	
	use ch\tcbuttisholz\tcbtcr\lib\Hour;
	use \ArrayIterator;
	use \IteratorAggregate;
	
	class Day implements \IteratorAggregate {
		
		/**
		 * @private
		 * Debugger instance
		 */
		 private $debugger;
		 
		/**
		 * @private
		 * Timestamp of the day 
		 */
		 private $timestamp;
		
		/**
		 * @private 
		 * Weekday as string
		 */
		 private $weekday;
		 
		/**
		 * @private 
		 * Array of hours
		 */
		 private $hours = array();
		 
		/**
		 * @public 
		 * Day constructor
		 * 
		 * @param $debugger debugger object
		 * @param $timestamp timestamp of the day
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 16.02.2014
		 */
		 public function __construct($timestamp, $debugger) {
		 	$this->timestamp = $timestamp;
		 	$this->debugger = $debugger;
		 }
		 
		/**
		 * @public static 
		 * Sets the properties and returns the object
		 * 
		 * @param $timestamp timespan of the calendarday
		 * @param $debugger debugger object
		 * @return class instance
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 16.02.2014
		 */
		 public static function createDay($timestamp, $debugger) {
		 	$day = new Day($timestamp, $debugger);
			
			$startHour = $timestamp;
			
			for($i=0; $i<=14; $i++) {
				$day->addHour(Hour::createHour(strtotime('+'.$i.' hours', $startHour), $debugger));
			}
			
			return $day;
		 }
		 
		/**
		 * @public 
		 * Gets the german weekday of the timestamp
		 * 
		 * @return German weekday name
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 16.02.2014
		 */
		 public function getWeekday() {
		 	$weekdays[0] = 'Sonntag';
			$weekdays[1] = 'Montag';
			$weekdays[2] = 'Dienstag';
			$weekdays[3] = 'Mittwoch';
			$weekdays[4] = 'Donnerstag';
			$weekdays[5] = 'Freitag';
			$weekdays[6] = 'Samstag';
			
			$this->weekday = $weekdays[date("w", $this->timestamp)];
			return $this->weekday;
		 }
		 
		/**
		 * @public 
		 * Gets the german date format of the timestamp
		 * 
		 * @return Timestamp in dateformat dd.mm.YYYY
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 16.02.2014
		 */
		 public function getDate() {
		 	return date('d.m.Y', $this->timestamp);
		 }
		 
		/**
		 * @public 
		 * Returns the hours array
		 * 
		 * @return $hours
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 16.02.2014
		 */
		 public function getHours() {
		 	return $this->hours;
		 }
		 
		/**
		 * @public 
		 * Adds an hour object to the hour array
		 * 
		 * @param hour instance
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 16.02.2014
		 */
		 public function addHour($hour) {
		 	array_push($this->hours, $hour);
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
			 return new ArrayIterator($this->hours);
		 }
	}
