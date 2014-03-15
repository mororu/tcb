<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="VIEWPORT" content="WIDTH=DEVICE-WIDTH, INITIAL-SCALE=1" />
		
		<title>TC-Buttisholz - Tennisplatz Reservation</title>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css" />
		<link rel="stylesheet" href="include/style.css" />
		
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
		
		<script type="text/javascript" src="js/matchType.js">
			
			
			
		</script>
		
	</head>
	<body>
		<div data-role="page" id="pageCalendar">
			<header>
				<div data-role="header" data-position="fixed">
					<h1>TC-Buttisholz Platz Reservation</h1>	
				</div>
			</header>
			
			<div data-role="content">
				
				<p style="text-align:center; font-weight: bold;">
					<?php 
						if ($this->saveSuccess == true) { echo "Reservierung erfolgreich gespeichert."; } 
						if ($this->deleteSuccess == true) { echo "Reservierung wurde erfolgreich gel&ouml;scht."; }
					?>
				</p>
				<p class="error">
					<?php
						switch($this->errorCode) {
							case 200:
								 echo "Der ausgew&auml;hlte Tennisplatz ist bereits reserviert.";
							break;
						}
					?>
				</p>
				
				<!-- Day set -->
				<div data-role="collapsible-set" data-collapsed-icon="carat-r" data-expanded-icon="carat-d">
				<?php $i=0; foreach($this->calendar->getDays() as $day) { ?>
					<div data-role="collapsible" data-collapsed="<?php echo ($i == 0 ? 'false': 'true'); ?>" class="day">
						<h2><?php echo "{$day->getWeekday()}, {$day->getDate()} <br/>"; ?></h2>
						
						<!-- Time set -->
						<div data-role="collapsible-set" data-collapsed-icon="carat-r" data-expanded-icon="carat-d">								
						<?php foreach($day->getHours() as $hour) { ?>
							<div data-role="collapsible" id="courtContainer" class="hour">
								<h2><?php echo "{$hour->getStartTime()} - {$hour->getEndTime()}"; ?></h2>

								<!-- COURT TABLE -->
								<table id="courtTable">
									<tr>
									<?php
										foreach($hour->getCourts() as $court) {
											if ($court->getBooking() != null) {
									?>
										<td id="<?php echo $court->getId(); ?>">
											<a href="index.php?cmd=booking&booid=<?php echo $court->getBooking()->getId(); ?>" class="booked">Platz <?php echo $court->getCourtNr(); ?><br />
											<?php
												$playerCount = count($court->getBooking()->getPlayers());
												if($playerCount > 0) {
											?>
												<?php
													$loop = 0;
													foreach ($court->getBooking()->getPlayers() as $player) {
														echo "{$player->getName()}";
														if($loop < $playerCount - 1) {
															echo " - ";
														}
														$loop++;												
													}
												}
												
												echo $court->getBooking()->getDescription();
						
												?>
											</a>
										</td>
											<?php
												} else {
											?>
										<td id="<?php echo $court->getId(); ?>">										
											<a href="?cmd=matchType&booid=<?php echo $court->getId(); ?>" id="<?php echo $court->getId(); ?>">
												Platz <?php echo $court->getCourtNr(); ?> Reservieren
											</a>
										</td>
										<?php
												}
											}
										?>
									</tr>
								</table>
							</div>								
						<?php } ?>
						</div>
						
					</div>
				<?php $i++; } ?>
				</div>
			</div>
			
			<footer>
				<div data-role="footer">
					<h1>&copy; 2014 by Tc-Buttisholz</h1>
				</div>
			</footer>
		</div>
		
	</body>
</HTML>
