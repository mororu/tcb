<?php
	
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = 'root';
	$db_name = 'supermo_test';
	
	try {
		$db = new PDO(
			"mysql:host=$db_host;dbname=$db_name;charset=utf8;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock",
			$db_user,
			$db_pass
		);
		
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//$sql = "SELECT * FROM sandbox2 ORDER BY username";
		//$statement = $db->query($sql);
		
		//error_log($_GET['term']."\n",3,'log.log');
		
		$searchKey = str_replace('ö', 'o', $_GET['term']);
		$searchKey = str_replace('ü', 'u', $searchKey);
		$searchKey = str_replace('ä', 'a', $searchKey);
				
		$statement = $db->prepare('SELECT * FROM players WHERE pla_name LIKE :term OR pla_firstname LIKE :term');
		$statement->execute(array('term' => '%'.$searchKey.'%'));

		while ($row = $statement->fetch()) {
			$return[] = array('id'=>$row['pla_id'], 'name' => $row['pla_firstname']. ' ' . $row['pla_name']);
		}
	
/*		
		foreach($statement as $row) {
			//array_push($data, $row['username']);
			$data[] = array('value'=>$row['username'], 'label'=>$row['username']);			
		}		
*/
		echo json_encode($return);
	}
	catch(PDOException $e) {
		error_log($e->getMessage());
		die("A database error was encountered: ".$e->getMessage());
	}
	catch(Exception $e) {
		die("Error: ".$e->getMessage());
	}
	
?>