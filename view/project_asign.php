<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title">Modal Header</h4>
	    </div>
	    <div class="modal-body">
	      <?php

			if(!empty($task_asign))
			{
				echo '<tr>
					<td>
						Titlu Task:
					</td>
					<td>', 
						 $task_asign->task_name,'<input hidden = "hidden" id="precent" value="',  $task_asign->percent, '">';
				echo '<input hidden = "hidden" id="task_id" value="'. $task_asign->id.'">
					</td>
					<td></td>
			</tr>
			<tr>
				<td>
					Stadiu: 
				</td>
				<td>',  $controller->model->getStatus($task_asign->status), '
				</td>
				<td>
					<select id="select_status">
				    	<option>select...</option>
	            		', $controller->getSelectStatus($task_asign->status), '
            		</select>		
				</td>
			</tr>
			<tr>
				<td>
					Stadiu de procesare: 
				</td>
				<td>
					<div class="progress"> <div class="progress-bar progress-bar-striped active" role="progressbar"
					  aria-valuenow="', $task_asign->percent,'" aria-valuemin="0" aria-valuemax="100" style="width:40%">',  $task->percent, '%
					  	</div>
					</div>
				</td>
				<td>
					<select id="select_percent">';
							for($i = 0; $i <= 100; $i+=10)
							{

								echo 
									'<option value="', $i,'" ', ($task_asign->percent == $i)? 'selected' : '','>',
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
					<textarea rows="4" cols="50" id="description">'. $task_asign->description.'</textarea>
				</td>
				<td></td>
			</tr>
			<tr>
				<td>
					Observation:
				</td>
				<td>
					 <textarea rows="4" cols="50"  id="observation">'. $task_asign->observation.'</textarea>
				</td>
				<td></td>
			</tr>
			<tr>
				<td>
					<button id="set_status" type="submit" class="btn btn-success">Save</button>
				</td>
			</tr>
			<br>
			<tr>
				<!-- <div>
					<div id="chartContainer" style="height: 300px; width: 100%;"></div>
				</div> -->
			</tr>';
				}
			?>
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	  
	</div>
</div>
