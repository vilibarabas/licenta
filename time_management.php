<!DOCTYPE html>
<head>

<title>Licenta</title>
           
  <?php
    include "controller/controller.php";
    $controller = new Controller('time_management');
  ?>
</head>

<body>
     <?php
    	$controller->getMeniu();
   	?>
    <div class="container">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_c" data-toggle="tab">Time Management</a></li>
         
        </ul>
        <div class="tab-content">
            
            <div class="tab-pane active" id="tab_c">
                <div class="table-responsive">
                    <div id="time_management_container">
                    <input id="users_data_json" value='' hidden/>
                        <div id="date_container">
                          <center><p><span id="previev_month" class="glyphicon glyphicon-arrow-left"></span><span id="current_date"></span><span id="next_month" class="glyphicon glyphicon-arrow-right"></span></p></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="loader"></div>
    </div>
</body>
</html>