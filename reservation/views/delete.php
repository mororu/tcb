<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="VIEWPORT" content="WIDTH=DEVICE-WIDTH, INITIAL-SCALE=1" />
		
		<title>TC-Buttisholz - Tennisplatz Reservation</title>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
		<link rel="stylesheet" href="include/style.css" />
		
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
		
		<script type="text/javascript">
			
			$('#deleteBookingPage').live('pagecreate', function() {
				$('<a href="#popup" data-rel="dialog"></a>').click().remove();
			});
			
			$('document').ready(function(){
				$('#cancelButton').click(function() {
					alert('close');
				});
			});
			
		</script>
		
	</head>
	<body>
		<div data-role="page" id="deleteBookingPage">
			<div data-role="header">
				<h1>Reservation l&ouml;schen</h1>
			</div>
			<div data-role="content">
				<h4 style="text-align: center;">Soll diese Reservation definitiv gelöscht werden?</h4>
				<form id="deleteBooking" name="deleteBooking" method="post" action="index.php?cmd=calendar">
					<div id="hiddenArea">
						<input type="hidden" id="deleteId" name="deleteId" value="<?php echo $this->bookingId; ?>">
					</div>
					<div id="deleteSubmit">
						<input type="submit" id="saveBooking" name="saveBooking" data-icon="delete" data-iconpos="top" value="Ja, Reservation l&ouml;schen" class="cancelButton">
					</div>
					<a href="#" data-rel="back" data-role="button" data-icon="home" class="okButton" data-iconpos="top">Nein, Reservation nicht l&ouml;schen</a>
				</form>
			</div>
		</div>
		
	</body>
</html>	
