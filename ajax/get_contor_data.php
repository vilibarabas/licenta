<?php

require_once '../model/model.php';

$conectInfo = array(
           'host' => 'localhost',
           'database' => 'firma_users_time_manager',
           'username' => 'root',
           'password' => '',
           );

$m = new model($conectInfo);

$table = 'time_manager_'. str_replace('.', '_', $_POST['userName']). '_'. $_POST['userId'];
$data = date("d-m-Y :i:s");
$hr = date("H")+1;

if($hr < 10)
{
	$hr = '0'. $hr;
}
$data2 = explode(" ", $data);
$data = $data2[0]. ' '.$hr. $data2[1];

$m->addTime($table, $data, $_POST['start']);
