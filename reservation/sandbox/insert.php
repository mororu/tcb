<?php
	$db_host = 'localhost';
	$db_user = 'manu';
	$db_pass = 'SQLadmin';
	$db_name = 'supermo_test';

	print_r($_POST);
	
	try {
		$db = new PDO(
			"mysql:host=$db_host;dbname=$db_name;charset=utf8;unix_socket=/var/lib/mysql/mysql.sock",
			$db_user,
			$db_pass
		);
		
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if (isset($_GET) && !empty($_GET)) {
			$user = $_GET['user'];
			$pass = $_GET['pass'];
		}
		
		if (isset($_POST) && !empty($_POST)) {
			echo 'post';
			$user = $_POST['user'];
			$pass = $_POST['pass'];
		}		

		echo "<br />User:{$user}, Passwort:{$pass}<br />";
		
		//$sql = 'INSERT INTO sandbox2 (username, password) VALUES(:user, :password)';
		$sql = "INSERT INTO sandbox2 (username, password) VALUES('".$user."','".$pass."')";
		echo "<br />{$sql}<br />";

		$q = $db->prepare($sql);
	//	$q->bindParam(':user',$user,PDO::PARAM_STR);
	//	$q->bindParam(':password',$pass,PDO::PARAM_STR);
		$q->execute();
		
		echo $q->rowCount();
	}
	catch(PDOException $e) {
		error_log($e->getMessage());
		die("A database error was encountered: ".$e->getMessage());
	}
	catch(Exception $e) {
		die("Error: ".$e->getMessage());
	}
?>
