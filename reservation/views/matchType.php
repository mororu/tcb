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
					<h1>TC-Buttisholz Platz Reservation</h1>	
				</div>
			</header>
			
			<div data-role="content">
				
				<?php if ($this->bookingId != 0) {  ?>
					<a href="?cmd=singleMatch&type=0&booid=<?php echo $this->bookingId; ?>" data-role="button" data-ajax="false">Einzel Match</a>
					<a href="" data-role="button">Doppel Match</a>
					<a href="" data-role="button">Training, Turnier, diverses ...</a>
				<?php } else { ?>	
					<a href="?cmd=calendar" data-role="button">Es ist ein Fehler aufgetreten. Zur&uuml;ck zur &Uuml;bersicht</a>
				<?php } ?>								
			</div>
			
			<footer>
				<div data-role="footer">
					<h1>Footer</h1>
				</div>
			</footer>
		</div>
		
	</body>
</HTML>
