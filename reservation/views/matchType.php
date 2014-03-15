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
				
				<?php if ($this->bookingId != 0) {  ?>	
					<h2 style="text-align: center;"><?php echo "{$this->day}, {$this->start} - {$this->end} Uhr";?></h2>
					
					<a href="index.php?cmd=singleMatch&type=0&booid=<?php echo $this->bookingId; ?>" data-role="button" data-ajax="false" class="okButton" data-icon="star" data-iconpos="top">Einzel Match</a>
					<a href="index.php?cmd=doubleMatch&type=1&booid=<?php echo $this->bookingId; ?>" data-role="button" data-ajax="false" class="okButton" data-icon="star" data-iconpos="top">Doppel Match</a>
					<a href="index.php?cmd=training&type=2&booid=<?php echo $this->bookingId; ?>" data-role="button" data-ajax="false" class="okButton" data-icon="star" data-iconpos="top">Training, Turnier, diverses ...</a>
					<a href="?cmd=calendar" data-role="button" class="cancelButton" data-icon="delete" data-iconpos="top">Reservation Abbrechen</a>
				<?php } else { ?>	
					<a href="?cmd=calendar" data-role="button" class="cancelButton">Es ist ein Fehler aufgetreten. Zur&uuml;ck zur &Uuml;bersicht</a>
				<?php } ?>								
			</div>
			
			<footer>
				<div data-role="footer">
					<h1>&copy; 2014 by Tc-Buttisholz</h1>
				</div>
			</footer>
		</div>
		
	</body>
</HTML>
