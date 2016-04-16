<!DOCTYPE html>
<html>
	<head>
	<title>Licenta</title>
	<?php
		include "controller/controller.php";
		include "core/helper.php";
	    $controller = new Controller('statistics');
	?>
	<style type="text/css">
	</style>        
	</head>

	<body>
		<?php
	    	$controller->getMeniu('profil');
	    	
	    ?>
	    
	    <div class="container">
	    	<div class="row">
	    		<div id="data_select_container" class="col-md-6">
	    			<div class="row">
	    				<div class="col-md-1"><span>An</span></div>
	    				<div class="col-md-1"><span id="year_print"><?php echo date('Y')?></span></div>
	    				<div class="col-md-1"><center> | </center></div>
	    				<div class="col-md-3"><span>Selectati Data</span></div>
	    				<div class="col-md-1"><button id="prev" class="glyphicon glyphicon-chevron-left"></button></div>
	    				<div class="col-md-2"><center><span id="data_input">April</span></center></div>
	    				<div class="col-md-1"><button id="next" class="glyphicon glyphicon-chevron-right"></button></div>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="loader"></div>
	    	<div class="row" id="list_content">
	    	</div>
	    </div>
	</body>
</html>
	    