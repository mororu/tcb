<?php
	/**
	 * --------------------------------------------
	 * interfaces.php
	 * --------------------------------------------
	 * Autor: Manuel Wyss
	 * Date:  11.02.2014
	 * --------------------------------------------
	 */
	
	namespace ch\tcbuttisholz\tcbtcr\utils\request;
	/**
	 * Request interface
	 */
	interface Request {
		public function getParameterNames();
		public function issetParameter($name);
		public function getParameter($name);
		public function getHeader($name);
	}
	
	/* Begin namespace response */
	/* ------------------------ */
	namespace ch\tcbuttisholz\tcbtcr\utils\response;
	/**
	 * Response interface
	 */
	interface Response {
	 	public function setStatus($status);
		public function addHeader($name, $value);
		public function write($data);
		public function flush();
	}
	 
	/* Begin namespace command */
	/* ------------------------ */
	namespace ch\tcbuttisholz\tcbtcr\utils\command;
	/**
	 * Command resolver interface 
	 */
	use ch\tcbuttisholz\tcbtcr\utils\request\Request;
	use ch\tcbuttisholz\tcbtcr\utils\response\Response;
	
	interface CommandResolver {
		public function getCommand(Request $request);
    }

	/**
	* Command interface
	*/
	interface Command {
		public function execute(Request $request, Response $response);
	}	
	
	/* Begin namespace debugger */
	/* ------------------------ */
	namespace ch\tcbuttisholz\tcbtcr\utils\debugger;
	/**
	 * Debugger interface
	 */
	interface Debugger {
		public function debug($message);
	}
	
?>