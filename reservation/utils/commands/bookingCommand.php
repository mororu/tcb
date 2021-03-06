<?php
	namespace ch\tcbuttisholz\tcbtcr\utils\command;
	
	use ch\tcbuttisholz\tcbtcr\utils\request\Request;
	use ch\tcbuttisholz\tcbtcr\utils\response\Response;
	use ch\tcbuttisholz\tcbtcr\utils\template\Template;
	use ch\tcbuttisholz\tcbtcr\utils\command\WebCommand;
	use ch\tcbuttisholz\tcbtcr\lib\Day;
	use ch\tcbuttisholz\tcbtcr\utils\DataBase;
	use ch\tcbuttisholz\tcbtcr\lib\BookingMapper;
	use ch\tcbuttisholz\tcbtcr\lib\Booking;
	
	class bookingCommand extends WebCommand {
		
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
		 * @version 0.1, 11.03.2014 
		 */
		public function execute(Request $request, Response $response) {

			$db = DataBase::getConnection();
			$this->template = parent::loadTemplate($request);			
		
			if($request->issetParameter('booid')) {
			
				$bookingMapper = new BookingMapper($db, $this->debugger);
				$booking = $bookingMapper->findById($request->getParameter('booid'));
				$booking = $bookingMapper->loadPlayers($booking);
				$this->template->booking = $booking;
			
				$this->template->bookingId = $request->getParameter('booid');
				$this->getReservationInfo(substr($this->template->bookingId, 0, -1));
			} else {
				$this->template->bookingId = 0;
				$this->debugger->debug('Keine Booking Id');				
			}

			$response->write($this->template);	
		}
		
		private function getReservationInfo($timestamp) {
			
			$day = new Day($timestamp, $this->debugger);
			$this->template->day = $day->getWeekday();
			$this->template->start = date('H:i', $day->getTimestamp());
			$this->template->end = date('H:i', strtotime('+1 hour', $day->getTimestamp()));			
		}
	}
