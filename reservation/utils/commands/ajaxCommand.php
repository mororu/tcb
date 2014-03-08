<?php
	namespace ch\tcbuttisholz\tcbtcr\utils\command;
	
	use ch\tcbuttisholz\tcbtcr\utils\request\Request;
	use ch\tcbuttisholz\tcbtcr\utils\response\Response;
	use ch\tcbuttisholz\tcbtcr\utils\template\Template;
	use ch\tcbuttisholz\tcbtcr\utils\command\WebCommand;
	use ch\tcbuttisholz\tcbtcr\utils\DataBase;
	
	class ajaxCommand extends WebCommand {
		
		/**
		 * @private
		 * The instance of the template
		 */
		private $template;
						
		public function __construct($debugger) {
			parent::__construct($debugger);
		}
		
		/**
		 * @public 
		 * Loads the needed template and sets the content
		 * 
		 * @param $request The request object 
		 * @param $response The response object
		 * 
		 * @author Manuel Wyss
		 * @version 0.1, 02.03.2014 
		 */
		public function execute(Request $request, Response $response) {
			$this->debugger->debug("Execute ajaxCommand");
			
			$db = DataBase::getConnection();
		
			if ($request->issetParameter('term')) {
			
				$statement = 'SELECT pla_id, pla_fullname FROM players WHERE pla_fullname LIKE :term';
				$data = array('term' => '%'.$request->getParameter('term').'%');
				$records = $db->select($statement, $data);
				
				foreach($records as $record) {
					$return[] = array('id' => $record->pla_id, 'name' => $record->pla_fullname);
				}
				
				$response->write(json_encode($return));
								
			}
		}
	}
