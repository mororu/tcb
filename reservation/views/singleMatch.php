<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="VIEWPORT" content="WIDTH=DEVICE-WIDTH, INITIAL-SCALE=1" />
		
		<title>TC-Buttisholz - Tennisplatz Reservation</title>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
		<link rel="stylesheet" href="include/style.css" />
		
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
		
		<script src="js/matchType.js" type="text/javascript"> </script>
		
	</head>
	<body>
		<div data-role="page" id="singleMatch">
			<header>
				<div data-role="header" data-add-back-btn="true">
					<h1>TC-Buttisholz Platz Reservation</h1>	
				</div>
			</header>
			
			<div data-role="content">
				
				<form id="singleMatch" name="bookingForm" action="?cmd=calendar" method="post" data-ajax="false">
					<div id="player1" class="playerList">
						<input class="search" id="playerSearch1" type="text" value="" data-clear-btn="true" data-mini="false" placeholder="Spieler 1">
					</div>
					<div id="player2" class="playerList">
						<input class="search" id="playerSearch2" type="text" value="" data-clear-btn="true" data-mini="false" placeholder="Spieler 2">
					</div>
					<ul data-role="listview" data-inset="true" id="result" class="resultList"></ul>
					<div id="description">
						<textarea cols="100" rows="8" name="matchDescription" id="matchDescription" placeholder="Beschreibung"></textarea>
					</div>
					<div id="submit">
						<input type="submit" id="saveBooking" name="saveBooking" value="Reservation speichern">
					</div>
					<div id="cancel">
						<input id="cancelBooking" type="button" name="cancelBooking" value="Abbrechen">
					</div>
				</form>		
			</div>
			
			<footer>
				<div data-role="footer">
					<h1>Footer</h1>
				</div>
			</footer>
		</div>
		
	</body>
</HTML>
