<?php

require_once '../model/model.php';
require_once '../controller/controller.php';

$conectInfo = array(
           'host' => 'localhost',
           'database' => 'firma_database',
           'username' => 'root',
           'password' => '',
           );

$m = new model($conectInfo);
$controller = new Controller('profil');
$task_asign = $m->getTask(-1, 1, $_POST['taskId']);

echo '
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

	  <!-- Modal content-->
		  <div class="modal-content">
		    <div class="modal-header">
		      <button type="button" class="close" data-dismiss="modal">&times;</button>
		      <h4 class="modal-title">Modal Header</h4>
		    </div>
		    <div class="modal-body">
				<div class="row">
		 			<div class="col-md-3">
						<span>Titlu Task:</span>
					</div>
					<div class="col-md-5">
						<span>', $task_asign->task_name,'</span><input hidden = "hidden" id="precent" value="',  $task_asign->percent, '">';
											echo '<input hidden = "hidden" id="asign_task_id" value="'. $task_asign->id.'">
					</div>
				</div>
				<div class="row">
		 			<div class="col-md-3">
						<span>Stadiu:</span>
					</div>
					<div class="col-md-5">
						<span>',  $controller->model->getStatus($task_asign->status), '</span>
					</div>
					<div class="col-md-4">
						<select id="asign_select_status">
					    	<option>select...</option>
		            		', $controller->getSelectStatus($task_asign->status), '
	            		</select>
	            	</div>
	            </div>
	            <div class="row">
		 			<div class="col-md-3">
						<span>Stadiu de procesare:</span>
					</div>
					<div class="col-md-5">
						<div class="progress"> <div class="progress-bar progress-bar-striped active" role="progressbar"
												  aria-valuenow="', $task_asign->percent,'" aria-valuemin="0" aria-valuemax="100" style="width:40%">',  $task->percent, '%
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<select id="asign_select_percent">';
							for($i = 0; $i <= 100; $i+=10)
							{

								echo 
									'<option value="', $i,'" ', ($task_asign->percent == $i)? 'selected' : '','>',
										$i, ' %'
									,'</option>';
							}
					echo 	'
						</select>
					</div>
				</div>
				<div class="row">
		 			<div class="col-md-3">
		 				<span>Description:</span>
					</div>
					<div class="col-md-5">
						<textarea rows="4" cols="50" id="asign_description">'. $task_asign->description.'</textarea>
					</div>
				</div>
				<div class="row">
		 			<div class="col-md-3">
		 				<span>Observation:</span>
					</div>
					<div class="col-md-5">
						<textarea rows="4" cols="50"  id="asign_observation">'. $task_asign->observation.'</textarea>
					</div>
				</div>
				<div class="row">
		 			<div class="col-md-3">
						<span>Select User:</span>
					</div>
					<div class="col-md-4">
						<select id="asign_select_user">
					    	<option>select...</option>
		            		', $controller->getSelectUsers($_SESSION['UserData']->department, $_SESSION['UserData']->user_id), '
	            		</select>
	            	</div>
	            	<div class="col-md-5">
						<button id="asign_project" type="button" class="btn btn-success" data-dismiss="modal">Asign</button>
					</div>
	            </div>

			</div>
	  </div>
</div>';
											