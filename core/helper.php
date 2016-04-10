<?php

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
}
