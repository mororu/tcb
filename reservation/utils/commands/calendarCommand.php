<?php
	namespace ch\tcbuttisholz\tcbtcr\utils\command;
	
	use ch\tcbuttisholz\tcbtcr\utils\request\Request;
	use ch\tcbuttisholz\tcbtcr\utils\response\Response;
	use ch\tcbuttisholz\tcbtcr\utils\template\Template;
	use ch\tcbuttisholz\tcbtcr\utils\command\WebCommand;
	use ch\tcbuttisholz\tcbtcr\lib\Calendar;

	class calendarCommand extends WebCommand {
		
		/**
		 * @private
		 * The instance of the template
		 */
		private $template;
						
		public function __construct($debugger) {
			parent::__construct($debugger);
		}
		
		/**
		 * @public 
		 * Loads the needed template and sets the content
		 * 
		 * @param $request The request object 
		 * @param $response The response object
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 15.02.2014 
		 */
		public function execute(Request $request, Response $response) {
			
			$this->template = parent::loadTemplate($request);
			$this->template->calendar = $this->getCalenderContent();
			$response->write($this->template);			
		}
		
		/**
		 * @private
		 * Gets the calendar with all bookings of tennis courts, if the template was loaded successfully
		 * 
		 * @return Object of class Booking
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 15.02.2014
		 */
		private function getCalenderContent() {
			if (!$this->pageNotFound) {	
			// Business return Calendar::getBookingCalendar();
				$calendar = new Calendar($this->debugger);
				
				$startDay = strtotime(date('Y-m-d 07:00:00'));
				$daysToDisplay = 7;
				
				$calendar->createCalender($startDay, $daysToDisplay);
				
				$this->debugger->debug('Count of Days in Calendar: '.count($calendar->getDays()));
				return $calendar;
			}
		}
	}
