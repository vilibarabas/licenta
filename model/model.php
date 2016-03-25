<?php

require_once 'opis/database/autoload.php';

use Opis\Database\Database,
    Opis\Database\Connection,
    Opis\Database\Schema\CreateTable;

class Model
{
    public $dataBase;
    private $conectInfo;
    public function __construct(array $conectInfo)
    {
        
        $connection = new Connection('mysql:host='. $conectInfo['host'].';dbname='. $conectInfo['database'], $conectInfo['username'], $conectInfo['password']);
        $this->dataBase = new Database($connection);
    }
    
    public function getUser($name, $password)
    {
        $result = $this->dataBase->from('all_users')
                                 ->where('username')->is($name)
                                 ->andWhere('password')->is($password)
                                 ->select()
                                 ->all();
        return $result;
    }
    
    public function addTime($id, $date, $why)
    {

        if($why)
        {
            $this->dataBase->insert(array(
                                 'user_id' => $id,
                                 'start_time' => $date,
                                 'end_time' => ''
                                 ))
                                 ->into('time_manager_all_users');  
        }
        else
        {
            $d = date("d-m-Y");
            $this->dataBase->update('time_manager_all_users')
                        ->where('user_id')->is($id)
                        ->andWhere(function($group){
                            $group->where('end_time')->is('')
                                  ->andWhere('start_time')->like($d."%");
                         })
                        ->set(array(
                                 'end_time' => $date
                                 ));
        }
    }

    public function createContorTable($table_name)
    {
        $tables = $this->dataBase->schema()->getTables(true);

        if(!isset($tables[$table_name]))
            $this->dataBase->schema()->create($table_name, function($table){
            //add column
                $table->integer('time_id')->autoincrement();
                $table->string('start_time');
                $table->string('end_time');
            });   
    }
    
    public function verifyContor($id)
    {
        $this->autoUpdateEndTime($id);
        $date = date("d-m-Y");
        return $result1 = $this->dataBase->from('time_manager_all_users')
                                 ->where('user_id')->is($id)
                                    ->andWhere(function($group){
                                        $group->where('end_time')->is('')
                                              ->andWhere('start_time')->like(date("d-m-Y")."%");
                                     })
                                 ->select()
                                 ->all();
    }

    private function autoUpdateEndTime($id)
    {
        $d = date("d-m-Y");
        $result1 = $this->dataBase->from('time_manager_all_users')
                                    ->where('user_id')->is($id)
                                    ->andWhere(function($group){
                                        $group->where('end_time')->is('')
                                              ->andWhere('start_time')->notLike(date("d-m-Y")."%");
                                     })
                                 ->select()
                                  ->all();
        if(!empty($result1))
        {
            list($day, $hr) = explode(' ', $result1[0]->start_time);
            $hr = explode(':', $hr);
            if(($hr[0]+ 8) < 24)
            {
                $hr[0] += 8;
                $hours = $hr[0]. ':'. $hr[1]. ':'. $hr[2];
            }
            else
            {
                $hours = '23:59:59';
            }
            $end_time = $day. ' '. $hours;
            $this->dataBase->update('time_manager_all_users')
                        ->where('user_id')->is($id)
                        ->andWhere(function($group){
                            $group->where('end_time')->is('')
                                  ->andWhere('start_time')->notLike(date("d-m-Y")."%");
                         })
                        ->set(array(
                                 'end_time' => $end_time
                                 ));
        }
    }
    public function getWorking($id)
    {
        return $result = $this->dataBase->from('time_manager_all_users')
                                ->where('user_id')->is($id)
                                ->andWhere(function($group){
                                    $group->where('end_time')->isNot('')
                                          ->andWhere('start_time')->like('%'. date("d-m-Y").'%');
                                 })
                                 ->select()
                                 ->all();
    }

    public function getAllWorking($id)
    {
        return $result = $this->dataBase->from('time_manager_all_users')
                                    ->where('user_id')->is($id)
                                     ->andWhere('start_time')->like('%'. date("-m-Y").'%')
                                     ->select()
                                     ->all();   
    }

    public function getTaskFromUser($id, $team = null)
    {
        if($id == -1)
        {
           return $this->dataBase->from('users_task_manager')
                             ->where('user_id')->isNull()
                             ->select()
                             ->all();
        }
        if($id == -2)
        {
            $result = $this->dataBase->from('users_task_manager')
                         ->join(['all_users' => 'u'], function($join){
                            $join->on('u.user_id', 'users_task_manager.user_id');
                         })
                         ->where('u.department')->is($team)
                         ->select()
                         ->all();
            return $result;
        }
        if($id == -3)
        {
            return $this->dataBase->from('users_task_manager')
                                 ->select()
                                 ->all();
        }
        else
        {
            return $this->dataBase->from('users_task_manager')
                                 ->where('user_id')->is($id)
                                 ->select()
                                 ->all();
        }
    }
    public function getTask($id, $user_id, $task_id = null)
    {
        if($id == -2) // cererea unui proiect cu prioritate
        {
            $rez = $this->dataBase->from('users_task_manager')
                                 ->where('user_id')->is($user_id)
                                 ->andWhere('priority')->is(1)
                                 ->andWhere('percent')->isNot(100)
                                 ->select()
                                 ->all();
            if(!empty($rez))
                return $rez[0];
            else
                return array();
        }

        if($id != -1 && $task_id == null) // cererea unui proiect al utilizatorilui cu id- ul respectiv
        {
            $rez = $this->dataBase->from('users_task_manager')
                                 ->where('id')->is($id)
                                 ->select()
                                 ->all();
            if(isset($rez[0]))
                return $rez[0];
            else
                return array();
        }
        elseif($task_id != null) //cererea a unui proiect cu id ul respectiv
        {
           $rez = $this->dataBase->from('users_task_manager')
                                 ->where('id')->is($task_id)
                                 ->select()
                                 ->all();
            return $rez[0]; 
        }  
        else // cererea ultimului project care este inceput 
        { 
            $rez = $this->dataBase->from('users_task_manager')
                                 ->where('user_id')->is($user_id)
                                 ->andWhere('percent')->isNot(100)
                                 ->select()
                                 ->all();
            if(isset($rez[count($rez)-1]))
                $rez = $rez[count($rez)-1];
            else
                $rez = array();
            return $rez;
        }
    }
    public function getStatus($id)
    {
        $status =  $this->dataBase->from('all_status')
                                 ->where('status_id')->is($id)
                                 ->select('status_name')
                                 ->all();        
        return $status[0]->status_name;
    }

