<!DOCTYPE html>
<html>
	 <?php
	    include "controller/controller.php";
	    $controller = new Controller('profil');
	  ?>
	<body>
		<?php
	    	$controller->getMeniu('profil');
	    ?>

	    <div class="container">
	    	<div class="row">
	    		
	 			<div class="col-md-2">
	 				<div class="row">	
				        <ul class="nav">
				          <li class="active"><a href="#tab_a" data-toggle="tab">Profil</a></li>
						  <li><a href="#tab_b" data-toggle="tab">Work manager</a></li>
						  <?php
						  	if($_SESSION['UserData']->acces_index == 2)
						  	{
						  		echo '<li><a href="#tab_c" data-toggle="tab">Assign Project</a></li>';
						  	}
						  ?>
				        </ul>
				    </div>
			    </div>
			    <div class="col-md-8">
			        <div class="tab-content">
			            <div class="tab-pane active" id="tab_a">
			            	<div class="table-responsive">
			            		<table class="table table-striped">
								    <tr>
								      <th scope="row"><img id="profile_img" src="img/profile_img.jpg"></th>
								    </tr>
								    <tr>
								      <th scope="row">Name: </th>
								      <td><?php echo $_SESSION['UserData']->name; ?></td>
								    </tr>
								    <tr>
								      <th scope="row">Departament: </th>
								      <td><?php echo $_SESSION['UserData']->department; ?></td>
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
							            			$controller->getAllTaskToWork($_SESSION['UserData']->user_id);

							            		?>
						            		</select>
										</td>
										<td>
											<button id="view_task" type="button" class="btn btn-info">View</button>
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

									<?php

										if(!empty($task))
										{
											echo '<tr>
												<td>
													Titlu Task:
												</td>
												<td>', 
													 $task->task_name,'<input hidden = "hidden" id="precent" value="',  $task->percent, '">';
											echo '<input hidden = "hidden" id="task_id" value="'. $task->id.'"><input hidden = "hidden" id="user" value="'. $task->user_id.'">
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
												<select id="select_status">
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
												<select id="select_percent">';
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
												<textarea rows="4" cols="50" id="description">'. $task->description.'</textarea>
											</td>
											<td></td>
										</tr>
										<tr>
											<td>
												Observation:
											</td>
											<td>
												 <textarea rows="4" cols="50"  id="observation">'. $task->observation.'</textarea>
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
									else
									{
										echo '<tr>
											<div>
												<h3>Nu exista nici untask rezolvat</h3>
											</div>
										</tr>';
									}
									?>
								</table>
			            	</div>
			            </div>
			        
				        <div class="tab-pane" id="tab_c">
			            	<div class="table-responsive">
				            	<table class="table table-striped">
									<tr>
										<th>
											<p>Select project</p>
										</th>
									    <td scope="row">
									    	<select id="select_task_for_asign">
										    	<option>select...</option>
							            		<?php
							            			$controller->getAllTaskToWork(-1);
							            		?>	
						            		</select>
										</td>
										<td id="asignProject">
											<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" id="asignProject">Open Modal</button>
										</td>
									</tr>
								</table>
								<!-- Modal content-->
								<div id="load_container">
									
								</div>
								<?php
									
									
										//include('view/project_asign.php');
									
				      				
				      			?>
							</div>
						</div>
					</div>
			    </div>
		    </div>
	    </div>
	</body>
</html>