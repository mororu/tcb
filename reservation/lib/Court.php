<?php
	
	namespace ch\tcbuttisholz\tcbtcr\lib;
	
	use ch\tcbuttisholz\tcbtcr\lib\Booking;
	
	class Court {
		
		/**
		 * @private
		 * Court id -> timestamp and courtnumber
		 */
		 private $id;
		 
		/**
		 * @private
		 * CourtNr
		 */
		 private $courtNr;
		 
		/**
		 * @private
		 * Timestamp
		 */
		 private $timestamp;
		 
		/**
		 * @private
		 * Booking object
		 */
		 private $booking = null;
		
		/**
		 * @public
		 * Constructor
		 * 
		 * @param $id
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function __construct($timestamp, $courtNr) {
		 	$this->id = $timestamp.$courtNr;
			$this->timestamp = $timestamp;
			$this->courtNr = $courtNr;
		 }
		 
		/**
		 * @public abstract
		 * Instantiate a new court object and returns it
		 * 
		 * @param $timestamp timestamp for the hour
		 * @param $courtNr number of the court
		 * @return the hour object
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public static function createCourt($timestamp, $courtNr) {
		 	return new Court($timestamp, $courtNr);
		 }
		 
		 
		 /**
		  * Returns the court id.
		  * 
		  * @access public
		  * @return $id
		  *
		  * @author Manuel Wyss
		  * @version 0.1, 01.03.2014		  
		  */
		 public function getId() {
			 return $this->id;
		 }
		 
		/**
		 * @public 
		 * Set the booking property
		 * 
		 * @param $booking
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function setBooking($booking) {
		 	$this->booking = $booking;
		 }
		 
		/**
		 * @public
		 * Get the booking object
		 * 
		 * @return $booking
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function getBooking() {
		 	return $this->booking;
		 }
		 
		 /**
		 * @public 
		 * Set the courNr property
		 * 
		 * @param $courtNr
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 02.03.2014
		 */
		 public function setCourNr($courtNr) {
			 $this->courtNr = $courtNr;
		 }
		 
		/**
		 * @public
		 * Returns the courtNr
		 * 
		 * @return $courtNr
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 02.03.2014
		 */
		 public function getCourtNr() {
		 	return $this->courtNr;
		 }
		 
	   /**
		* Returns the timestamp for the court
		*
		* @access public
		* @return $timestamp
		*/
		public function isBookable() {
			$actualTime = strtotime(date('Y-m-d H:i:s'));
			if(($this->timestamp + 1800) > $actualTime) {
				return true;
			}				
			return false;
		}
	}
?>