<?php
	namespace ch\tcbuttisholz\frontcontroller\mvc\command;
	
	use ch\tcbuttisholz\frontcontroller\mvc\request\Request;
	
	interface CommandResolver {
		public function getCommand(Request $request);
	}
	
?>