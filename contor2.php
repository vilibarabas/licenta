<!DOCTYPE html>
<head>

<title>Licenta</title>
           
  <?php
    include "controller/controller.php";
    $controller = new Controller('contor');
  ?>
</head>

<body onload="startTime()">
      <?php
    $controller->getMeniu();
    $contor_data = $controller->verifyContor($_SESSION['UserData']->user_id);
    if(!empty($contor_data))
    {
        echo "<input id='last_date' hidden='hidden' value='". explode(' ', $contor_data[0]->start_time)[0]."' />";
        $time =  explode(':' , explode(' ', $contor_data[0]->start_time)[1]);
        echo "<input id='last_hours' hidden='hidden' value='". preg_replace('/^(0)/', '', $time[0])."' />";
        echo "<input id='last_min' hidden='hidden' value='". preg_replace('/^(0)/', '', $time[1])."' />";
        echo "<input id='last_sec' hidden='hidden' value='". preg_replace('/^(0)/', '', $time[2])."' />";
    }
    else
    {
        echo "<input id='last_date' hidden='hidden' value='' />";
    }

    ?>
    
    <div class="container">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_a" data-toggle="tab">Contor</a></li>
          <li><a href="#tab_b" data-toggle="tab">User Time</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_a">
                <div class="table-responsive">
                    <table id="contor_table" class="table table-bordered">

                        <tr>
                            <td>
                                <center><button id="start_button" type="submit" onclick="clickStart()"  class="label label-success" style="width:100%"><h4>START</h4></button></center>
                                <center><button id="stop_button" type="submit" onclick="clickstop()" class="label label-danger" style="width:100%;display:none" ><h4>OPRESTE</h4></button></center>
                            </td>
                            <td>
                                <br/>
                                <center><div id="txt"></div></center>
                            </td>
                            <td id="msg_box" style="background-color: #00e600">
                                <center><h4 id="msg"></h4></center>
                            </td> 
                        </tr>
                        <?php 
                            $controller->getWorkingTimeToday($_SESSION['UserData']->user_id);
                         ?>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="tab_b">
                <div class="table-responsive">
                        <?php 
                            $controller->getAllWorkingTime($_SESSION['UserData']->user_id);
                         ?>
                </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>