<div class="items">
	<div id="item_message" class="row">
	</div>
	<div id="monitor_container" class="row">
		<?php 
		if(!isset($items['monitor'][1]) && isset($items_asked['monitor'][0]))
		{
			
			Helper::nextItem($items_asked['monitor'], 0, 1); 
		}
		else
		{
			Helper::nextItem($items['monitor'], 1); 
		}
		?>
		<?php Helper::nextItem($items['monitor'], 0); ?>
		<?php
		if(!isset($items['monitor'][2]) && isset($items['monitor'][1]) && isset($items_asked['monitor'][0]))
		{
			Helper::nextItem($items_asked['monitor'], 0, 1); 
		}
		else
		{
			Helper::nextItem($items['monitor'], 2); 
		}
		 ?>
  		<div class="col-sm-3">
  			<?php
				$controller->selectItem('monitor');
			?>
  			<button id="add_monitor">Add Monitor</button>
  		</div>
	</div>
	<div id="tastatura_mouse_container" class="row">
		<div class="col-sm-3">
			<img class="casti" src="img/casti.jpg">
			<?php Helper::printDescription($items['casti'][0]->description); ?>
		</div>
		<div class="col-sm-3">
			<img class="tastatura" src="img/tastatura.jpg">
			<?php Helper::printDescription($items['tastatura'][0]->description); ?>
		</div>
		<div class="col-sm-3">
			<img class="mouse" src="img/mouse.jpg">
			<?php Helper::printDescription($items['mouse'][0]->description); ?>
		</div>
		<div class="col-sm-3">
			<?php
				$controller->selectItem('mouse');
			?>
			<button id="add_mouse">Add</button>
		</div>
	</div>
	<div id="unitate_container" class="row">
		<?php Helper::nextItem($items['unit'], 0); 

		if(!isset($items['unit'][2]) && isset($items_asked['unit'][0]))
		{
			Helper::nextItem($items_asked['unit'], 0, 1); 
		}
		else
		{
			Helper::nextItem($items['unit'], 1); 
		}
		if(!isset($items['unit'][2]) && isset($items['unit'][1]) && isset($items_asked['unit'][0]))
		{
			Helper::nextItem($items_asked['unit'], 0, 1); 
		}
		else
		{
			Helper::nextItem($items['unit'], 2); 
		}
		?>
		
		<div class="col-sm-3">
			<?php
				$controller->selectItem('unit');
			?>
			<button id="add_unitate">Add Unitate</button>
		</div>
	</div>
</div>