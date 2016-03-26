<?php

include('../../model/Model.php');

$conectInfo = array(
               'host' => 'localhost',
               'database' => 'firma_database',
               'username' => 'root',
               'password' => '',
               );

$model = new Model($conectInfo);

if($_POST['yourPassword'] == $_POST['current'])
{
	if($_POST['current'] == $_POST['newPass'] && $_POST['newPass'] == $_POST['confirm'])
	{
		echo '<div class="alert alert-warning">

			        <a href="#" class="close" data-dismiss="alert">&times;</a>

			        <strong>Warning!</strong> Incercati o parola diferita de cea curenta!
			    </div>';	
	}
	elseif(empty($_POST['newPass']) && empty($_POST['confirm']))
	{
		echo '<div class="alert alert-warning">

			        <a href="#" class="close" data-dismiss="alert">&times;</a>

			        <strong>Warning!</strong> Nu ati completat campurile pentru noua parola!
			    </div>';	
	}
	elseif(!empty($_POST['newPass']) && $_POST['newPass'] == $_POST['confirm'])
	{
			echo '<div class="alert alert-success">

			        <a href="#" class="close" data-dismiss="alert">&times;</a>

			        <strong>Success!</strong> Ati resetat parola cu succes!
			    </div>';
		$model->resetPassword($_POST['user_id'], $_POST['newPass']); 

	}
	else
	{
		echo '<div class="alert alert-warning">

			        <a href="#" class="close" data-dismiss="alert">&times;</a>

			        <strong>Warning!</strong> Cele doua parole nu corespund!
			    </div>';
	}
}
else
{
	echo '<div class="alert alert-danger">

			        <a href="#" class="close" data-dismiss="alert">&times;</a>

			        <strong>Error!</strong> Ati gresit parola curenta!
			    </div>';
}