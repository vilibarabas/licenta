<?php
include('../../model/model.php');
include('../../core/helper.php');

$conectInfo = array(
           'host' => 'localhost',
           'database' => 'firma_database',
           'username' => 'root',
           'password' => '',
           );
$model = new Model($conectInfo);

if(isset($_POST['accept']))
{
	$model->adminAccept($_POST['nr'], 1);
	Helper::message('Ati instalat userului '. $_POST['user']. ' unitatea '. $_POST['item']. '!!', 'success');
}
if(isset($_POST['decline']))
{
	$model->adminAccept($_POST['nr'], 0);
	Helper::message('Ati sters cererea userului '. $_POST['user']. ' pentru unitatea '. $_POST['item']. '!!', 'danger');
}