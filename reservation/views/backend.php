<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="VIEWPORT" content="WIDTH=DEVICE-WIDTH, INITIAL-SCALE=1" />
		
		<title>TC-Buttisholz - Tennisplatz Reservation</title>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
		<link rel="stylesheet" href="include/style.css" />
		
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
		
	</head>
	<body>
		<div data-role="page" id="bookings">
			<header>
				<div data-role="header" data-position="fixed">
					<h1>TC-Buttisholz Platz Reservation</h1>	
				</div>
			</header>
			
			<div data-role="content">
			
			    <div data-role="navbar">
			    	<ul>
				    	<li><a href="?cmd=backend&sort=desc">Zukünftige</a></li>
				        <li><a href="?cmd=backend&sort=asc">Vergangene</a></li>
					</ul>
				</div>
							
				<div style="padding: 30px 20px 20px 20px;">
					<ul data-role="listview">				  	
																		
						<?php 
							$this->debugger->debug(count($this->bookings));
							foreach($this->bookings as $booking) { 
								echo "<li><a href='?cmd=booking&booid={$booking->getId()}'>{$booking->getNameOfDay()}, {$booking->getFormatedDate()}, {$booking->getStartTime()} (Platz {$booking->getCourtNr()}): ";
					
								$playerCount = count($booking->getPlayers());
								$loop = 0;
								
								if ($playerCount > 0) {					
									foreach($booking->getPlayers() as $player) {
										echo "{$player->getName()}";
							
										if ($loop < $playerCount -1) {
											echo " - ";
										}
										$loop++;
									}
								} else {
									echo "{$booking->getDescription()}";	
								}
								echo "</a></li>";	
																	
							} ?>
					</ul>
				</div>
			</div>
			
			<footer>
				<div data-role="footer">
					<a href="?cmd=calendar" target="_blank" data-role="button"" style="float: left; margin-left: 5px;">Reservationssystem</a>
					<h1>&copy; 2014 by Tc-Buttisholz</h1>
				</div>
			</footer>
		</div>
		
	</body>
</HTML>
