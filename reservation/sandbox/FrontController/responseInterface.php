<?php	
	namespace ch\tcbuttisholz\frontcontroller\mvc\response;
	
	interface Response {
		public function setStatus($status);
		public function addHeader($name, $value);
		public function write($data);
		public function flush();
	}

?>