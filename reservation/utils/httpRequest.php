<?php
	/**
	 * --------------------------------------------
	 * httpRequest.php
	 * --------------------------------------------
	 * Autor: Manuel Wyss
	 * Date:  11.02.2014
	 * Desc:  Handles all requests 
	 * --------------------------------------------
	 */
	namespace ch\tcbuttisholz\tcbtcr\utils\request;
	
	class HttpRequest implements Request {
		
		private $parameters;
		
		public function __construct() {
			$this->parameters = $_REQUEST;
		}
		
		public function issetParameter($name) {
			return isset($this->parameters[$name]);
		}
		
		public function getParameter($name) {
			if (isset($this->parameters[$name])) {
				return $this->parameters[$name];
			}
			return null;
		}
		
		public function getParameterNames() {
			return array_keys($this->parameters);
		}
		
		public function getHeader($name) {
			$name = 'HTTP_'.strtoupper(str_replace('-', '_', $name));
			if (isset($_SERVER[$name])) {
				return $_SERVER[$name];
			}
			return null;
		}
	}
?>