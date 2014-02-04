<?php
	namespace ch\tcbuttisholz\frontcontroller\mvc\command;
	
	use ch\tcbuttisholz\frontcontroller\mvc\request\Request;
	use ch\tcbuttisholz\frontcontroller\mvc\response\Response;
	
	class BrowserInfoCommand implements Command {
		public function execute(Request $request, Response $response) {
			$response->write('Ihr Browser: ');
			$response->write($request->getHeader('User-Agent'));
		}
	}
?>