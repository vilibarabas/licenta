<!DOCTYPE html>
<html>
    <head>
        <title>Licenta</title>
               
      <?php
        include "controller/controller.php";
        $controller = new Controller('raport_manager');
      ?>
    <style type="text/css">
   
  </style>  
    </head>

    <body>
        <?php
            $controller->getMeniu();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-3" >
                    <div id="datapicker_container">
                        <p id="data_input">
                            <laber>&nbsp Data : </laber>
                            <input type="text" class="datepicker"/>
                        </p>
                        <div id="date_container">
                            
                            <div class="row" id="mounth_cont">    
                                <div class="col-md-2"></div>
                                <div class="col-md-1">
                                    <a href="#" class="glyphicon glyphicon-menu-left" id="previev_month"></a>    
                                </div>
                                <div class="col-md-6">
                                    <center><span id="current_date"></span>   </center>
                                </div>
                                 <div class="col-md-1">
                                    <a href="#" id="next_month" class="glyphicon glyphicon-menu-right" style="floar-left"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">

                    <div id="select_container">
                        <div class="row">
                            <div class="col-md-2">
                                <h4>Team </h4>
                            </div>
                            <div class="col-md-8">
                                 <?php
                                    echo '
                                        <select id="select_user" class="form-control">
                                            <option>select...</option>
                                            ', $controller->getSelectUsers($_SESSION['UserData']->department, $_SESSION['UserData']->user_id), '
                                        </select>
                                    ';
                                ?>
                            </div>
                            <div class="col-md-2">
                                <button id="get_raport" class="btn btn-info">Print</button>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="raport_get">
                
            </div>
        </div>
    </body>
</html>