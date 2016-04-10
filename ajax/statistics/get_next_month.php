<?php
include('../../model/model.php');
include('../../core/helper.php');

$mounth = array(
    'January' => 1,
    'February' => 2,
    'March' => 3,
    'April' => 4,
    'May' => 5,
    'June' => 6,
    'July' => 7,
    'August' => 8,
    'September' => 9,
    'October' => 10,
    'November'  => 11,
    'December' => 12,
  );
$conectInfo = array(
           'host' => 'localhost',
           'database' => 'firma_database',
           'username' => 'root',
           'password' => '',
           );

$model = new Model($conectInfo);
$all_task = Helper::normalizeStatisticData($model->getAllTaskForStatistics($_POST['year'], $mounth[$_POST['mounth']], $_POST['department']));
echo '<hr><table class="table table-bordered">';


foreach($all_task as $key => $t)
{
	echo '<tr><th>'.str_replace(' ', '_', $key).'</th>';
		
	for($i = 0; $i < 30; $i++)
	{
		if(isset($t[$i]))
		{

			echo '<td class="'. Helper::getClassForStatus($t[$i]->status).'">';
				
			Helper::printStatisticsTaskInfo($t[$i]);
			echo '</td>';
		}
		else
		{
			echo '<td class="empty_td"></td>';
		}
	}
	echo '</tr>';
}

echo '</table>';
// Array
// (
//     [0] => stdClass Object
//         (
//             [user_id] => 1
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
//         )

//     [1] => stdClass Object
//         (
//             [user_id] => 3
//             [username] => norbik
//             [password] => 12345
//             [name] => Kaloczki Norbert
//             [department] => crawler
//             [acces_index] => 2
//             [functie] => programator
//             [id] => 4
//             [task_name] => dwq
//             [description] => ewq
//             [status] => 1
//             [percent] => 0
//             [observation] => gs
//             [time] => 4
//             [priority] => 
//             [task_id] => 18
//             [start_time] => 10.04.2016 16:19:37
//             [end_time] => 
//         )

// )
