<?php
	
	namespace ch\tcbuttisholz\tcbtcr\lib;
			
	use ch\tcbuttisholz\tcbtcr\utils\AbstractMapper;
	use ch\tcbuttisholz\tcbtcr\utils\AbstractDomainObject;
	use ch\tcbuttisholz\tcbtcr\lib\Match;

	class MatchMapper extends AbstractMapper {
	
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
		 
		 public function createObject() {}
		 
		 public function populate(AbstractDomainObject $obj, $data) {}
		 
		/**
		 * @protected 
		 * Inserts a match record into the database
		 * 
		 * @param $obj
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 08.03.2014
		 */
		 protected function insertObject(AbstractDomainObject $obj) {
		 	$data = array($obj->getBookingId(), $obj->getPlayerId());
			$statement = "INSERT INTO matches (mat_boo_id, mat_pla_id) VALUES (?,?)";
			return $this->db->modify($statement, $data);
		 }
		 
		 protected function updateObject(AbstractDomainObject $obj) {
		 }
		 
		 /**
		 * @protected 
		 * Deletes a match record
		 * 
		 * @param $obj
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 08.03.2014
		 */
		 protected function deleteObject(AbstractDomainObject $obj) {
		 	$data = array($obj->getId());
			$statement = "DELETE FROM matches WHERE mat_id = ?";
			$this->db->modify($statement, $data);
		 }
	}	
?>