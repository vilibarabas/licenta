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
    
    public function addContorData($date, $id, $startStop)
    {
        $result = $this->dataBase->insert(array(
                                 'user_id' => $id,
                                 'StartOrEnd' => $startStop,
                                 'time' => $date
                                 ))
                                 ->into('time_manager_all_users');   
    }
    
    public function verifyContor($date, $id)
    {
        $result = $this->dataBase->from('time_manager_all_users')
                                 ->where('user_id')->is($id)
                                 //->andWhere('StartOrEnd')->is('start')
                                 ->andWhere('time')->like("%". $date."%")
                                 ->select()
                                 ->all();
        if(!empty($result))
            if($result[count($result)-1]->StartOrEnd === 'start')
            {
                return explode(' ', $result[count($result)-1]->time)[1];
            }
        
        return '';
    }
    
    public function stopContor($user_id, $username)
    {
        $date = date("Y-m-d H:i:s");
        print_r($date);    
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