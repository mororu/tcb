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
				$tpl = new Template('views/'.$request->getParameter('cmd').'.php', $this->debugger);
			} else {
				// Load 404 Error Page
				$this->debugger->debug("Template {$request->getParameter('cmd')} nicht gefunden!");
				$this->pageNotFound = true;
			}
			return $tpl;
		}
		
		public function execute(Request $request, Response $response) {
			
		}
		
	}
	
?>