<?php
	
	namespace ch\tcbuttisholz\util\business;
	
	/*
	abstract class Animal {
		
		public $size;
	
		public function greeting() {
			$sound = $this->sound();
			return strtoupper($sound)." size:".$this->size;
		}
		
		abstract public function sound();
	}
	
	class Dog extends Animal {
		public function sound() {
			return "Woof!";
		}
	}
		
	$dog = new Dog();
	$dog->size = 50;
	echo $dog->greeting();
	*/
	
	/*-----------------------------------*/
	
	abstract class UnitList {
		public $start;
		public $end;
		public $unit;
		public $list = array();
		
		public function createList() {
			for ($i = $this->start; $i < $this->end; $i++) {
				$list[] = $i;
			}
			return $list;			
		}
	}
	
	class Day {
		protected $hours = array();
		protected $startDate;
		protected $startTime;
		protected $endTime;
		protected $debugger;
		
		public function __construct($timestamp, $debugger) {
			$this->startDate = $timestamp;
			$this->debugger = $debugger;
			$this->debugger->debug('__construct Day');
		}
						
		public static function getDay($timestamp, $debugger) {
			return new Day($timestamp, $debugger);
		}
		
		public function getHoursPerDay($start, $end) {
			for ($i = $start; $i <= $end; $i++) {
				$this->hours[] = Hour::getHour(strtotime('+'.$i.' hours', $this->startDate), $this->debugger);
			}
			return $this;
		}
	}
	
	class Hour {
		protected $day;
		protected $hour;
		protected $bookings = array();
		protected $debugger;
				
		public function __construct($timestamp, $debugger) {
			$this->hour = $timestamp;
			$this->debugger = $debugger;
			$this->debugger->debug('__construct Hour: '.date('Y-m-d H:i', $timestamp));
		}
		
		public static function getHour($timestamp, $debugger) {
			return new Hour($timestamp, $debugger);
		}
		
		public function getCourtsPerHour($courtCount) {
			for ($i = 1; $i < $courCount; $i++) {
				$this->bookings[] = new Booking($i, $this->debugger);
			}
			return $this;
		}
	}
	
	class Booking {
		protected $hour;
		protected $debugger;
		protected $court;
		
		public function __construct($court, $debugger) {
			$this->court = $court;
			$this->debugger = $debugger;
			$this->debugger->debug('__construct Booking: {$this->court}');
		}
	}
	
	/*
	$obj = Day::getDay(strtotime('2014-01-29 00:00:00'))->getHoursPerDay(7,22);
	
	echo '<br /><br />';
	print_r($obj);
	*/
	
	
	
	
	
?>