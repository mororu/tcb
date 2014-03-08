<?php
	
	namespace ch\tcbuttisholz\tcbtcr\utils\command;
	
	use ch\tcbuttisholz\tcbtcr\utils\request\Request;
	use ch\tcbuttisholz\tcbtcr\utils\response\Response;
	use ch\tcbuttisholz\tcbtcr\utils\template\Template;
	
	class WebCommand implements Command {
		
		protected $debugger;
		protected $pageNotFound = false;
		
		public function __construct($debugger) {
			$this->debugger = $debugger;
		}
		
		public function loadTemplate(Request $request) {
			if ($request->issetParameter('cmd')) {
				$template = $request->getParameter('cmd').'.php';
			} else {
				// Load 404 Error Page
				$this->debugger->debug("Template wurde nicht gefunden! Laden des Default Template.");
				$template = "calendar.php";
			}
			
			$tpl = new Template('views/'.$template, $this->debugger);
			return $tpl;
		}
		
		public function execute(Request $request, Response $response) {
			
		}
		
	}
	
?>