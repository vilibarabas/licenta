<?php
require_once '../../model/model.php';
require_once '../../core/helper.php';

date_default_timezone_set('Europe/Bucharest');

$date = date('Y-m-d H:i:s');
$text = $_GET['text'];
//$text = str_replace('+' , '<br>', $text);
$text = nl2br($text);

if($_GET['send'])
{
	if(!!$_GET['to'])
	{
		@$emails = explode(';', $_GET['to']);
		
		foreach($emails as $email)
		{
			$head = "From: example@example.com\r\n";
		    $head .= "Content-type: text/html\r\n";
		    $title= "Title Test";
		    $body = "The text in the textarea";  
		    $success = mail($email, $title, $text, $head);
		    echo PHP_EOL, 'SUCCES', PHP_EOL;
		}	
	}	
}


$conectInfo = array(
           'host' => 'localhost',
           'database' => 'firma_database',
           'username' => 'root',
           'password' => '',
           );


$m = new model($conectInfo);

if(!!$_GET['text']){
	$m->saveRaport($text, $date, $_GET['userId']);

	Helper::message('Raportul a fost trimis cu succes!', 'success');
}
