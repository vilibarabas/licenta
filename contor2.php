<!DOCTYPE html>
<head>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="js/contor.js"></script>
<script src="js/ajax.js"></script>
<script src="js/isActivContor.js"></script>
  <?php
    include "controller/controller.php";
    $controller = new Controller();
  ?>
<script>

</script>
</head>

<body onload="startTime()">
      <?php
    $controller->getMeniu('contor');
    $table = 'time_manager_'. str_replace('.', '_', $_SESSION['UserData']->username). '_'. $_SESSION['UserData']->user_id;
    $contor_data = $controller->verifyContor($table);

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
        echo "<input id='last_time' hidden='hidden' value='' />";
    }

    ?>
    <div class="table-responsive">
    <table id="contor_table" class="table table-bordered">

        <tr>
            <td>
                <center><button id="start_button" type="submit" onclick="clickStart()" class="label label-warning" style="width:100%"><h4>START</h4></button></center>
                <center><button id="stop_button" type="submit" onclick="clickstop()" class="label label-warning" style="width:100%;display:none" ><h4>OPRESTE</h4></button></center>
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
            $controller->getWorkingTimeToday($table);
         ?>
    </table>
    </div>
</body>
</html>