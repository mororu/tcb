<?php
	namespace ch\tcbuttisholz\frontcontroller\mvc;
	
	use ch\tcbuttisholz\frontcontroller\mvc\response\Response;
	use ch\tcbuttisholz\frontcontroller\mvc\request\Request;
	use ch\tcbuttisholz\frontcontroller\mvc\command\CommandResolver;
	
	class FrontController {
			
		private $resolver;
		
		public function __construct(CommandResolver $resolver) {
			$this->resolver = $resolver;
		}	
		
		public function handleRequest(Request $request, Response $response) {
			$command = $this->resolver->getCommand($request);
			$command->execute($request, $response);
			$response->flush();
		}
	}

?>