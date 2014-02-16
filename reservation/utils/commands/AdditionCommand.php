<?php
	namespace ch\tcbuttisholz\tcbtcr\utils\command;
	
	use ch\tcbuttisholz\tcbtcr\utils\request\Request;
	use ch\tcbuttisholz\tcbtcr\utils\response\Response;
	use ch\tcbuttisholz\tcbtcr\utils\template\Template;
	use ch\tcbuttisholz\tcbtcr\utils\command\WebCommand;

	class AdditionCommand extends WebCommand {
						
		public function __construct($debugger) {
			parent::__construct($debugger);
		}
		
		public function execute(Request $request, Response $response) {
			
			//if ($request->issetParameter('cmd')) {
			//	$tpl = new Template('views/'.$request->getParameter('cmd').'.php', $this->debugger);
				$tpl = parent::loadTemplate($request);
				$tpl->x = $request->getParameter('val');
				if($request->issetParameter('val')) {
					$tpl->square = $request->getParameter('val') * $request->getParameter('val');		
					$this->debugger->debug($request->getParameter('val'));			
				} else {
					$tpl->sqaure = 42;
				}				
			//} else {
				// Load 404 Page
			//}
			
			$response->write($tpl);			
		}
	}
