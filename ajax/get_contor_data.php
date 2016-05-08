<?php

require_once '../model/model.php';

$conectInfo = array(
           'host' => 'localhost',
           'database' => 'firma_database',
           'username' => 'root',
           'password' => '',
           );

$m = new model($conectInfo);

$min = isset($_POST['min']) ? intval(explode(':', $_POST['min'])[1]) : 1;

$m->addTime($_POST['userId'], $_POST['start'], $min);
