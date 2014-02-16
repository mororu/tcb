<?php
	namespace ch\tcbuttisholz\tcbtcr\utils\command;
	
	use ch\tcbuttisholz\tcbtcr\utils\request\Request;
	use ch\tcbuttisholz\tcbtcr\utils\response\Response;
		
	class HelloWorldCommand implements Command {
		
		private $debugger;
		
		public function __construct($debugger) {
			$this->debugger = $debugger;
		}
		
		public function execute(Request $request, Response $response) {
			if ($request->issetParameter('Name')) {
				$response->write("Hallo ");
				$response->write($request->getParameter('Name'));
			} else {
				$response->write('rwar');
			}
		}
	}
?>