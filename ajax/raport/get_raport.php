<?php

require_once '../../model/model.php';
require_once '../../core/helper.php';
$conectInfo = array(
           'host' => 'localhost',
           'database' => 'firma_database',
           'username' => 'root',
           'password' => '',
           );

$m = new model($conectInfo);

$date = DateTime::createFromFormat('d/M/Y', $_GET['data']);
$date = $date->format('Y-m-d');

$raport = $m->getRaport($date, $_GET['user']);

if(!empty($raport)) {
	Helper::printRaport($raport[0]);
}
else {
	Helper::message('In data selectata nu s-a trimis raport', 'danger');
}