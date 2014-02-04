<?php
	namespace ch\tcbuttisholz\frontcontroller\mvc\command;
	
	use ch\tcbuttisholz\frontcontroller\mvc\request\Request;
	
	class FileSystemCommandResolver implements CommandResolver {
		private $path;
		private $defaultCommand;
		
		public function __construct($path, $defaultCommand) {
			$this->path = $path;
			$this->defaultCommand = $defaultCommand;
		}
		
		public function getCommand(Request $request) {
			if ($request->issetParameter('cmd')) {
				$cmdName = $request->getParameter('cmd');
				$command = $this->loadCommand($cmdName);
				if ($command instanceof Command) {
					return $command;
				}
			}
			$command = $this->loadCommand($this->defaultCommand);
			return $command;
		}
		
		public function loadCommand($cmdName) {
			$class = "ch\\tcbuttisholz\\frontcontroller\\mvc\\command\\{$cmdName}Command";
			$file = $this->path . "/{$cmdName}Command.php";
			if (!file_exists($file)) {
				return false;
			}
			include_once $file;
			if (!class_exists($class)) {
				return false;
			}
			$command = new $class();
			return $command;
		}
	}
?>