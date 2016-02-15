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
    
    public function addTime($table, $date, $why)
    {

        $this->createContorTable($table);
        if($why)
        {
            $this->dataBase->insert(array(
                                 'start_time' => $date,
                                 'end_time' => ''
                                 ))
                                 ->into($table);  
        }
        else
        {
            $d = date("d-m-Y");
            $this->dataBase->update($table)
                        ->where('end_time')->is('')
                        ->andWhere('start_time')->like("%". $d."%")
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
    
    public function verifyContor($table)
    {
        $this->autoUpdateEndTime($table);
        $date = date("d-m-Y");
        return $result1 = $this->dataBase->from($table)
                                 ->where('end_time')->is('')
                                 ->andWhere('start_time')->like("%". $date."%")
                                 ->select()
                                 ->all();
    }

    private function autoUpdateEndTime($table)
    {
        $d = date("d-m-Y");
        $result1 = $this->dataBase->from($table)
                                 ->where('end_time')->is('')
                                 ->andWhere('start_time')->notLike($d."%")
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
            $this->dataBase->update($table)
                        ->where('end_time')->is('')
                        ->andWhere('start_time')->notLike($d."%")
                        ->set(array(
                                 'end_time' => $end_time
                                 ));
        }
    }
    public function getWorking($table)
    {
        return $result = $this->dataBase->from($table)
                                 ->where('end_time')->isNot('')
                                 ->andWhere('start_time')->like('%'. date("d-m-Y").'%')
                                 ->select()
                                 ->all();
    }

    public function getAllWorking($table)
    {
        return $result = $this->dataBase->from($table)
                                 ->andWhere('start_time')->like('%'. date("-m-Y").'%')
                                 ->select()
                                 ->all();   
    }

    public function getTaskFromUser($id)
    {
        return $this->dataBase->from('users_task_manager')
                                 ->where('user_id')->is($id)
                                 ->select()
                                 ->all();   
    }
    public function getTask($id, $user_id)
    {
        if($id != -1)
        {
            $rez = $this->dataBase->from('users_task_manager')
                                 ->where('id')->is($id)
                                 ->select()
                                 ->all();
            return $rez[0];
        }   
        else
        {
            $rez = $this->dataBase->from('users_task_manager')
                                 ->where('user_id')->is($user_id)
                                 ->select()
                                 ->all();

            return $rez[count($rez)-1];
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

    public function saveTaskChange($status, $id, $percent, $description, $observation)
    {
        $this->dataBase->update('users_task_manager')
                    ->where('id')->is($id)
                    ->set(array(
                             'status' => $status,
                             'percent' => $percent,
                             'description' => $description,
                             'observation' => $observation
                             ));
    }
}
//
//$conectInfo = array(
//           'host' => 'localhost',
//           'database' => 'firma_database',
//           'username' => 'root',
//           'password' => '',
//           );
//
//$m = new Model($conectInfo);
//
//print_r($m->getData('all_users'));