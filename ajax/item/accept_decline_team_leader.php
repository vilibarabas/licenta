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
	$model->teamLeaderAccept($_POST['nr'], 1);
	Helper::message('Userul '. $_POST['user']. ' va primi un nou '. $_POST['item']. '!!', 'success');
}
if(isset($_POST['decline']))
{
	$model->teamLeaderAccept($_POST['nr'], 0);
	Helper::message('Nu ati acceptat userului '. $_POST['user']. ' un nou '. $_POST['item']. '!!', 'danger');
}