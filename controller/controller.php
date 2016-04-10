<?php

@include "model/model.php";

class Controller
{
    public $active;
    private $conectInfo;
    private $headElements;
    private $page;
    public $model;

    public function __construct($page)
    {
        $this->page = $page;
        
        $this->conectInfo = array(
               'host' => 'localhost',
               'database' => 'firma_database',
               'username' => 'root',
               'password' => '',
               );
        $this->headElements = array(
                          'register' => array(
                                            '<script src="js/user.js"></script>',
                                            '<link rel="stylesheet" type="text/css" href="style/login.css">'
                                            ),
                          'profil' => array(
                                            '<link rel="stylesheet" type="text/css" href="style/item.css">',
                                            '<script src="js/item.js"></script>',
                                            '<script src="js/ajax_item.js"></script>',
                                            '<script src="js/user.js"></script>'
                                            ),
                          'contor' => array(
                                            '<script src="js/isActivContor.js"></script>',
                                            '<script src="js/contor.js"></script>',
                                            ),
                          'administrator' => array(
                                            '<script src="js/ajax_item.js"></script>',
                                            '<script src="js/admin.js"></script>'
                                            ),
                          'statistics' => array(
                                            '<script src="js/statistics/statistics.js"></script>',
                                            '<link rel="stylesheet" type="text/css" href="style/statistics.css">',
                                            '<script src="js/statistics/ajax.js"></script>',
                                            '<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>',
                                            ),
                          'login' => array('<link rel="stylesheet" type="text/css" href="style/login.css">')
                        );
        $this->model = new Model($this->conectInfo); 
        session_start();
        $this->addHead($page);

        if(isset($_POST['save_project_update']))
        {
            $this->model->saveTaskChange($_POST['user'], $_POST['select_status'], $_POST['task_id'], $_POST['select_percent'], $_POST['description'], $_POST['observation']);
            unset($_POST['save_project_update']);
        }
    }
    
    private function addHead($page)
    {
        echo '<link rel="stylesheet" type="text/css" href="style/style.css">
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">    
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <script src="js/ajax.js"></script>';
        if(isset($this->headElements[$page]))
            foreach($this->headElements[$page] as $val)
            {
                echo $val, PHP_EOL;
            }
    }

    public function verifyUsers($username, $password)
    {
        $this->model = new Model($this->conectInfo);
        $users = $this->model->getUser($username, $password);
        return $users;
        
    }

    public function verifyContor($id)
    {

        $model = new Model($this->conectInfo);
        return $model->verifyContor($id);
    }
    
    public function getMeniu()
    {
        $this->active = $this->page;
        include 'view/meniu.php';
    }
    public function logOut()
    {
        if(!isset($_SESSION['UserData']))
        {
            header("location:login.php");
        }

        echo "<p class=\"navbar-right\" style=\"margin:0 auto;padding-top:10px;color:#FFFFFF;font-size:15px;\"><span> Hello ", $_SESSION['UserData']->name, "</span>";
        echo "<span><a href=\"?action=logout\"> LogOut</a></span></p>";
        echo "<input id='user_name' hidden='hidden' value='", $_SESSION['UserData']->username, "'/>";
        echo "<input id='user_id' hidden='hidden' value='", $_SESSION['UserData']->user_id, "'/>";
        echo "<input id='user_department' hidden='hidden' value='", $_SESSION['UserData']->department, "'/>";
        if(isset($_GET['action']))
        if($_GET['action'] === 'logout')
        {
            session_destroy();
            header("location:login.php");
        }
        
    }

    public function getAllWorkingTime($id)
    {
        $model = new Model($this->conectInfo);
        $result = $model->getAllWorking($id);
        
        $inainte = '1111';
        if(!empty($result))
        {
            foreach($result as $rez)
            {
                if(empty($rez->end_time))
                {
                    continue;
                }
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
                
                $this->addZero($sec);
                $this->addZero($min);
                $this->addZero($hr);
                if(!strstr($rez->start_time, $inainte))
                {
                    if($inainte !== '1111')
                    {
                        echo '</table>';
                    }

                    echo '<br><table id="contor_table" class="table table-bordered">
                        
                        <tr class="header">
                            <th>
                                <center>'. explode(' ',  $rez->start_time)[0]. '</center>
                                
                            </th>
                            <th>
                                
                            </th>
                            <th>
                                
                            </th> 
                        </tr>';
                   
                    $inainte = explode(' ',  $rez->start_time)[0];
                }
                echo "<tr>";
                echo "<td><center>Timp efectiv lucrat</center></td>";
                echo "<td><center>", $hr ? $hr : "00" , " : ", $min ? $min : "00", " : ", $sec ? $sec : "00" ,"</center></td>";
                echo "<td><center>". $rez->start_time. '<br/>'. $rez->end_time."</center></td>";
                echo "</tr>";
            }
        }
    }

    public function getWorkingTimeToday($id)
    {
        $model = new Model($this->conectInfo);
        $result = $model->getWorking($id);
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
            echo "<td><center id='total_hours'>", $totalhr ? $totalhr : "00" , " : ", $totalmin ? $totalmin : "00", " : ", $totalsec ? $totalsec : "00" ,"</center></td>";
            echo "<td><center>".  $result[0]->start_time . '<br/>'. $result[count($result)-1]->end_time ."</center></td>";
            echo "</tr>";
        }
    }

    public function getAllTaskToWork($id, $team)
    {
        
        $this->model = new Model($this->conectInfo);
        $select = $this->model->getTaskFromUser($id, $team);
        if(!empty($select))
            foreach($select as $sel)
            {
                echo '<option value="'. $sel->id. '">'. $sel->task_name. '</option>';
            }
    } 

    public function getSelectStatus($status_activ)
    {
        $select = $this->model->getallStatus();
        if(!empty($select))
            foreach($select as $sel)
            {
                echo '<option value="', $sel->status_id, '" ', $status_activ == $sel->status_id ? 'selected' : '','>', $sel->status_name, '</option>';
            }
    }

    public function getSelectUsers($team, $id, $user_id = -1)
    {
        $select = $this->model->getallUsersFromTeam($team, $id);
        if(!empty($select))
            foreach($select as $sel)
            {
                echo '<option value="', $sel->user_id, '" ', $user_id == $sel->user_id ? 'selected' : '', '>', $sel->name, '</option>';
            }
    }

    private function addZero(&$v)
    {
        if($v > 0 && $v < 10)
        {
            $v = '0'. $v;
        }
    }

    public function getPostValue($key)
    {
        if(isset($_POST[$key]))
            if($_POST[$key] != 'All')
                return $_POST[$key];
        return false;
    }
    //profile item select 

    public function selectItem($type)
    {
        $list = $this->model->getItemList($type);
        
        echo '<select class="form-control" id="select_', $type,'"><option value="0">Select...</option>';

        foreach($list as $li)
        {
            echo '<option value="', $li->index,'">', $li->name,'</optopn>';
        }

        echo '</select>';
    }
}