<?php

require_once '../model/model.php';

$conectInfo = array(
           'host' => 'localhost',
           'database' => 'firma_database',
           'username' => 'root',
           'password' => '',
           );

$m = new model($conectInfo);
$sigur = 0;
if(isset($_POST['sigur']))
{
	$val = finalyDelete();
	if($val === $_POST['sigur'])
		$sigur = 1;
}

if($_POST['delete_1'] !== 'select...')
{
	askForDelete($m->deleteProject($_POST['delete_1'], $sigur));
}
elseif($_POST['delete_2'] !== 'select...')
{	
	askForDelete($m->deleteProject($_POST['delete_2'], $sigur));
}
else
{
	echo '
    <div class="alert alert-danger">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong>Error!</strong> Nu ati selectat nici un proiect pentru a fi sters!.

    </div>';
}

function askForDelete($why)
{
	$val = finalyDelete();
	if($why)
	{
		echo '
		    <div class="alert alert-warning">

		        <a href="#" class="close" data-dismiss="alert">&times;</a>

		        <strong>Atentie!</strong> Acest peoject este incepuit deja esti sigur ca vrei sa il stergi?.
		        <input hidden id="sigurSterg" value="'.$val.'"/>
		       	<strong>Apasa din nou pe stergere!</strong>
		    </div>';
	}
	elseif(isset($_POST['sigur']) && $val !== $_POST['sigur'])
	{
		echo '
		    <div class="alert alert-warning">

		        <a href="#" class="close" data-dismiss="alert">&times;</a>

		        <strong>HEEEEEEEEEEEEEEEEEEEEEEE!</strong> Acest peoject este incepuit deja esti sigur ca vrei sa il stergi?.
		        <input hidden id="sigurSterg" value="'.$val.'"/>
		       	<strong>Apasa din nou pe stergere!</strong>
		    </div>';
	}	
	else
	{
		echo '
		    <div class="alert alert-success">

		        <a href="#" class="close" data-dismiss="alert">&times;</a>

		        <strong>Success!</strong> You deleted project from your team list.

		    </div>';
	}
}

function finalyDelete(){
	$val = '';

	if($_POST['delete_2'] !== 'select...')
	{
		$val = '1_'. $_POST['delete_2']. "_2";	
	}
	
	if($_POST['delete_1'] !== 'select...')
	{
		$val = '1_'. $_POST['delete_1']. "_1";	
	}

	return $val;
}