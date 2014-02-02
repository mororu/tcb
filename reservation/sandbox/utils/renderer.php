<?php
	namespace ch\tcbuttisholz\util\renderer;
	
	class Renderer {
		
		protected $debugger;
		
		public function __construct($debugger) {
			$this->debugger = $debugger;
			$this->debugger->debug('__construct Renderer');
		}
		
		public function renderDayList($days) {
			if (is_array($days)) {
				foreach ($days as $day) {					
					include('templates/template-day.php');
				}
			}
		} 
		
		public function renderHourList($hours) {
			echo 'render Hours';
			if (is_array($hours)) {
				foreach($hours as $hour) {
					include('templates/template-hour.php');
				}
			}
		}
	}
?>