<?php

include('../../model/model.php');
include('../../core/helper.php');

use Helper as H;

$conectInfo = array(
       'host' => 'localhost',
       'database' => 'firma_database',
       'username' => 'root',
       'password' => '',
       );
$model = new Model($conectInfo);
$all_users = $model->getallUsersFromTeam($_POST['department']);

$times = $model->getUserTimeFromTeam($_POST['month'], $_POST['year'], $_POST['department']);

//print_r($times);
$array = array();
foreach($times as $time){
	$index = intval(explode('-', explode(' ', $time->start_time)[0])[2]);
	if(!isset($array[$time->name][$index]))
	{
		$array[$time->name][$index]['h'] = 0;
		$array[$time->name][$index]['i'] = 0;
		$array[$time->name][$index]['s'] = 0;
	}
	$dif = H::getTimeDiff($time->start_time, $time->end_time);
	H::calculTime($array[$time->name][$index], $dif);
}
$object = array();

foreach($all_users as $user){
	$object[$user->name] = new stdClass();
	$object[$user->name]->user = $user->name;
	$object[$user->name]->time[] = 0;
}
foreach($array as $key1 => $arr){
	foreach($arr as $key_day => $a){
		if($a['i'] < 10)
			$a['i'] = '0'. $a['i']; 
		$object[$key1]->time[$key_day] = $a['h']. ':'. $a['i'];  
	}
}
$return = array();
foreach ($object as $obj) {
	$return[] = $obj;
}
print_r(json_encode($return));

//echo '[{"user":"Barabas Bela","time":[0, "8:12","7:45","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00","8:00"]},{"user":"Barabas Bela1","time":[0,"8:12","7:45","8:00"]},{"user":"Barabas Bela1","time":[0,"8:12","7:45","8:00"]},{"user":"Barabas Bela1","time":[0,"8:12","7:45","8:00"]},{"user":"Barabas Bela1","time":[0,"8:12","7:45","8:00"]},{"user":"Barabas Bela1","time":[0,"8:12","7:45","8:00"]},{"user":"Barabas Bela1","time":[0,"8:12","7:45","8:00"]},{"user":"Barabas Bela1","time":[0,"8:12","7:45","8:00"]}]';

//SELECT DATE_FORMAT(NOW(), '%d/%m/%Y %h:%i:%s') 	

