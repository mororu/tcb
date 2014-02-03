<?php
	namespace ch\tcbuttisholz\frontcontroller\mvc\command;
	
	use ch\tcbuttisholz\frontcontroller\mvc\request\Request;
	use ch\tcbuttisholz\frontcontroller\mvc\response\Response;
	
	class HelloWorldCommand implements Command {
		public function execute(Request $request, Response $response) {
			if ($request->issetParameter('Name')) {
				$response->write("Hallo ");
				$response->write($request->getParameter('Name'));
			} else {
				$response->write("Hallo Unbekannter");
			}
		}
	}
	
	class BrowserInfoCommand implements Command {
		public function execute(Request $request, Response $response) {
			$response->write('Ihr Browser: ');
			$response->write($request->getHeader('User-Agent'));
		}
	}
?>