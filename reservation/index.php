<html>
	<head>
		<title>TCB - Court reservation System</title>
	</head>
	<body>
<?php
	include('enumeration.php');
	include('class/db.class.php');
	include('class/calender.class.php');
	include('class/reservation.class.php');
	
	// $type = ReservationType::Single;
	// echo $type;
	
	$timestamp = strtotime(date('2014-01-25 15:00:00'));
	$timestamp .= 1;
	echo $timestamp;
	$reservationObj = new Reservation($timestamp);
	
	print_r($reservationObj);	
	
	$calender = new Calendar();
	$calender->week = date('W');
	$calender->year = date('Y');
	$calender->showDayCounter = 10;
	$calender->startTime = 7;
	$calender->endTime = 22;
	
	$list = $calender->getListOfDays();
	
	foreach($list['times'] as $day) {
		foreach($day['times'] as $time) {
			echo date('d.m.Y H:i', $time).'<br />';
		}
	}

	
	
	/*
	$dbHandle = DBConnection::getInstance();
	
	$sql = 'SELECT * FROM players_pla ORDER BY pla_name ASC';
	$stmt = $dbHandle->prepare($sql);
	$stmt->execute();
	$t = $stmt->fetchAll();
	print_r($t);
	
	echo ' Db Success';
		*/
?>
	</body>
</html>