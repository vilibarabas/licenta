<!DOCTYPE html>
  <?php
    include "controller/controller.php";
    $controller = new Controller('index');
  ?>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="js/isActivContor.js"></script>
    <script src="js/contor.js"></script>
    <script src="js/ajax.js"></script>
<body>
  <?php
    if(!isset($_SESSION['UserData']))
    {
      header("location:login.php");
    }
    $controller->getMeniu('index');
  ?>
</body>
