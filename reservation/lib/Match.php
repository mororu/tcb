<?php
	/**
	 * Match Class 
	 *
	 * Business class for Match
	 * 
	 * @author Manuel Wyss <wyssmanuel@me.com>
	 * @copyright 2014 Manuel Wyss
	 * @version 1.0
	 */	
	 
	namespace ch\tcbuttisholz\tcbtcr\lib;
	
	use ch\tcbuttisholz\tcbtcr\utils\AbstractDomainObject;
	
	class Match extends AbstractDomainObject {
	
		/**
		 * @private
		 * Booking Id
		 */
		 private $bookingId;
		 
		/** 
		 * @private
		 * Player Id
		 */
		 private $playerId;
	
		/**
		 * @public 
		 * Constructor
		 */
		 public function __construct() {
		 	
		 }
		 
		/**
		 * @public
		 * Set the booking id
		 *
		 * @param $bookingId
		 *
		 * @author Manuel Wyss
		 * @version 0.1, 08.03.2014
		 */
		 public function setBookingId($bookingId) {
			 $this->bookingId = $bookingId;
		 }
		 
		/**
		 * @public
		 * Returns the booking id
		 *
		 * @return $bookingId
		 *
		 * @author Manuel Wyss
		 * @version 0.1, 08.03.2014
		 */
		 public function getBookingId() {
			 return $this->bookingId;
		 }
		 	
		/**
		 * @public
		 * Set the player id
		 *
		 * @param $playerId
		 *
		 * @author Manuel Wyss
		 * @version 0.1, 08.03.2014
		 */
		 public function setPlayerId($playerId) {
			 $this->playerId = $playerId;
		 }
	
		/**
		 * @public
		 * Returns the player id
		 *
		 * @return $playerId
		 *
		 * @author Manuel Wyss
		 * @version 0.1, 08.03.2014
		 */
		 public function getPlayerId() {
			 return $this->playerId;
		 }
	}
?>