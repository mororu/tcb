<?php
	
	namespace ch\tcbuttisholz\tcbtcr\lib;
			
	use ch\tcbuttisholz\tcbtcr\utils\AbstractMapper;
	use ch\tcbuttisholz\tcbtcr\utils\AbstractDomainObject;
	use ch\tcbuttisholz\tcbtcr\lib\Booking;
	use ch\tcbuttisholz\tcbtcr\lib\PlayerMapper;
	use ch\tcbuttisholz\tcbtcr\lib\Match;
	use ch\tcbuttisholz\tcbtcr\lib\MatchMapper;
	
	class BookingMapper extends AbstractMapper {
		
		/**
		 * @private
		 * Database instance
		 */
		 private $db;
		 
		/** 
		 * @private 
		 * Debugger instance
		 */
		 private $debugger;
		 
		/**
		 * @public
		 * Constructor
		 * 
		 * @param $db
		 * 
		 * @author Manuel Wyss 
		 * @version 0.1, 26.02.2014
		 */
		 public function __construct($db, $debugger) {
		 	$this->db = $db;
			$this->debugger = $debugger;
		 }
		 
		/**
		 * @public
		 * Find element in database by id
		 * 
		 * @param $id
		 * @return $row entity
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function findById($id) {
		 	
			$statment = "SELECT * FROM bookings WHERE boo_id = ?";
			$data = array($id);
			
			$row = $this->db->select($statment, $data);
			
			if (count($row) == 1) {
				return $this->create($row[0]);				
			} else {
				return $this->create();	
			}
		 }
		  
		/**
		 * @public 
		 * Get all bookings for the next week 
		 * 
		 * @param $start start time
		 * @return $bookings booking records
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function findBookings($start) {
		 		
		 	$bookings = array();	
		 	$end = strtotime('+10 day', $start);
			$data = array($start, $end);
			
			$statement = "SELECT * FROM bookings WHERE boo_timestamp >= ? AND boo_timestamp <= ?";
			$records = $this->db->select($statement, $data);
			
			foreach($records as $row) {
				$booking = $this->create($row);
				$this->loadPlayers($booking);
				$bookings[] = $booking;				
			}
			
			return $bookings;
		 }
		 
		 public function loadPlayers($booking) {
			 			 
			 $playerMapper = new PlayerMapper($this->db, $this->debugger);
			 $booking->setPlayers($playerMapper->findPlayers($booking->getId()));
			 return $booking;
		 }
		 
		 
		 /**
		  * Returns the bookings in the future or in the past
		  * 
		  * @access public
		  * @param mixed $start
		  * @param mixed $future
		  * @return booking array
		  */
		 public function findAllBookings($start, $future) {
			 
			 $bookings = array();
			 $data = array($start);
			 
			 $this->debugger->debug('Future: '.$future.' Timestamp: '.date('d.m.Y H:i', $start));
			 
			 if($future == 'asc') {
				 $statement = "SELECT * FROM bookings WHERE boo_timestamp <= ? ORDER BY boo_date desc, boo_time asc, boo_court asc";
			 } else {
				 $statement = "SELECT * FROM bookings WHERE boo_timestamp >= ? ORDER BY boo_date asc, boo_time asc, boo_court asc";				 
			 }
			 
			 $records = $this->db->select($statement, $data);
			 
			 foreach($records as $row) {
		     	$booking = $this->create($row);
				$this->loadPlayers($booking);
				$bookings[] = $booking; 
			 }
			 return $bookings;
		 }
		 
		/**
		 * @public
		 * Set the properties of the business class
		 * 
		 * @param $obj object instance
		 * @param $data data for the properties
		 * @return $obj
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 public function populate(AbstractDomainObject $obj, $data) {
		 	$obj->setBookingExists(false);
		 	$obj->setId($data->boo_id);
			$obj->setTimestamp($data->boo_timestamp);
			$obj->setDate($data->boo_date);
			$obj->setCourtNr($data->boo_court);
			$obj->setDescription($data->boo_description);
			$obj->setBookingType($data->boo_type);
			
			//$this->debugger->debug($data->boo_description);
			
			return $obj;
		 }
		 
		/**
		 * @protected 
		 * Instantiates a new player
		 * 
		 * @return player instance
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 protected function createObject() {
		 	return new Booking();
		 }
		 
		/**
		 * @protected 
		 * Inserts a booking into the database
		 * 
		 * @param $obj
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 08.03.2014
		 */
		 protected function insertObject(AbstractDomainObject $obj) {
		 	$data = array($obj->getBookingId(), $obj->getTimestamp(), $obj->getDate(), $obj->getStartTime(), $obj->getCourtNr(), $obj->getDescription(), $obj->getBookingType());
			$statement = "INSERT INTO bookings (boo_id, boo_timestamp, boo_date, boo_time, boo_court, boo_description, boo_type) VALUES (?,?,?,?,?,?,?)";
			$this->db->modify($statement, $data);
			
			// Check if the player list is not empty
			if(count($obj->getPlayerIdList()) > 0) {
				$this->createBookingPlayerRelation($obj->getPlayerIdList(), $obj->getBookingId());	
			}
			
			return $obj->getBookingId();
		 }
		 
		 
		 /**
		  * Creates the matches record for the database
		  * 
		  * @access private
		  * @param mixed $playerList
		  * @return void
		  */
		 private function createBookingPlayerRelation($playerList, $bookingId) {

			 $matchMapper = new MatchMapper($this->db, $this->debugger);			 

			 foreach($playerList as $playerId) {		
				 $match = new Match();
				 $match->setBookingId($bookingId);
				 $match->setPlayerId($playerId);
				 $matchMapper->save($match);
			 }			 
		 }
		 
		/**
		 * @protected 
		 * Updates a player record
		 * 
		 * @param $obj
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 protected function updateObject(AbstractDomainObject $obj) {

		 }
		 
		 /**
		 * @protected 
		 * Deletes a booking record
		 * 
		 * @param $obj
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 08.03.2014
		 */
		 protected function deleteObject(AbstractDomainObject $obj) {
		 	$data = array($obj->getId());
			$statement = "DELETE FROM booking WHERE boo_id = ?";
			$this->db->modify($statement, $data);
		 }
		 
		 /**
		  * Deletes a booking an all match relations
		  * 
		  * @access public
		  * @param mixed $bookingId
		  * @return void
		  */
		 public function deleteBooking($bookingId) {
		 	
		 	$this->debugger->debug("Delete with id {$bookingId}");
		 
			 $data = array($bookingId);
			 
			 // Delete matches
			 $statement = "DELETE FROM matches WHERE mat_boo_id = ?";
			 $this->db->delete($statement, $data);
			 
			 // Delete booking
			 $statement = "DELETE FROM bookings WHERE boo_id = ?";
			 $this->db->delete($statement, $data);
	     }		 		 
	}

?>