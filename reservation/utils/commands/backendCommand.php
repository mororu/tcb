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
	
	class backendCommand extends WebCommand {
		
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
			
			$bookingMapper = new BookingMapper($this->db, $this->debugger);		
			$sort = "";
					
			if ($request->issetParameter('sort')) {				
				$sort = $request->getParameter('sort');
			}
			
			$this->debugger->debug('Backend');	
			
			$bookings = $bookingMapper->findAllBookings(strtotime(date('d.m.Y H:i:s')), $sort);

			$this->template->bookings = $bookings;
			$response->write($this->template);									
		}
	}
