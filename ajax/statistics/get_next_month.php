<?php
include('../../model/model.php');
include('../../core/helper.php');

$mounth = array(
    'January' => '01',
    'February' => '02',
    'March' => '03',
    'April' => '04',
    'May' => '05',
    'June' => '06',
    'July' => '07',
    'August' => '08',
    'September' => '09',
    'October' => '10',
    'November'  => '11',
    'December' => '12',
  );
$conectInfo = array(
           'host' => 'localhost',
           'database' => 'firma_database',
           'username' => 'root',
           'password' => '',
           );

$model = new Model($conectInfo);
$all_users = $model->getallUsersFromTeam($_POST['department']);

$all_task = Helper::normalizeStatisticData($model->getAllTaskForStatistics($_POST['year'], $mounth[$_POST['mounth']], $_POST['department']), $all_users);


echo '<hr><table class="table table-bordered">';

Helper::printStatisticsTableHeader();

foreach($all_task as $key => $t)
{
  $time_dif[$key] = array();
	echo '<tr><th class="empty_td">'.$key.'</th>';
		
	for($i = 0; $i < 30; $i++)
	{
		if(isset($t[$i]))
		{

			echo '<td class="'. Helper::getClassForStatus($t[$i]->status).'">';
        $time_dif[$key][$t[$i]->task_id] = Helper::printHours($t[$i], $t, $i);
				
        Helper::printStatisticsTaskInfo($t[$i]);
        
			echo '</td>';
		}
		else
		{
			echo '<td class="empty_td"></td>';
		}
	}
  $time_dif[$key]['total'] = Helper::printTotalHours($time_dif[$key]);
  echo '<td class="empty_td">'. $time_dif[$key]['total'].'</td>';
	echo '</tr>';
}

echo '</table>';
