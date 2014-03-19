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
		<div data-role="page" id="pageMatchType">
			<header>
				<div data-role="header" data-add-back-btn="true">
					<a href="index.php?cmd=calendar" class="ui-btn-left ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left ui-icon-home">Home</a>
					<h1>TC-Buttisholz Platz Reservation</h1>	
				</div>
			</header>
			
			<div data-role="content">
				
				<h2 style="text-align: center;"><?php echo "{$this->day}, {$this->start} - {$this->end} Uhr";?></h2>
				
				<div>
					<?php if (count($this->booking->getPlayers())>0) { 						
							foreach($this->booking->getPlayers() as $player) { ?>
						<a href="#" data-role="button">
						<?php echo $player->getName(); ?>
						</a> 
					<?php 
							}
						} else {
					?>
						<a href="#" data-role="button">
						<?php echo $this->booking->getDescription(); ?>
						</a>					
					<?php } ?>
				</div>
				
				<a href="index.php?cmd=calendar" data-role="button" data-icon="home" data-iconpos="top" class="okButton" data-ajax="false">Zur&uuml;ck zur &Uuml;bersicht</a>
					
				<a href="index.php?cmd=delete&booid=<?php echo $this->booking->getId(); ?>" data-role="button" data-icon="delete" data-iconpos="top" data-rel="dialog" class="cancelButton">Reservation l&ouml;schen</a>			
			</div>
			
			<footer>
				<div data-role="footer">
					<a href="documentation/anleitung-reservationssystem.pdf" target="_blank" data-role="button" data-icon="info" style="float: left; margin-left: 5px;">Hilfe</a>
					<h1>&copy; 2014 by Tc-Buttisholz</h1>
				</div>
			</footer>
		</div>
		
	</body>
</HTML>
