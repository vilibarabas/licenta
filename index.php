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
  <div class="container">
    <h2>Bun venit la IT Mania</h2>
    <h4>Ca inceput de zi nu uita sa-ti pornesti contorul!</h4>
  </div>
</body>