    public function getAllStatus()
    {
        return $status =  $this->dataBase->from('all_status')
                                 ->select()
                                 ->all();        
    }

    public function saveTaskChange($user, $status, $id, $percent, $description, $observation, $priority = null)
    {
        if($priority == 'true') //setarea unui project ca si cel mai important 
        {
            $this->dataBase->update('users_task_manager')
                    ->where('id')->is($id)
                    ->set(array(
                             'priority' => 1
                             ));
        }
        elseif(($priority == 'false')) // terminarea sesiunii de prioritate
        {
            $this->dataBase->update('users_task_manager')
                    ->where('id')->is($id)
                    ->set(array(
                             'priority' => null
                             ));
        }

        $this->dataBase->update('users_task_manager') // modificarea datelui unui proiect
                    ->where('id')->is($id)
                    ->set(array(
                             'user_id' => $user,
                             'status' => $status,
                             'percent' => $percent,
                             'description' => $description,
                             'observation' => $observation,
                             ));
    }
    public function getallUsersFromTeam($team, $id)
    {
        return $this->dataBase->from('all_users')
                                 ->where('department')->like($team)
                                 //->andWhere('user_id')->isNot($id)
                                 ->select()
                                 ->all();
    }

    public function createProject($name, $description, $observation, $time)
    {
        $this->dataBase->insert(array(
                             'status' => '0',
                             'percent' => '0',
                             'task_name' => $name,
                             'description' => $description,
                             'observation' => $observation,
                             'time' => $time,
                        ))
                        ->into('users_task_manager');
    }

    public function deleteProject($id, $delete)
    {

        if($delete)
        {
            $this->deleteFinalyProject($id);
            return 0;
        }

        $rez = $this->dataBase->from('users_task_manager')
                        ->where('id')->is($id)
                        ->select()
                        ->all();

        if($this->askForDelete($rez[0]))
        {
            return 1;
        }

        $this->deleteFinalyProject($id);

        return 0;
    }

    public function deleteFinalyProject($id)
    {
        $this->dataBase->from('users_task_manager')
             ->where('id')->is($id)
             ->delete();
    }

    public function askForDelete($task)
    {
        if($task->status != 0 || $task->percent != 0)
        {
            return 1;
        }

        return 0;
    }

    //---------------------------------Admin part

    public function getAllUsers($department, $functie, $acces_index)
    {
        
        if($department)
        {
            if($functie)
            {
                if($acces_index)
                {
                    return $this->dataBase->from('all_users')
                                      ->where('acces_index')->is($acces_index)
                                      ->andWhere('department')->is($department)
                                      ->andWhere('functie')->is($functie)
                                      ->select()
                                      ->all();    
                }

                return $this->dataBase->from('all_users')
                                  ->where('department')->is($department)
                                  ->andWhere('functie')->is($functie)
                                  ->select()
                                  ->all();    
            }
            elseif($acces_index)
            {
                return $this->dataBase->from('all_users')
                                  ->where('acces_index')->is($acces_index)
                                  ->andWhere('department')->is($department)
                                  ->select()
                                  ->all();
            }

            return $this->dataBase->from('all_users')
                              ->where('department')->is($department)
                              ->select()
                              ->all();    
        }

        if($functie)
        {
            if($acces_index)
            {
                return $this->dataBase->from('all_users')
                                  ->where('acces_index')->is($acces_index)
                                  ->andWhere('functie')->is($functie)
                                  ->select()
                                  ->all();    
            }

            return $this->dataBase->from('all_users')
                              ->where('functie')->is($functie)
                              ->select()
                              ->all();    
        }

        if($acces_index)
        {
            return $this->dataBase->from('all_users')
                              ->where('acces_index')->is($acces_index)
                              ->select()
                              ->all();    
        }

        return $this->dataBase->from('all_users')
                              ->select()
                              ->all();
    } 

    public function getDistinctSelector()
    {
        $rez['department'] = $this->getUnique($this->getRecords('department'), 'department');
        $rez['acces_index'] = $this->getUnique($this->getRecords('acces_index'), 'acces_index');
        $rez['functie'] = $this->getUnique($this->getRecords('functie'), 'functie');
        
        return $rez;
    }

    private function getRecords($key)
    {
        return $this->dataBase->from('all_users')
                              ->select($key)
                              ->all();
    }

    private function getUnique($records, $key)
    {

        foreach($records as $r)
        {
            $r = (array) $r;
            $rez[$r[$key]] = 1;
        }

        return $rez;
    }
}

// $conectInfo = array(
//           'host' => 'localhost',
//           'database' => 'firma_database',
//           'username' => 'root',
//           'password' => '',
//           );

// $m = new Model($conectInfo);
// $m->getTask(-1, 1);