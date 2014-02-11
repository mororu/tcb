<?php
	/**
	 * --------------------------------------------
	 * commandResolverClass.php
	 * --------------------------------------------
	 * Autor: Manuel Wyss
	 * Date:  11.02.2014
	 * Desc:  Loads the specific command class 
	 * --------------------------------------------
	 */
	namespace ch\tcbuttisholz\tcbtcr\utils\command;
	
	use ch\tcbuttisholz\tcbtcr\utils\request\Request;
	
	class CommandResolverClass implements CommandResolver {
		
		private $path;
		private $defaultCommand;
		private $debugger;
		
		public function __construct($path, $defaultCommand, $debugger) {
			$this->path = $path;
			$this->defaultCommand = $defaultCommand;
			$this->debugger = $debugger;
		}
		
		/**
		 * Get the requested command class
		 * param: cmd -> command
		 */
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
		
		/**
		 * Returns an instance of the requested command class
		 */
		public function loadCommand($cmdName) {
			$class = "ch\\tcbuttisholz\\tcbtcr\\utils\\command\\{$cmdName}Command";
			$file = $this->path . "/{$cmdName}Command.php";
			if (!file_exists($file)) {
				$this->debugger->debug("file: {$file} doesn't exist");
				return false;
			}
			include_once $file;
			if (!class_exists($class)) {
				$this->debugger->debug("class: {$class} doesn't exist");
				return false;
			}
			$command = new $class();
			return $command;
		}
	}
?>