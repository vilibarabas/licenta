<?php

include('../../model/Model.php');

$conectInfo = array(
               'host' => 'localhost',
               'database' => 'firma_database',
               'username' => 'root',
               'password' => '',
               );

$model = new Model($conectInfo);

if($_POST['name'] && $_POST['user_id'] && $_POST['username'] && $_POST['department'] && $_POST['acces_index'] && $_POST['functie'] && is_numeric($_POST['acces_index']))
{
	
	$model->saveUserData($_POST['user_id'], $_POST['name'], $_POST['username'], $_POST['department'], $_POST['acces_index'], $_POST['functie']);

	echo '<div class="alert alert-success">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong>Success!</strong> Ati modificat cu succes datele uutilizatorului : ', $_POST['name'],'.

    </div>';
}
else
{
	$message = 'Nu ati completat toate campurile!';

	if(!is_numeric($_POST['acces_index']))
	{
		$message = 'Accesindex trebuie sa fie un numar!';
	}	

	echo '<div class="alert alert-danger">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong>Error!</strong>', $message,'

    </div>';	
}