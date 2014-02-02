<div data-role="collapsible" data-mini="true">
	<h4><?php echo date('l, d. F Y', $day->getDate()); ?></h4>
	<?php 
	//$renderer->renderHourList($day->getHours()); 
	$renderer = new Renderer();
	?>
</div>