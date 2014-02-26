<?php
	
	namespace ch\tcbuttisholz\tcbtcr\utils;
			
	use ch\tcbuttisholz\tcbtcr\utils\AbstractMapper;
	use ch\tcbuttisholz\tcbtcr\utils\AbstractDomainObject;
	
	class BookingMapper extends AbstractMapper {
		
		/**
		 * @private
		 * Database instance
		 */
		 private $db;
		 
		/**
		 * @public
		 * Constructor
		 * 
		 * @param $db
		 * 
		 * @author Manuel Wyss 
		 * @version 0.1, 26.02.2014
		 */
		 public function __construct($db) {
		 	$this->db = $db;
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
		 	$obj->setId($data->pla_id);
			$obj->setFirstName($data->pla_surname);
			$obj->setLastname($data->pla_name);
			$obj->setEmail($data->pla_email);
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
		 	return new Player();
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