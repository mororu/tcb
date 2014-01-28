<html>
	<head>
		<title>JQM</title>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
	</head>
	<body>
		<div id="index=" data-role="page" style="padding: 20px;">

<?php

	include('helper.php');
	
	$time = strtotime("2014-01-27 07:00:00");
	$dayList = array();
	$times = array();

	for ($i=0; $i<16; $i++) {
		$times[] = strtotime("+".$i." hours", $time);
	}
	
	for ($i=0; $i<10; $i++) {
		$timeStamp = strtotime("+".$i." day", $time);
		$dayList[] = new Booking($timeStamp, $times);
	}
	/*		
	foreach($dayList as $day) {
		writeLine(date('d.m.Y', $day->GetDay()));
		
		foreach($day->GetTimes() as $time) {
			writeLine(date('H:i', $time));
		}
	}
	*/
	render('day', $dayList);
	
	class Booking {
		
		private $day;
		private $times;
		
		public function __construct($day, $times) {
			$this->day = $day;	
			$this->times = $times;			
		}
		
		public function GetDay() {
			return $this->day;
		}
		
		public function GetTimes() {
			return $this->times;
		}
	}
	
	class Day {
			
		private $day;
		private $timeList;
		
		public function __construct() {
			
		}
	}
	
	class Time {
			
		private $time;
		private $bookingList;
		
		public function __construct() {
			
		}
		
		// Function with iteration foreach court
		// creates a booking list 
	}
	
	class Booking {
		
		// Members
		
		// Constructor with court number as parameter
		
		// Load function to check if a booking exists
		
	}
	
/*	
	if(is_array($days)){
		
		// If an array was passed, it will loop
		// through it, and include a partial view
		foreach($days as $d){
			
			// This will create a local variable
			// with the name of the object's class
			
			$cl = strtolower(get_class($k));
			$$cl = $k;
			
			include "day.php";
		}
		
	}*/
?>		
		
		</div>
	</body>
</html>