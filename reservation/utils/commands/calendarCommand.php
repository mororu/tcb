<?php
	namespace ch\tcbuttisholz\tcbtcr\utils\command;
	
	use ch\tcbuttisholz\tcbtcr\utils\request\Request;
	use ch\tcbuttisholz\tcbtcr\utils\response\Response;
	use ch\tcbuttisholz\tcbtcr\utils\template\Template;
	use ch\tcbuttisholz\tcbtcr\utils\command\WebCommand;
	use ch\tcbuttisholz\tcbtcr\utils\DataBase;
	use ch\tcbuttisholz\tcbtcr\lib\Calendar;
	use ch\tcbuttisholz\tcbtcr\lib\BookingMapper;
	use ch\tcbuttisholz\tcbtcr\lib\Booking;
	use ch\tcbuttisholz\tcbtcr\lib\PlayerMapper;
	use ch\tcbuttisholz\tcbtcr\lib\Player;
	
	class calendarCommand extends WebCommand {
		
		/**
		 * @private
		 * The instance of the template
		 */
		private $template;
		
		/**
		 * @private
		 * Database instance
		 */
		private $db;
						
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
			
			$this->db = DataBase::getConnection();
			$this->template = parent::loadTemplate($request);
			
			if($request->issetParameter('saveBooking')) {
				$errorCode = $this->saveBooking($request);
				if ($errorCode == 0) {
					$this->template->saveSuccess = true;
				}
			} 
		
			$bookingMapper = new BookingMapper($this->db, $this->debugger);			
			$bookings = $bookingMapper->findBookings(strtotime('today midnight'));
			$calendar = $this->getCalenderContent();
			
			$calendar->compareCalendarWithBookings($bookings);
			$this->template->calendar = $calendar;
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
				return $calendar;
			}
		}
		
		private function saveBooking(Request $request) {
		
			if($request->issetParameter('matchType')) {
				
				$playerList = array();
				
				if($request->getParameter('matchType') < 2) {
					$playerList = $this->getPlayerList($request);
				}
				
				$this->debugger->debug(count($playerList));
				
				if(!$this->createBooking($request, $playerList)) 
				{
					return 200;				
				}
			} else {
				$this->debugger->debug('No MatchType given!');
				return 100;	
			}		
			
		}
		
		private function getPlayerList(Request $request) {
	
			$playerList = array();
			
			switch($request->getParameter('matchType')) {
				case 0:
					$playerList[] = $this->getPlayerId($request->getParameter('playerSearch1'));
					$playerList[] = $this->getPlayerId($request->getParameter('playerSearch2'));
				break;
				case 1:
					$playerList[] = $this->getPlayerId($request->getParameter('playerSearch1'));
					$playerList[] = $this->getPlayerId($request->getParameter('playerSearch2'));
					$playerList[] = $this->getPlayerId($request->getParameter('playerSearch3'));
					$playerList[] = $this->getPlayerId($request->getParameter('playerSearch4'));
				break;								
			}
			return $playerList;			
		}
		
		private function getPlayerId($playerName) {
			
			$playerMapper = new PlayerMapper($this->db, $this->debugger);
			$player = $playerMapper->findByName($playerName);
			
			if ($player->getNewPlayer() == true) {
				$player->setName($playerName);
				return $playerMapper->save($player);
			} else {
				return $player->getId();	
			}			
		}
		
		private function createBooking(Request $request, $playerList) {
			
			$bookingMapper = new BookingMapper($this->db, $this->debugger);
			$booking = $bookingMapper->findById($request->getParameter('bookingId'));
			
			if ($booking->getBookingExist() == true) {
				
				if (count($playerList) > 0) {
					$booking->setPlayerIdList($playerList);
				}
		
				$booking->setBookingId($request->getParameter('bookingId'));
				$booking->setPropertiesById();
				$booking->setBookingType($request->getParameter('matchType'));
				if ($request->issetParameter('description')) {
					$this->debugger->debug('Description is set');
					$booking->setDescription($request->getParameter('description'));
				}
				$bookingMapper->save($booking);
				return true;
			} else {
				$this->debugger->debug("Booking already exists");
				return false;
			}
		}
	}
