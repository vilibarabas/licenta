<?php

include "model/model.php";

class Controller
{
    public $active;
    private $conectInfoUsers;
    private $conectInfoContor;
    public $model;
    public function __construct()
    {
        
        $this->conectInfoUsers = array(
               'host' => 'localhost',
               'database' => 'firma_database',
               'username' => 'root',
               'password' => '',
               );
        $this->conectInfoContor = array(
               'host' => 'localhost',
               'database' => 'firma_users_time_manager',
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
    }
    
    public function verifyUsers($username, $password)
    {
        $model = new Model($this->conectInfoUsers);
        $users = $model->getUser($username, $password);
        return $users;
        
    }
    public function verifyContor($table)
    {

        
        $model = new Model($this->conectInfoContor);
        $model->createContorTable($table);
        return $model->verifyContor($table);
    }
    
    public function getMeniu($active)
    {
        $this->active = $active;
        include 'view/meniu.php';
    }
    public function logOut()
    {
        echo "<p class=\"navbar-right\" style=\"margin:0 auto;padding-top:10px;color:#FFFFFF;font-size:15px;\"><span> Hello ", $_SESSION['UserData']->name, "</span>";
        echo "<span><a href=\"?action=logout\"> LogOut</a></span></p>";
        echo "<input id='user_name' hidden='hidden' value='", $_SESSION['UserData']->username, "'/>";
        echo "<input id='user_id' hidden='hidden' value='", $_SESSION['UserData']->user_id, "'/>";
        if(isset($_GET['action']))
        if($_GET['action'] === 'logout')
        {
            session_destroy();
            header("location:login.php");
        }
        
    }

    public function getWorkingTimeToday($table)
    {
        $model = new Model($this->conectInfoContor);
        $result = $model->getWorking($table);
        $totalhr = 0;
        $totalmin = 0;
        $totalsec = 0;

        if(!empty($result))
        {
            foreach($result as $rez)
            {
                list($h1, $m1, $s1) = explode(':', explode(' ',  $rez->start_time)[1]);
                list($h2, $m2, $s2) = explode(':', explode(' ',  $rez->end_time)[1]);
                $hr = $h2-$h1;
                $min = $m2-$m1;
                $sec = $s2-$s1;
                if($sec < 0)
                {
                    $min--;
                    $sec += 60;
                }

                if($min < 0)
                {
                    $hr--;
                    $min += 60;
                }
                $totalhr += $hr;
                $totalmin += $min;

                if($totalmin >= 60)
                {
                    $totalhr++;
                    $totalmin -= 60;
                }
                $totalsec += $sec;
                if($totalsec >= 60)
                {
                    $totalmin++;
                    $totalsec -= 60;
                }

                $this->addZero($sec);
                $this->addZero($min);
                $this->addZero($hr);
                echo "<tr>";
                echo "<td><center>Timp lucrat</center></td>";
                echo "<td><center>", $hr ? $hr : "00" , " : ", $min ? $min : "00", " : ", $sec ? $sec : "00" ,"</center></td>";
                echo "<td><center>". $rez->start_time. '<br/>'. $rez->end_time."</center></td>";
                echo "</tr>";
            }
            $this->addZero($totalsec);
            $this->addZero($totalmin);
            $this->addZero($totalhr);
            echo "<tr>";
            echo "<td><center>Timp total lucrat</center></td>";
            echo "<td><center>", $totalhr ? $totalhr : "00" , " : ", $totalmin ? $totalmin : "00", " : ", $totalsec ? $totalsec : "00" ,"</center></td>";
            echo "<td><center>".  $result[0]->start_time . '<br/>'. $result[count($result)-1]->end_time ."</center></td>";
            echo "</tr>";
        }
    }       
    private function addZero(&$v)
    {
        if($v > 0 && $v < 10)
        {
            $v = '0'. $v;
        }
    }
}