<?php
	/**
	 * Reservation Class 
	 *
	 * Business class for reservation
	 * 
	 * @author Manuel Wyss <wyssmanuel@me.com>
	 * @copyright 2014 Manuel Wyss
	 * @version 1.0
	 * @link
	 */	
	
	class Reservation {
		
		private $reservationId;
		private $timestamp;
		private $date;
		private $begin;
		private $end;
		private $type;
		private $court;
		private $description;
		private $players = array();
		
		public function __construct($id) {
			echo 'Construct';
			$this->reservationId = $id;
			$this->timestamp = substr($id, 0, -1);
			$this->date = date('Y-m-d', $this->timestamp);
			$this->begin = date('H', $this->timestamp);
			$this->end = $this->begin + 1;
			$this->court = substr($id, -1);
		}	
		
		public function Create() {
			
		}	
	}
	
?>