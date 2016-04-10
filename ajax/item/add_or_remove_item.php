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

$type = Helper::normalizeItemType($model->getItemType());

if(isset($_POST['monitor_index']) && $_POST['monitor_index'] != 0)
	Helper::getItem($_POST['monitor_index'], $_POST['user_id'], $type[$_POST['monitor_index']], $model);

if(isset($_POST['unitate_index']) && $_POST['unitate_index'] != 0)
	Helper::getItem($_POST['unitate_index'], $_POST['user_id'], $type[$_POST['unitate_index']], $model);

if(isset($_POST['mouse_index']) && $_POST['mouse_index'] != 0)
	Helper::getItem($_POST['mouse_index'], $_POST['user_id'], $type[$_POST['mouse_index']], $model);
