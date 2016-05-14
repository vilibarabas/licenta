<?php
require_once '../../model/model.php';
require_once '../../core/helper.php';
require("../../core/phpmailer.php");
require("../../core/smtp.php");

date_default_timezone_set('Europe/Bucharest');

$date = date('Y-m-d H:i:s');
$text = $_GET['text'];

$text = nl2br($text);
$text = str_replace('<br />' , ' ', $text);
if($_GET['send'])
{
	if(!!$_GET['to'])
	{
		@$emails = explode(';', $_GET['to']);
		
		foreach($emails as $email)
		{
			$mail = new PHPMailer();

			$mail->IsSMTP();
			$mail->SMTPAuth = true; // enable SMTP authentication
			$mail->SMTPSecure = "ssl"; 
			$mail->Host = "plus.smtp.mail.yahoo.com";
			$mail->Port = 465; // set the SMTP port
			$mail->Username = 'licenta.raport@yahoo.com';
			$mail->Password = "12345qwert"; 
			$mail->From = 'licenta.raport@yahoo.com';
			$mail->FromName = $_GET['user'];
			$mail->AddAddress($email);
			$mail->Subject = "Raport ". $date;
			$mail->Body = $text;

			if(!$mail->Send())
			{
				Helper::message('Mesajul nu s-a trimis <br>Mailer error: '. $mail->ErrorInfo, 'danger');
			}
			else
			{
				Helper::message('Raportul a fos trimis cu succes pe adresa '. $email, 'success');
			}
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
	Helper::message('Raportul a fost salvat cu succes!', 'success');
}
