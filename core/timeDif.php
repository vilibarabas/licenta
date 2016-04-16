<?php

class TimeDifference{
    
    public function calculDifTime($finish, $start = 0, $data_separator = '.', $hours_separator = ':'){
        if(!$start){
        	date_default_timezone_set('Europe/Bucharest');
        	$start = date('d.m.Y H:i:s');
        }

        $start = $this->getTimeArray($start, $data_separator, $hours_separator);
        $finish = $this->getTimeArray($finish, $data_separator, $hours_separator);
        $dif = $this->addZeroes($this->obtimizeDif($this->calculDiff($start, $finish)));
        return $dif;
    }
    
    function getTimeArray($data, $data_separator, $hours_separator)
    {
        $array = array();
        list($start_data, $start_time) = explode(' ', $data);
        $array = explode($data_separator, $start_data);
        $start_time = explode($hours_separator, $start_time);
        $aux = $array[0];
        $array[0] = $array[2];
        $array[2] = $aux;
        $array[3] = $start_time[0];
        $array[4] = $start_time[1];
        $array[5] = $start_time[2];
        return $array;
    }
    
    function calculDiff($start, $finish)
    {
        foreach($finish as $key => $f){
            $dif[$key] = $f - $start[$key];
        }
        
        return $dif;
        
    }
    
    function obtimizeDif($dif)
    {
        for($i = 5; $i > 3; $i--)
        {
            if($dif[$i] < 0)
            {
                $this->getOther($dif, $i, 60);
            }
            elseif($dif[$i] > 59)
            {
                $this->addOther($dif, $i, 60);
            }
        }
        
        if($dif[3] < 0)
        {
            $this->getOther($dif, 3, 24);
        }
        elseif($dif[$i] > 24)
        {
            $this->addOther($dif, 3 , 24);
        }
        
        return $dif;
    }
    
    function getOther(&$array, $key, $how)
    {
        $array[$key-1]--;
        $array[$key] += $how;
    }
    
    function addOther($array, $key)
    {
        $array[$key-1]++;
        $array[$key] -= $how;
    }
    
    function addZeroes($dif)
    {
        for($i = 5; $i > 2; $i--){
            if($dif[$i] < 10){
                $dif[$i] = '0'. $dif[$i];
            }
        }
        return $dif;
    }

    function getFormat($array)
    {
    	$time = '';
    	for($i = 0; $i < 6; $i++)
    	{
    		$time .= $array[$i]. '.';
    	}

    	return $time;
    }
}