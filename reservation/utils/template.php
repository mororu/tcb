<?php
	namespace ch\tcbuttisholz\tcbtcr\utils\template;

	class Template {
		/**
		 * @private 
		 * The path to the template file
		 */
		private $template;
		
		/**
		 * @var Array $vars The template placeholders and their values
		 * @access private
		 */
		private $vars = array();
		 
		/**
		 * @private
		 * The instances of all needed helper classes
		 */
		private $helpers = array();
		
		/**
		 * @private 
		 * The debugger instance
		 */
		private $debugger;
		  
		/**
		 * @public 
		 * Assigns the template that should be used
		 * 
		 * @param String $template The path to the template file
		 * @author Manuel Wyss
		 * @version 0.1, 11.02.2014
		 */
		public function __construct($template, $debugger = null) {
			$this->debugger = $debugger;
			$this->setFile($template);
		}
		  
		/**
		  * @public 
		  * Assigns the template file
		  * 
		  * @param String $template The path to the template file
		  * @author Manuel Wyss
		  * @version 0.1, 11.02.2014
		  */
		public function setFile($template) {
			// Check if the template-file exists and is readable
			if (!file_exists($template) || !is_readable($template)) {
				// and throw an exception if it does not
				$this->debugger->debug('Failed to open template -> '.$template);
			}	
			// Otherwise assign the template path
			$this->template = $template; 
		}		
		
		/**
		 * @public 
		 * Parses a template file and writes the result to the response
		 * 
		 * @param Request $request The request object
		 * @param Response $response The response object
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 11.02.2014
		 */
		 public function render(Request $request, Response $response) {
		 	// Start the buffering
		 	ob_start();
			
			// try to include the template 
			if(!include_once($this->template)) {
				$this->debugger->debug('failed to include file -> '. $this->template);				
			}
			
			// and get the template clean
			$data = ob_get_clean();
			
			// finally write the template data to the response object
			$response->write($data);
		 }
		 
		/**
		 * @public 
		 * Parses a file and returns it
		 * 
		 * @param String $path The path to the template file
		 * @return The parsed template
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 11.02.2014
		 */
		 public function parse($path = null) {
		 	// Start the content buffering 
		 	ob_start();
			
			// include the template and check for result
			if(!@include_once($path)) {
				$this->debugger->debug('Failed to parse file -> '.$path);
			}
			
			// Finally get the parsed template
			$parsed = ob_get_contents();
			
			$this->debugger->debug($path);
			
			// clean up the input buffer
			ob_end_clean();
			
			return $parsed;
		 }
		 
		/**
		 * @public 
		 * Renders the whole template using the magic __toString method
		 * 
		 * @return The parsed template
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 11.02.2014
		 */
		 public function __toString() {
		 	return $this->parse($this->template);
		 }
		 
		/**
		 * @public 
		 * Returns a property by a given key
		 * 
		 * @param String @property The name of the property
		 * @return The value of the template property 
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 11.02.2014
		 */
		public function __get($property) {
			if (isset($this->vars[$property])) {
				return $this->vars[$property];
			}
			return null;
		}
		
		/**
		 * @public 
		 * Calls the declared helper class
		 * 
		 * @param String $methodName The name of the called method
		 * @param Array $args The arguments that were given to the called method
		 * @return The result of the helper execution
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 11.02.2014
		 */
		public function __call($methodName, $args) {
			// Load the needed helper object
			$helper = $this->loadViewHelper($methodName);
			
			// and execute the requested helper
			$val = $helper->execute($args);
			
			return $val;
		}
		
		/**
		 * @protected 
		 * Instances the called helper class, saves it to the helper array and returns the created object
		 * 
		 * @param String $methodName The name of the called method
		 * @param Array $args The arguments that were given to the called method
		 * @return The result of the helper execution
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 11.02.2014
		 */
		protected function loadViewHelper($helper) {
			// Check if the helper was already loaded
			if(!isset($this->helpers[$helper])) {
				$class = $helper . 'ViewHelper';
				
				/*$namespace = '';
					
				  if (!import($namespace)) {
				 	return false;
				 } 
				 */
				$this->helpers[$helper] = new $class();	
			}
			
			return $this->helpers[$helper];
		}
		 
	}

	
?>