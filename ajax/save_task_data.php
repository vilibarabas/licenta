<?php

require_once '../model/model.php';

$conectInfo = array(
           'host' => 'localhost',
           'database' => 'firma_database',
           'username' => 'root',
           'password' => '',
           );

$m = new model($conectInfo);

$m->saveTaskChange($_POST['user'], $_POST['status'], $_POST['task_id'], $_POST['percent'], $_POST['descriotion'], $_POST['observation'], $_POST['priority']);