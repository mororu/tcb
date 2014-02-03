<?php
	namespace ch\tcbuttisholz\frontcontroller\mvc\command;
	
	use ch\tcbuttisholz\frontcontroller\mvc\request\Request;
	use ch\tcbuttisholz\frontcontroller\mvc\response\Response;

	interface Command {
		public function execute(Request $request, Response $response);
	}	
?>