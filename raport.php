<!DOCTYPE html>
<head>

<title>Licenta</title>
           
  <?php
    include "controller/controller.php";
    $controller = new Controller('raport');
  ?>
</head>

<body>
    <?php
        $controller->getMeniu();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>Raport | 
                <?php
                  if($_SESSION['UserData']->acces_index == 2) {
                    echo '<a class="btn btn-info" href="raport_manager.php"><span class="glyphicon glyphicon-list"></span> Verifica Raport</a>';
                  }
                ?></h3>
            </div>
            <div class="col-md-8">
                <div class="raport_send_succes">
                    
                </div>
            </div>
        </div>
        <form role="form">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="to_email" >
          </div>
          <div class="form-group">
            <textarea id="email_message" style="width:100%;height:200px;"></textarea>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" id="send_checked"> Trimite Email</label>
          </div>
          <button type="button" id="send_raport" class="btn btn-default">Trimite <span class="glyphicon glyphicon-send"></span></button>
        </form>
        <div class="loader"></div>
    </div>
</body>
</html>