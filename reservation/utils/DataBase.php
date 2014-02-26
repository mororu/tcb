<?php
		
	namespace ch\tcbuttisholz\tcbtcr\utils;
	
	use \PDO;
		
	class DataBase {
		
		private static $instance;
		private $pdo;
		
		private $db_host = 'localhost';
		private $db_user = 'root';
		private $db_pass = 'root';
		private $db_name = 'supermo_test';
		
		private function __construct() {
			try {
				$this->pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock",
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
			} catch(Exception $e) {
				die("ERROR: ".$e->getMessage());
			}
		}		
		
		public function __clone() { return false;}
		
		public function __wakeup() { return false;}
	}
	
?>