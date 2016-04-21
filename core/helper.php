<?php

include('timeDif.php');

use TimeDifference as T;

class Helper{

	public static function orderItems($items)
	{
		$rez = array();
		foreach($items as $itm)
		{
			if(!isset($rez[$itm->type]))
			{
				$rez[$itm->type] = array();	
			}

			$rez[$itm->type][] = $itm;
		}

		return $rez;
	}
	public static function printDescription($item)
	{
		$item = explode('\n', $item);
		$text = '<div class="dropdown-menu">';
		foreach($item as $i){
			$text .= '<p>'. $i.'</p>';
		}
		$text .= '</div>';
		echo $text;	
	}
	public static function nextItem($item, $key, $ask = 0)
	{
		if(isset($item[$key]))
		{
			$val = $item[$key]->type;
			$src = $val . '.png';
			if($val == 'unit')
			{
				$val = 'unitate';
				$src = $val . '.jpg';
			}
			echo '<div class="col-sm-3">
			<img id="', $item[$key]->register_nr,'" class="monitor', $ask ? '_new_item' : '','" src="img/', $src,'">';
			self::printDescription($item[$key]->description); 
			echo '</div>';
		}
		else
		{
			echo '<div class="col-sm-3 empty"></div>';
		}
	}

	public static function message($msg, $type)
	{
		echo '
		    <div class="alert alert-'. $type.'">

		        <a href="#" class="close" data-dismiss="alert">&times;</a>

		        <strong>HEI !</strong> '. $msg.'!.

		    </div>';
	}


	public static function getItem($item, $id, $type, $model)
	{
		if(isset($item))
		{
			if($item)
			{
				if(!$model->getNewItem($item, $id))
				{
					self::message('Ai cerut deja un '. $type.' asteapta pentru procesare!!', 'danger');
				}
				else
				{
					self::message('Cerere inregistrata', 'success');
				}
			}
		}
	}

	public static function normalizeItemType($items)
	{
		$rez = array();
		foreach($items as $item)
		{
			$rez[$item->index] = $item->name;
		}

		return $rez;
	}

	public static function getDate($format)
	{
		$tz = 'Europe/Bucharest';
		$timestamp = time();
		$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
		$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
		return $dt->format($format);
	}

	public static function normalizeStatisticData($data, $users)
	{

		$rez = array();
		foreach($data as $d){
			if(!isset($rez[$d->name]))
			{
				$rez[$d->name] = array();
			}
			$rez[$d->name][] = $d;
		}

		foreach($users as $u)
		{
			if(!isset($rez[$u->name]))
			{
				$rez[$u->name] = array();
			}
		}

		return $rez;
	}

	public static function getClassForStatus($status)
	{
		if($status == 1){
			return 'started';
		}
		if($status == 2){
			return 'finished';
		}
		if($status == 3){
			return 'error';
		}
		return 'not_processed';
	}

	public static function printStatisticsTaskInfo($t)
	{
		$text  = '<div class="dropdown-menu">';
		$text .= '<table class="table">';
		$text .= '<tr><th><strong>Utilizator: </strong></th><td>'. $t->task_name.'</td></tr>';
		$text .= '<tr><th><strong>Nume proiect: </strong></th><td>'. $t->task_name.'</td></tr>';
		$text .= '<tr><th><strong>Status: </strong></td><th>'. self::getClassForStatus($t->status).'</td></tr>';
		$text .= '<tr><th><strong>Procent: </strong></td><th>'. $t->percent.'</td></tr>';
		$text .= '<tr><th><strong>Timp estimat: </strong></th><td>'. $t->time.'</td></tr>';
		$text .= '<tr><th><strong>Descriere: </strong></th><td><textarea rows="4" cols="16">'. $t->description.'</textarea></td></tr>';
		$text .= '</table></div>';
		echo $text;
	}

	public static function printHours($t, $all, $key1)
	{
		$t_dif = '0d 0h';
		if($t->end_time)
		{
			$time = new T();
			$dif = $time->calculDifTime($t->end_time, $t->start_time);			
			$t_dif = self::timeCalcul($t->time, $dif[2]. 'd '. $dif[3]. 'h');
			foreach($all as $key => $val)
			{
				if($key !== $key1 && $val->task_time_id === $t->task_time_id)
				{
					$dif = $time->calculDifTime($val->end_time, $val->start_time);			
					$t_dif = self::timeCalcul($t->dif, $dif[2]. 'd '. $dif[3]. 'h');
				}
			}
			print_r($t_dif);
		}
		else
		{
			echo 'P';
		}
		return $t_dif; 
	}

	public static function printTotalHours($t)
	{
		$total = '0d 0h';
		if(!empty($t))
			foreach($t as $val)
			{
				$total = self::timeCalculTotal($val, $total);
			}
		return $total;
	}

	public static function timeCalcul($estim, $work)
	{
		$estim = str_replace(array('h', 'd'), '', explode(' ', $estim));
		$work = str_replace(array('h', 'd'), '', explode(' ', $work));	

		$dif[0] = $estim[0] - $work[0];
		$dif[1] = $estim[1] - $work[1];
		if($dif[1] < 0 && $dif[0] > 0)
		{
			$dif[1] += 24;
			$dif[0]--;
		}
		return $dif[0].'d '. $dif[1].'h'; 
	}

	public static function timeCalculTotal($estim, $work)
	{
		$estim = str_replace(array('h', 'd'), '', explode(' ', $estim));
		$work = str_replace(array('h', 'd'), '', explode(' ', $work));	

		$dif[0] = $estim[0] + $work[0];
		$dif[1] = $estim[1] + $work[1];
		if($dif[1] < 0 && $dif[0] > 0)
		{
			$dif[1] += 24;
			$dif[0]--;
		}
		return $dif[0].'d '. $dif[1].'h'; 
	}
	public static function printStatisticsTableHeader()
	{
		echo '<tr id="table_header">';
		for($i = 0; $i < 32; $i++){
			echo '<td>';
			if($i == 0){
				echo '<strong> Name</strong>';
			}
			elseif($i == 31)
			{
				echo '<strong>Randament</strong>';
			}
			else
			{
				echo '<strong>', $i , '</strong>';
			}

			echo '</td>';
		}
	}
}

// [user_id] => 1
//             [username] => bela.barabas
//             [password] => 12345
//             [name] => Barabas Bela
//             [department] => crawler
//             [acces_index] => 3
//             [functie] => programator
//             [id] => 3
//             [task_name] => licenta
//             [description] => 
//             [status] => 2
//             [percent] => 30
//             [observation] => Prioryti finished
//             [time] => 14d
//             [priority] => 1
//             [task_id] => 2
//             [start_time] => 10.04.2016 16:12:38
//             [end_time] => 10.04.2016 16:13:09