<!DOCTYPE html>
<html>
	<head>
	<title>Licenta</title>
	<?php
		include "controller/controller.php";
		include "core/helper.php";
	    $controller = new Controller('statistics');
	?>
        
	</head>

	<body>
		<?php
	    	$controller->getMeniu('profil');
	    	
	    ?>
	    
	    <div class="container">
	    	<div class="row">
	    		<div id="data_select_container">
	    			<span>An</span>
	    			<span id="year_print"></span>
	    			<span> | Selectati Data</span>
	    			<button id="prev" class="glyphicon glyphicon-chevron-left"></button>
	    			<span id="data_input">

	    			</span>
	    			<button id="next" class="glyphicon glyphicon-chevron-right"></button>
	    		</div>
	    	</div>
	    	<div class="loader"></div>
	    	<div class="row" id="list_content">
	    	</div>
	    </div>
	</body>
</html>
	    