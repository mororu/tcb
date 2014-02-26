<?php
	/**
	 * Booking Class 
	 *
	 * Business class for Booking
	 * 
	 * @author Manuel Wyss <wyssmanuel@me.com>
	 * @copyright 2014 Manuel Wyss
	 * @version 1.0
	 * @link
	 */	
	
	namespace ch\tcbuttisholz\tcbtcr\application;
	
	use ch\tcbuttisholz\tcbtcr\application\Player;
	
	class Booking {
		
		/**
		 * @private
		 * timestamp of booking
		 */
		 private $timestamp;
		 
		/**
		 * @private
		 * Date of booking 
		 */
		 private $date;
		 
		/**
		 * @private
		 * Number of court
		 */
		 private $courtNr;
		 
		/**
		 * @private 
		 * Booking description
		 */
		 private $description;
		 
		/** 
		 * @private
		 * Booking type, 0 = single, 1 = double, 2 = other
		 */
		 private $bookingType;
		 
		/**
		 * @private
		 * Players
		 */
		 private $players = array();
	
		/**
		 * @public 
		 * Constructor
		 */
		 public function __construct() {
		 	
		 }
		 
		/**
		 * @public 
		 * setId
		 * 
		 * @param $id Id of the booking
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014 
		 */
		 public function setId($id) {
		 	$this->id = $id;
		 }
		 
		/**
		 * @public
		 * Set the timestamp 
		 * 
		 * @param $timestamp
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function setTimestamp($timestamp) {
		 	$this->timestamp = $timestamp;
		 }
		 
		 /**
		 * @public
		 * Returns the timestamp of the booking 
		 * 
		 * @return $timestamp
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function getTimestamp() {
		 	return $this->timestamp;
		 }
		
		/**
		 * @public
		 * Set the date of booking
		 * 
		 * @param $date
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function setDate($date) {
		 	$this->date = $date;
		 }
		 
		 /**
		 * @public
		 * Returns the date of the booking 
		 * 
		 * @return $date
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function getDate() {
		 	return $this->date;
		 }
		 
		/**
		 * @public
		 * Set the courtNr 
		 * 
		 * @param $courtNr
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function setCourtNr($courtNr) {
		 	$this->courtNr = $courtNr;
		 }
		 
		/**
		 * @public
		 * Returns the courtNr of the booking 
		 * 
		 * @return $courtNr
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function getCourtNr() {
		 	return $this->courtNr;
		 }
		 
		/**
		 * @public
		 * Set the description of the booking 
		 * 
		 * @param $description
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function setDescription($description) {
		 	$this->description = $description;
		 }
		 
		/**
		 * @public
		 * Returns the description of the booking 
		 * 
		 * @return $description
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function getDescription() {
		 	return $this->description;
		 }
		 
		/**
		 * @public
		 * Set the booking type 
		 * 
		 * @param $bookingType
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function setBookingType($bookingType) {
		 	$this->bookingType = $bookingType;
		 }
		 
		/**
		 * @public
		 * Returns the booking type of the booking 
		 * 
		 * @return $bookingType
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function getBookingType() {
		 	return $this->bookingType;
		 }
		
		/**
		 * @public
		 * Adds a player to the players array
		 * 
		 * @param $player
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 22.02.2014
		 */
		 public function addPlayer(Player $player) {
		 	array_push($this->players, $player);
		 }
		 
	}
	
?>