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
				$response->write('<a href="?cmd=Addition&a=3&b=33">Addition</a>');
			}
		}
	}
?>