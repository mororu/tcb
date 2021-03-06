<?php
	namespace ch\tcbuttisholz\tcbtcr\utils\command;
	
	use ch\tcbuttisholz\tcbtcr\utils\request\Request;
	use ch\tcbuttisholz\tcbtcr\utils\response\Response;
	use ch\tcbuttisholz\tcbtcr\utils\template\Template;
	use ch\tcbuttisholz\tcbtcr\utils\command\WebCommand;
	
	class deleteCommand extends WebCommand {
		
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

			$this->template = parent::loadTemplate($request);			
		
			if($request->issetParameter('booid')) {
	
				$this->template->bookingId = $request->getParameter('booid');
			} else {
				$this->template->bookingId = 0;
				$this->debugger->debug('Keine Booking Id');				
			}

			$response->write($this->template);	
		}
	}
