<!DOCTYPE html>
<head>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="canvasjs/canvasjs.min.js"></script>
<script src="js/ajax.js"></script>
<script src="js/precent.js"></script>
 <?php
    include "controller/controller.php";
    $controller = new Controller();
  ?>

</head>

<body>
	<?php
    	$controller->getMeniu('profil');
    ?>

    <div class="container">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_a" data-toggle="tab">Profil</a></li>
          <li><a href="#tab_b" data-toggle="tab">Work manager</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_a">
            	<div class="table-responsive">
            		<table class="table table-striped">
					    <tr>
					      <th scope="row"><img id="profile_img" src="img/profile_img.jpg"></th>
					    </tr>
					    <tr>
					      <th scope="row">Name: </th>
					      <td><?php echo $_SESSION['UserData']->name; ?></std>
					    </tr>
					    <tr>
					      <th scope="row">Departament: </th>
					      <td><?php echo $_SESSION['UserData']->department; ?></std>
					    </tr>
					    <tr>
					      <th scope="row">Functie: </th>
					       <td><?php echo $_SESSION['UserData']->functie; ?></td> 
					    </tr>
					</table>
            	</div>	
            </div>
            <div class="tab-pane" id="tab_b">
            	<div class="table-responsive">
	            	<table class="table table-striped">
						<tr>
							<th>
								<p>Select Task</p>
							</th>
						    <td scope="row">
						    	<select id="select_task">
							    	<option>select...</option>
				            		<?php
				            			$controller->getSelectTask($_SESSION['UserData']->user_id);

				            		?>
			            		</select>
							</td>
							<td>
								<button id="view_task" type="submit" onclick="clickView()" class="btn btn-info">View</button>
							</td>

						</tr>
						
						<?php
							if(isset($_POST['task_id']))
							{
								$id = $_POST['task_id'];
							}
							else
							{
								$id = -1;
							}

							$task = $controller->model->getTask($id, $_SESSION['UserData']->user_id);
							//print_r($task);
						?>
						<tr>
							<td>
								<h1>Task Information</h1>
							</td>
						</tr>
						<tr>
							<td>
								Titlu Task:
							</td>
							<td>
								<?php echo $task->task_name;
										echo '<input hidden = "hidden" id="precent" value="'. $task->percent.'">';
										echo '<input hidden = "hidden" id="task_id" value="'. $task->id.'">';
								?>
							</td>
							<td></td>
						</tr>
						<tr>
							<td>
								Stadiu: 
							</td>
							<td>
								<?php
									echo $controller->model->getStatus($task->status);
								?>
							</td>
							<td>
								<select id="select_status">
							    	<option>select...</option>
				            		<?php
				            			$controller->getSelectStatus($task->status);
				            		?>
			            		</select>		
							</td>
						</td>
						<tr>
							<td>
								Stadiu de procesare: 
							</td>
							<td>
								<div class="progress">
								  	<?php echo '<div class="progress-bar progress-bar-striped active" role="progressbar"
								  aria-valuenow="', $task->percent,'" aria-valuemin="0" aria-valuemax="100" style="width:40%">'; 
								     echo $task->percent, '%
								  	</div>';
								  	?>
								</div>
							</td>
							<td>
								<select id="select_percent">
									<?php
										for($i = 0; $i <= 100; $i+=10)
										{

											echo 
												'<option value="', $i,'" ', ($task->percent == $i)? 'selected' : '','>',
													$i, ' %'
												,'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Description:
							</td>
							<td>
								<?php 
										echo '<textarea rows="4" cols="50" id="description">'. $task->description.'</textarea>';
								?>
							</td>
							<td></td>
						</tr>
						<tr>
							<td>
								Observation:
							</td>
							<td>
								<?php 
										echo '<textarea rows="4" cols="50"  id="observation">'. $task->observation.'</textarea>';
								?>
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
						</tr>
					</table>
            	</div>
            </div>
        </div>
    </div>
</body>
