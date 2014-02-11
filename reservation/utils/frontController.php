<?php
	/**
	 * --------------------------------------------
	 * frontController.php
	 * --------------------------------------------
	 * Autor: Manuel Wyss
	 * Date:  11.02.2014
	 * Desc:  Handles the request and loads the
	 *        specific command class 
	 * --------------------------------------------
	 */
	namespace ch\tcbuttisholz\tcbtcr\utils;
	
	use ch\tcbuttisholz\tcbtcr\utils\response\Response;
	use ch\tcbuttisholz\tcbtcr\utils\request\Request;
	use ch\tcbuttisholz\tcbtcr\utils\command\CommandResolver;
	
	class FrontController {
			
		private $resolver;
		private $debugger;
		
		public function __construct(CommandResolver $resolver, $debugger) {
			$this->resolver = $resolver;
			$this->debugger = $debugger;
		}	
		
		public function handleRequest(Request $request, Response $response) {
			$command = $this->resolver->getCommand($request);
			$command->execute($request, $response);
			$response->flush();
		}
	}

?>