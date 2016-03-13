<?php

require_once '../model/model.php';

$conectInfo = array(
           'host' => 'localhost',
           'database' => 'firma_database',
           'username' => 'root',
           'password' => '',
           );

$m = new model($conectInfo);


$data = date("d-m-Y :i:s");
$hr = date("H")+1;

if($hr < 10)
{
	$hr = '0'. $hr;
}
$data2 = explode(" ", $data);
$data = $data2[0]. ' '.$hr. $data2[1];

$m->addTime($_POST['userId'], $data, $_POST['start']);
