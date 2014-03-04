<?php
	
	namespace ch\tcbuttisholz\tcbtcr\lib;
			
	use ch\tcbuttisholz\tcbtcr\utils\AbstractMapper;
	use ch\tcbuttisholz\tcbtcr\utils\AbstractDomainObject;
	use ch\tcbuttisholz\tcbtcr\lib\Player;
	
	class PlayerMapper extends AbstractMapper {
		
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
		 	
			$statment = "SELECT * FROM players WHERE pla_id = ?";
			$data = array($id);
			
			$row = $this->db->select($statment, $data);
			
			return $this->create($row[0]);
		 }
		 
		/**
		 * @public 
		 * Get all players for a match
		 * 
		 * @param $bookingId
		 * @return player records
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 02.03.2014
		 */
		 public function findPlayers($bookingId) {
		 
		 	$this->debugger->debug("findPlayers: {$bookingId}");
		 		
		 	$players = array();	
		 	$data = array($bookingId);
			
			$statement = "SELECT pla_id, pla_name, pla_firstname, pla_email 
							FROM players 
						   INNER JOIN matches ON mat_pla_id = pla_id
						   INNER JOIN bookings ON mat_boo_id = boo_id
						   WHERE boo_id = ?";
						   
			$records = $this->db->select($statement, $data);
			$this->debugger->debug("Players found: ".count($records));
			
			foreach($records as $row) {
				$player = $this->create($row);
				$players[] = $player;
			}
			
			return $players;
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
		 	$obj->setName($data->pla_name);
		 	$obj->setFirstName($data->pla_firstname);
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
		 /*	$data = array($obj->getLastName(), $obj->getFirstName(), $obj->getEmail());
			$statement = "INSERT INTO players (pla_name, pla_surname, pla_email) VALUES (?,?,?)";
			$this->db->modify($statement, $data);*/
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
		 	/*$data = array($obj->getLastName(), $obj->getFirstName(), $obj->getEmail(), $obj->getId());
			$statement = "UPDATE players SET pla_name = ?, pla_surname = ?, pla_email = ? WHERE pla_id = ?";
			$this->db->modify($statement, $data);*/
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
		 /*	$data = array($obj->getId());
			$statement = "DELETE FROM players WHERE pla_id = ?";
			$this->db->modify($statement, $data);*/
		 }
		 
		 
	}

?>