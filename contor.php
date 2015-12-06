<!DOCTYPE html>
  <?php
    include "controller/controller.php";
    $controller = new Controller();
  ?>
<script>
     $(document).ready(function() {

          $('#contor').reload();  //(this).reset();  

    });
</script>
<body>
  <?php
    $controller->getMeniu('contor');
?>
    <form method="POST" action="contor.php" id="contor">
        <center>
            <table class="table table-striped" id="contor_table">
                <tr>
                    <th class="btn btn-info">
                    <?php
                        $time = '';
                    
                        if(!isset($_POST['start']))
                        {    
                            $time = $controller->verifyContor(date("Y-m-d"), $_SESSION['UserData']->user_id);
                        }
                        
                        
                        if(!isset($_POST['start']) && empty($time) || isset($_POST['end']))
                        {
                            echo '<input class="btn btn-warning" value="Porneste" type="submit" name="start" id="start"/>';
                        }
                        else
                        {
                            echo '<input class="btn btn-warning" value="Opreste" type="submit" name="end" id="end"/>';
                        }
                     ?>  
                    </th>
                    <th>
                        <p id="timp_lucrat"></p>
                        <p id="timp_lucrat2"></p>
                    </th>
                    
                    <?php
                        
                        if(!isset($_POST['start']) && empty($time) || isset($_POST['end']))
                        {
                            $time = 0;
                            echo '<th class="btn btn-danger"><p>Contorul este Oprit</p>';
                        }
                        else
                        {
                            if(empty($time))
                                $time = $controller->getTime(date("Y-m-d H:i:s"), $_SESSION['UserData']->user_id);
                            echo '<th class="btn btn-success"><p>Contorul este Pornit</p>';
                        }
                        
                     ?>
                    
                    </th>
                </tr>
            </table>
        </center> 
    </form>
</body>



<script>
var myVar = setInterval(myTimer, 1000);

function myTimer() {
    
    var time = '<?php echo $time;?>';
    if(time != 0)
    {
     time = time.split(':');
     var d = new Date();
     d = d.toLocaleTimeString().split(' ')[0];
     d = d.split(':');
     var new_time = [];
     var pct = [];
     new_time[0] = (d[0]-time[0]) + 12;
     new_time[1] = d[1]-time[1];
     new_time[2] = d[2]-time[2];
     
     if(d[1]-time[1] < 0)
     {
         new_time[1] = 60+(d[1]-time[1]);
         if(new_time[1] < 10)
         {
            new_time[1] = '0' + new_time[1];
         }
         --new_time[0];
     }
     
     if(d[2]-time[2] < 0)
     {
         new_time[2] = 60+(d[2]-time[2]);
         
         --new_time[1];
     }
    if(new_time[2] < 10)
    {
       pct[0] = ':0';
    }
    else
    {
        pct[0] = ':';
    }
    if(new_time[1] < 10)
    {
       pct[1] = ':0';
    }
    else
    {
        pct[1] = ':';
    }
     var echo =new_time[0]+  pct[1] + new_time[1]+ pct[0] + new_time[2];
    }
    else
    {
     var echo = '00:00:00';
    }
    document.getElementById("timp_lucrat").innerHTML = echo;
}
</script>

