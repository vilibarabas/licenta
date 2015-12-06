<!DOCTYPE html>
  <?php
    include "controller/controller.php";
    $controller = new Controller();
  ?>

<body>
  <?php
    $controller->getMeniu('index');
  ?>
</body>
