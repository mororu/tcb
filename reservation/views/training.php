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
				<div data-role="header">
					<a href="index.php?cmd=calendar" class="ui-btn-left ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left ui-icon-home">Home</a>
					<h1>TC-Buttisholz Platz Reservation</h1>	
				</div>
			</header>
			
			<div data-role="content">
				
				<?php if ($this->bookingId != 0) { ?>
				
				<h2 style="text-align: center;"><?php echo "{$this->day}, {$this->start} - {$this->end} Uhr";?></h2>
				
				<form id="singleMatch" name="bookingForm" action="?cmd=calendar" method="post" data-ajax="false">
					<div id="descriptionArea">
						<textarea id="description" name="description" cols="100" rows="20"></textarea>
					</div>
					<div id="hiddenArea">
						<input type="hidden" value="<?php echo $this->bookingId; ?>" id="bookingId" name="bookingId" />
						<input type="hidden" value="<?php echo $this->matchType; ?>" id="matchType" name="matchType" />
					</div>
					<div id="saveSubmit">
						<input type="submit" id="saveBooking" name="saveBooking" value="Reservation speichern" class="okButton" data-icon="check" data-iconpos="top">
					</div>
					<div id="cancel">
						<a href="?cmd=calendar" data-role="button" class="cancelButton" data-icon="delete" data-iconpos="top">Reservation Abbrechen</a>
					</div>
				</form>		
				
				<?php } else { ?>
				<a href="?cmd=calendar" data-role="button" class="cancelButton">Es ist ein Fehler aufgetreten. Zur&uuml;ck zur &Uuml;bersicht</a>
				<?php } ?>
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
