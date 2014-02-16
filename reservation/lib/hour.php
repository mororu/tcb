<?php
	
	namespace ch\tcbuttisholz\tcbtcr\lib;
	
	class Hour {
		
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
		 	return new Hour($timestamp, $debugger);
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
		 
	}
?>