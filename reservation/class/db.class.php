<?php
	// echo 'dbClass included <br />';
	
	final class DBConfiguration {
		const DB_HOST = 'localhost';
		const DB_DATABASE = 'tcbtcr';
		const DB_PORT = '3306';
		const DB_USER = 'root';
		const DB_PASS = 'root';
	}

	class DBConnection {
		private static $db;

		static public function getInstance() {
			try {
				if (!self::$db) {
					self::$db = new PDO ('mysql:host='.DBConfiguration::DB_HOST.
										 ';dbname='.DBConfiguration::DB_DATABASE.
										 ';port='.DBConfiguration::DB_PORT,
										 DBConfiguration::DB_USER,
										 DBConfiguration::DB_PASS,
										 array(PDO::ATTR_PERSISTENT => true,
											   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
											   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
				}
				return self::$db;
			} catch (PDOException $ex) {
				die("A database error was encountered");
			}
		}
	}
    
?>