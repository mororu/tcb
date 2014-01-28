<div data-role="collapsible" data-mini="true">
	<h4><?php echo date('l, d. F Y', $item->getDay()); ?></h4>
	<?php render('tmp-times', $item->getTimes()); ?>
</div>