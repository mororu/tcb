<?php
	namespace ch\tcbuttisholz\tcbtcr\utils\command;
	
	use ch\tcbuttisholz\tcbtcr\utils\request\Request;
	use ch\tcbuttisholz\tcbtcr\utils\response\Response;
	
	class BrowserInfoCommand implements Command {
		public function execute(Request $request, Response $response) {
			$response->write('Ihr Browser: ');
			$response->write($request->getHeader('User-Agent'));
		}
	}
?>