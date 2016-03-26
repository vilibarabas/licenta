<?php

include('../../model/Model.php');

$conectInfo = array(
               'host' => 'localhost',
               'database' => 'firma_database',
               'username' => 'root',
               'password' => '',
               );

$model = new Model($conectInfo);

if(!empty($_POST['nume']) &&!empty($_POST['prenume']) &&!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm']))
{
	if($_POST['password'] !== $_POST['confirm'])
	{
		echo '<div class="alert alert-danger">

			        <a href="#" class="close" data-dismiss="alert">&times;</a>

			        <strong>Error!</strong> Nu ati introdus aceeasi parola!
			    </div>';		
	}
	elseif(strlen($_POST['password']) < 5)
	{
		echo '<div class="alert alert-danger">

			        <a href="#" class="close" data-dismiss="alert">&times;</a>

			        <strong>Error!</strong> Dati o parola de cel putin 5 caractere!
			    </div>';	
	}
	else
	{
		if($model->getUserName($_POST['username']))
		{
			$model->createNewUser($_POST['username'], $_POST['password'], $_POST['nume'], $_POST['prenume']);
			echo '<div class="alert alert-success">

			        <a href="#" class="close" data-dismiss="alert">&times;</a>

			        <strong>Succes!</strong> Ati creat un cont nou!Va rugam sa asteptati pana vor fi completate datele necesare pentru logare! Multumim pentru rabdare.
			    </div>';
		}
		else
		{
			echo '<div class="alert alert-danger">

			        <a href="#" class="close" data-dismiss="alert">&times;</a>

			        <strong>Error!</strong> Acest nume de utilizator este deja utilizat!
			    </div>';		
		}
	}

}
else
{
	echo '<div class="alert alert-danger">

			        <a href="#" class="close" data-dismiss="alert">&times;</a>

			        <strong>Error!</strong> Nu ati completat toate campurile!
			    </div>';
}