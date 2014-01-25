<?php
	 /**
	 * Calender Klasse 
	 *
	 * Nächste und vorherige Woche, Tage der gewählten Kalenderwoche
	 * 
	 * @author Manuel Wyss <wyssmanuel@me.com>
	 * @copyright 2014 Manuel Wyss
	 * @version 1.0
	 * @link
	 */	
	class Calendar {

		/**
 		 * MemberArray
		 */
		protected $_data = array();

		public function __construct($week, $year) {
		}

		public function __get($property) {
			if ($this->_data !== null) {
				if (isset($this->_data[$property])) {
					return $this->_data[$property];
				} else  {
					return null;
				}
			} else  {
				return null;
			}
		}

		public function __set($property, $value) {
			$this->_data[$property] = $value;
		}

		/**
		 * Gibt die nächste Kalenderwoche zurück
		 */
		public function getNextCalendarWeek() {			
			if (isset($this->_data['year']) && isset($this->_data['week'])) {

				$this->_data['nextYear'] = $this->_data['year'];

				if ($this->_data['week'] >= 52) {				
					if (date('W', mktime(0,0,0,12,31,$this->_data['year'])) === "01") {
						$this->_data['nextYear']++;
						return '01';
					} else {
						return 53;
					}
				} else {
					if ($this->_data['week'] < 9) {
						$value = '0'.($this->_data['week'] + 1);
						return $value;
					} else {
						return $this->_data['week'] + 1;
					}
				}
			}
		}

		/**
		 * Gibt die vorherige Woche zurück
		 */
		public function getPreviousCalenderWeek() {
			if (isset($this->_data['year']) && isset($this->_data['week'])) {

				$this->_data['lastYear'] = $this->_data['year'];

				if ($this->_data['week'] > 1) {
					if ($this->_data['week'] <= 10) {
						$value = '0'.($this->_data['week']-1);
					} else {
						$value = $this->_data['week']-1;
					}
					return $value;
				} else {
					$this->_data['lastYear']--;
					echo $this->_data['year']." altes Jahr<br>";
					if (date('W', mktime(0,0,0,12,31,$this->_data['year'])) === "01") {
						return 52;
					} else {
						return 53;
					}
				}
			}
		}

		/**
		 * Gibt die Tage der gewählten Woche zurück
		 */
		public function getDaysOfWeek() {

			$days = array();
			$dayAdd = 0;

			if ($this->_data['week'] == date('W')) {
				if (date('N') == 1) {
					$startTime = strtotime('today');
				} else {
					$startTime = strtotime('last monday');				
				}
			} else {
				$startTime = strtotime($this->_data['year'].'-W'.$this->_data['week']);
			}

			for ($i = 0; $i < 7; $i++) {
				$days['day'][] = date('d', strtotime('+'.$dayAdd.' day', $startTime));
				$days['date'][] = date('Y-m-d', strtotime('+'.$dayAdd.' day', $startTime));
				$dayAdd++;
			}
			return $days;
		}
		
		/**
		 * Gibt ein die nächsten Tage zurück
		 */
		public function getListOfDays(){
			$days = array();
			$add = 0;
			
			$startTime = strtotime('today');
			
			for($i = 0; $i < $this->_data['showDayCounter']; $i++) {
				
				$day = strtotime('+'.$add.' day', $startTime);
				$days['days'][] = date('d.m.Y', $day);
 				$days['times'][] = $this->getListOfHours($day);
				$add++;
			}
			
			return $days;
		} 
		
		public function getListOfHours($timeStamp) {
				
			$appointments = array();
				
			for ($i = $this->_data['startTime']; $i <= $this->_data['endTime']; $i++) {
				$appointments['times'][] = strtotime('+'.$i.' hours', $timeStamp);
			}
			return $appointments;				
		} 	
	}

?>