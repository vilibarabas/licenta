<?php

if(!empty($task))
{
	echo '<tr>
		<td>
			Titlu Task:
		</td>
		<td>', 
			 $task->task_name;
	echo '<input hidden = "hidden" id="task_id" name="task_id" value="'. $task->id.'"><input hidden = "hidden" name="user" value="'. $task->user_id.'">
		</td>
		<td></td>
</tr>
<tr>
	<td>
		Stadiu: 
	</td>
	<td>',  $controller->model->getStatus($task->status), '
	</td>
	<td>
		<select name="select_status">
	    	<option>select...</option>
    		', $controller->getSelectStatus($task->status), '
		</select>		
	</td>
</tr>
<tr>
	<td>
		Stadiu de procesare: 
	</td>
	<td>
		<div class="progress"> <div class="progress-bar progress-bar-striped active" role="progressbar"
		  aria-valuenow="', $task->percent,'" aria-valuemin="0" aria-valuemax="100" style="width:40%">',  $task->percent, '%
		  	</div>
		</div>
	</td>
	<td>
		<select name="select_percent">';
				for($i = 0; $i <= 100; $i+=10)
				{

					echo 
						'<option value="', $i,'" ', ($task->percent == $i)? 'selected' : '','>',
							$i, ' %'
						,'</option>';
				}
		echo 	'
		</select>
	</td>
</tr>
<tr>
	<td>
		Description:
	</td>
	<td>
		<textarea rows="4" cols="50" name="description">'. $task->description.'</textarea>
	</td>
	<td></td>
</tr>
<tr>
	<td>
		Observation:
	</td>
	<td>
		 <textarea rows="4" cols="50"  name="observation">'. $task->observation.'</textarea>
	</td>
	<td></td>
</tr>
<tr>
	<td>
		<input id="save_project_update" type="submit" class="btn btn-success" value="Save" name="save_project_update"/>
	</td>
</tr>
<br>
<tr>
	<!-- <div>
		<div id="chartContainer" style="height: 300px; width: 100%;"></div>
	</div> -->
</tr>';
}
else
{
echo '<tr>
	<div>
		<h3>Nu exista nici untask rezolvat</h3>
	</div>
</tr>';
}