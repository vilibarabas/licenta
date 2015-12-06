<?php

include "model/model.php";

class Controller
{
    public $active;
    private $conectInfo;
    public function __construct()
    {
    $this->conectInfo = array(
           'host' => 'localhost',
           'database' => 'firma_database',
           'username' => 'root',
           'password' => '',
           );
      session_start();
      echo '<head>
            <title>Licenta</title>
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="style/style.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
          </head>';
            $model = new Model($this->conectInfo);         
            if(isset($_POST['start']) && empty($model->verifyContor(date("Y-m-d"), $_SESSION['UserData']->user_id)))
            {
                $model = new Model($this->conectInfo);
                
                $model->addContorData(date("Y-m-d "). (date("H")+ 1) . date(":i:s"), $_SESSION['UserData']->user_id, 'start');
            }
            
            if(isset($_POST['end']) && !empty($model->verifyContor(date("Y-m-d"), $_SESSION['UserData']->user_id)))
            {
                $model = new Model($this->conectInfo);
                $model->addContorData(date("Y-m-d "). (date("H")+ 1) . date(":i:s"), $_SESSION['UserData']->user_id, 'end');
            }
    }
    
    public function verifyUsers($username, $password)
    {
        
        $model = new Model($this->conectInfo);
        $users = $model->getUser($username, $password);
        
        return $users;
        
    }
    public function verifyContor($date, $user_id)
    {
        
        $model = new Model($this->conectInfo);
        return $model->verifyContor($date, $user_id);
    }
    
    public function getMeniu($active)
    {
        $this->active = $active;
        include 'view/meniu.php';
    }
    
    
    public function getTime($time, $id)
    {
        $date = $time;
        $time = explode(':', explode(' ', $time, 2)[1]);
        $time = 60*60*$time[0]+60*$time[1]+$time[2];
        $current = explode(':', date("H:i:s"));
        $current = 60*60*$current[0]+60*$current[1]+$current[2];
        $rez = $current - $time;
        $sec = $rez%60;
        $min1 = ($rez - $sec)/60;
        $min =  $min1%60;
        $hour = ($min1 - $min)/60;
        $time = $hour. ':'. $min. ':'. $sec;
        
        return explode(' ', $date, 2)[1];
    }
    
    public function logOut()
    {
        echo "<p class=\"navbar-right\" style=\"margin:0 auto;padding-top:10px;color:#FFFFFF;font-size:15px;\"><span > Hello ", $_SESSION['UserData']->name, "</span>";
        echo "<span><a href=\"?action=logout\"> LogOut</a></span></p>";
        if(isset($_GET['action']))
        if($_GET['action'] === 'logout')
        {
            session_destroy();
            header("location:login.php");
        }
        
    }
}