<!DOCTYPE html>
  <?php
    include "controller/controller.php";
    $controller = new Controller('index');
  ?>

<body>
  <?php
    if(!isset($_SESSION['UserData']))
    {
      header("location:login.php");
    }
    $controller->getMeniu('index');
  ?>
</body>
