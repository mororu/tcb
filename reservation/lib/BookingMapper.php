<?php
	
	namespace ch\tcbuttisholz\tcbtcr\lib;
			
	use ch\tcbuttisholz\tcbtcr\utils\AbstractMapper;
	use ch\tcbuttisholz\tcbtcr\utils\AbstractDomainObject;
	use ch\tcbuttisholz\tcbtcr\lib\Booking;
	
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
			
			return $this->create($row[0]);
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
			$this->debugger->debug("Start: {$start}, End: {$end}");
			$data = array($start, $end);
			
			$statement = "SELECT * FROM bookings WHERE boo_timestamp >= ? AND boo_timestamp <= ?";
			$records = $this->db->select($statement, $data);
			$this->debugger->debug(count($records));
			
			foreach($records as $row) {
				$bookings[] = $this->create($row);
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
		 	$obj->setId($data->boo_id);
			$obj->setTimestamp($data->boo_timestamp);
			$obj->setDate($data->boo_date);
			$obj->setCourtNr($data->boo_court);
			$obj->setDescription($data->boo_description);
			$obj->setBookingType($data->boo_type);
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
		 * Inserts a player into the database
		 * 
		 * @param $obj
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 protected function insertObject(AbstractDomainObject $obj) {
		 	$data = array($obj->getLastName(), $obj->getFirstName(), $obj->getEmail());
			$statement = "INSERT INTO players (pla_name, pla_surname, pla_email) VALUES (?,?,?)";
			$this->db->modify($statement, $data);
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
		 	$data = array($obj->getLastName(), $obj->getFirstName(), $obj->getEmail(), $obj->getId());
			$statement = "UPDATE players SET pla_name = ?, pla_surname = ?, pla_email = ? WHERE pla_id = ?";
			$this->db->modify($statement, $data);
		 }
		 
		 /**
		 * @protected 
		 * Deletes a player record
		 * 
		 * @param $obj
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 26.02.2014
		 */
		 protected function deleteObject(AbstractDomainObject $obj) {
		 	$data = array($obj->getId());
			$statement = "DELETE FROM players WHERE pla_id = ?";
			$this->db->modify($statement, $data);
		 }
		 
		 
	}

?>