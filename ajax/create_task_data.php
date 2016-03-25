<?php

require_once '../model/model.php';

$conectInfo = array(
           'host' => 'localhost',
           'database' => 'firma_database',
           'username' => 'root',
           'password' => '',
           );

$m = new model($conectInfo);
if(!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['observation']) && !empty($_POST['time']) && is_numeric($_POST['time'])) 
{
	$m->createProject($_POST['name'], $_POST['description'], $_POST['observation'], $_POST['time']);
	echo '
    <div class="alert alert-success">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong>Success!</strong> You create a new project.

    </div>

';
}
elseif(!is_numeric($_POST['time']) || $_POST['time'] == 0)
{
	echo '
    <div class="alert alert-danger">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong>Error!</strong> Introduceti numarul de ore la campul pentru timpul de lucru!.(Mai mare decat 0)

    </div>

';
}
else
{
	echo '
    <div class="alert alert-danger">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong>Error!</strong> Completatitoate campurile!.

    </div>

';
}