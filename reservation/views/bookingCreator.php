<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="VIEWPORT" content="WIDTH=DEVICE-WIDTH, INITIAL-SCALE=1" />
		
		<title>TC-Buttisholz - Tennisplatz Reservation</title>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
		<link rel="stylesheet" href="include/style.css" />
		
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
		<link rel="stylesheet" type="text/css" href="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.min.css" /> 
		
		<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.core.min.js"></script>
		<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js"></script>
		<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/i18n/jquery.mobile.datebox.i18n.en_US.utf8.js"></script>
		
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
				
				<div>
					<?php print_r($this->s); ?>
					<br />
					<?php echo $this->l; ?>
				</div>
				
				<form id="singleMatch" name="bookingForm" action="?cmd=bookingCreator" method="post" data-ajax="false">
					
					<div id="date">
						<input name="bookingDate" id="bookingDate" type="date" data-role="datebox" data-options='{"mode": "calbox"}'>
					</div>			
					<div id="courts">
						<fieldset data-role="controlgroup" data-type="horizontal" data-role="fieldcontain">
							<div class="ui-checkbox">
								<input type="checkbox" name="court1" id="court1" class="custom" />
								<label for="court1">Platz 1</label>
							</div>
							<div class="ui-checkbox">
								<input type="checkbox" name="court2" id="court2" class="custom" />
								<label for="court2">Platz 2</label>
							</div>
							<div class="ui-checkbox">
								<input type="checkbox" name="court3" id="court3" class="custom" />
								<label for="court3">Platz 3</label>
							</div>
						</fieldset>
					</div>
					<div id="starttimediv">
						<select name="starttime" id="starttime">
							<option value="7">7:00</option>
							<option value="8">8:00</option>
							<option value="9">9:00</option>
							<option value="10">10:00</option>
							<option value="11">11:00</option>
							<option value="12">12:00</option>
							<option value="13">13:00</option>
							<option value="14">14:00</option>
							<option value="15">15:00</option>
							<option value="16">16:00</option>
							<option value="17">17:00</option>
							<option value="18">18:00</option>
							<option value="19">19:00</option>
							<option value="20">20:00</option>
							<option value="21">21:00</option>
						</select>
					</div>
					<div id="endtimediv">
						<select name="endtime" id="endtime">
							<option value="8">8:00</option>
							<option value="9">9:00</option>
							<option value="10">10:00</option>
							<option value="11">11:00</option>
							<option value="12">12:00</option>
							<option value="13">13:00</option>
							<option value="14">14:00</option>
							<option value="15">15:00</option>
							<option value="16">16:00</option>
							<option value="17">17:00</option>
							<option value="18">18:00</option>
							<option value="19">19:00</option>
							<option value="20">20:00</option>
							<option value="21">21:00</option>
							<option value="22">22:00</option>							
						</select>
					</div>
				
					<div id="descriptionText" class="playerList">
						<input id="description" name="description" type="text" value="" data-clear-btn="true" data-mini="false" placeholder="Beschreibung">
					</div>
					<ul data-role="listview" data-inset="true" id="result" class="resultList"></ul>
					<div id="hiddenArea">
						<input type="hidden" value="2" id="matchType" name="matchType" />
					</div>
					<div id="saveSubmit">
						<input type="submit" id="saveBooking" name="saveBooking" value="Reservation speichern" class="okButton" data-icon="check" data-iconpos="top">
					</div>
					<div id="cancel">
						<a href="?cmd=calendar" data-role="button" class="cancelButton" data-icon="delete" data-iconpos="top">Reservation Abbrechen</a>
					</div>
				</form>		

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
