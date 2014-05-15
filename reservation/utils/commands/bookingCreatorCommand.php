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
	
	class bookingCreatorCommand extends WebCommand {
		
		/**
		 * @private
		 * The instance of the template
		 */
		private $template;
		
		/**
		 * @private
		 * actual Booking object
		 */
		private $actualBooking;
		
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
			$this->db->debugger = $this->debugger;
			$this->template = parent::loadTemplate($request);

			if($request->issetParameter('saveBooking')) {
				
				$this->template->s = $request;
				
				$bookingIds = $this->createBookingIds($request);
				
				if (count($bookingIds)>0) {
					foreach($bookingIds as $bookingId) {
						$this->createBooking($bookingId, $request);
					}
				}
			} 
		
			$response->write($this->template);									
		}
		
		
		/**
		 * Creates an id list for inserting in the database
		 * 
		 * @access private
		 * @param Request $request
		 * @return void
		 */
		private function createBookingIds(Request $request) {
			
			$bookingIds = array();
			
			if (!$this->hasFormMissingData($request)) {
				$courts = $this->getCourtNumbers($request);		
				$timestamp = $this->getTimestamp($request);
				
				$this->debugger->debug($timestamp);
				$this->debugger->debug(date('d.m.Y H:i', $timestamp));	
				
				for ($i = $request->getParameter('starttime'); $i < $request->getParameter('endtime'); $i++) {
					foreach($courts as $nr) {
						$id = $timestamp . $nr;
						$this->debugger->debug('ID: '.$id);
						array_push($bookingIds, $id);
					}
					
					$this->debugger->debug('Booking for: '.date('d.m.Y H:i', $timestamp));	
					$timestamp += 3600;
				}
			} else {
				$this->template->message = 'Das Formular wurde nicht vollständig ausgefüllt. Die Daten wurden nicht gespeichert.';
				$this->debugger->debug('Missing form data in booking creator');
			}			
			
			return $bookingIds;
		}
		
		
		/**
		 * Checks all mandatory fields of the input form
		 * 
		 * @access private
		 * @param Request $request
		 * @return void
		 */
		private function hasFormMissingData(Request $request) {
			
			$error = false;
			
			if(!$request->issetParameter('bookingDate') || $request->getParameter('bookingDate') == "") {
				$error = true;
			}
			if (!$request->issetParameter('court1') && !$request->issetParameter('court2') && !$request->issetParameter('court3')) {
				$error = true;
			}
			if ($request->getParameter('starttime') >= $request->getParameter('endtime')) {
				$error = true;
			}
			if ($request->getParameter('description') == "") {
				$error = true;
			}
			
			return $error;
		}		
		
		
		/**
		 * Returns an array with the court numbers for the booking
		 * 
		 * @access private
		 * @param Request $request
		 * @return void
		 */
		private function getCourtNumbers(Request $request) {
			$courts = array();
			
			for($i = 1; $i <= 3; $i++) {
				if ($request->issetParameter('court'.$i)) {
					array_push($courts, $i);
				}
			}
			
			return $courts;
		}
		
		
		/**
		 * Calculates the start time and return its timestamp
		 * 
		 * @access private
		 * @param Request $request
		 * @return void
		 */
		private function getTimestamp(Request $request) {
			$timestamp = strtotime(date($request->getParameter('bookingDate')));
			$timestamp += $request->getParameter('starttime') * 3600;
			return $timestamp;
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
					$this->debugger->debug('Court is already booked');
					return 200;				
				}
			} else {
				$this->debugger->debug('No MatchType given!');
				return 100;	
			}		
			
		}
		
		private function createBooking($bookingId, Request $request) {
			
			$bookingMapper = new BookingMapper($this->db, $this->debugger);
			$booking = $bookingMapper->findById($bookingId);
			
			if ($booking->getBookingExist() == true) {
				$booking->setBookingId($bookingId);
				$booking->setPropertiesById();
				$booking->setBookingType($request->getParameter('matchType'));
				$booking->setDescription($request->getParameter('description'));
				$bookingMapper->save($booking);
				$this->booking = $booking;
				return true;
			} else {
				$this->debugger->debug("Booking already exists");
				return false;
			}
		}
	}
