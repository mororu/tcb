<?php
		
	namespace ch\tcbuttisholz\tcbtcr\utils;
	
	use \PDO;
		
	class DataBase {
		
		private static $instance;
		private $pdo;
		
		private $db_host;
		private $db_user;
		private $db_pass;
		private $db_name;
		private $db_socket;
		
		public $debugger;
		
		private function __construct() {
			
			$this->readConfig();
			
			try {
				$this->pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8;unix_socket=$this->db_socket",
									$this->db_user,
									$this->db_pass
									);	
								
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				die("A database error was encountered: ".$e->getMessage());
			} catch(Exception $e) {
				die("Error: ".$e->getMessage());
			}
		}
		
		private function readConfig() {
			
			$configs = parse_ini_file('include/config.ini');
			
			$this->db_host = $configs['host'];
			$this->db_user = $configs['user'];
			$this->db_pass = $configs['password'];
			$this->db_name = $configs['dbname'];
			$this->db_socket = $configs['socket'];
			
		}
		
		public static function getConnection() {
			
			if(self::$instance === null) {
				self::$instance = new DataBase();
			}
			return self::$instance;			
		}			
		
		public function select($statement, $data) {
			$sth = $this->pdo->prepare($statement);
			$sth->execute($data);
			return $sth->fetchAll(PDO::FETCH_OBJ);
		}
		
		public function modify($statement, $data) {
			try {
				$sth = $this->pdo->prepare($statement);
				$sth->execute($data);
				return $this->pdo->lastInsertId();
			} catch(Exception $e) {
				$this->debugger->debug("ERROR: {$e->getMessage()}");
			}
		}	
		
		public function delete($statement, $data) {
			try {
				$sth = $this->pdo->prepare($statement);
				$sth->execute($data);
			} catch(Exception $e) {
				$this->debugger->debug("ERROR: {$e->getMessage()}");
			}
		}	
		
		public function __clone() { return false;}
		
		public function __wakeup() { return false;}
	}
	
?>