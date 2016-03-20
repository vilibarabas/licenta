<!DOCTYPE html>
<html>
	<head>
	<title>Licenta</title>
	<?php
			include "controller/controller.php";
		    $controller = new Controller('profil');
	?>
        
	</head>

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
						  		echo '<li><a href="#tab_d" data-toggle="tab">Set Priority</a></li>';
						  	}
						  ?>
				        </ul>
				    </div>
			    </div>
			    <div class="col-md-8">
			        <div class="tab-content">
			            <div class="tab-pane" id="tab_a">
			            	<div class="table-responsive">
			            		<?php
			            			include('view/user_profile.php');
			            			$task = $controller->model->getTask(-2, $_SESSION['UserData']->user_id);
			            		?>
			            	</div>	
			            </div>
			            <?php //echo '<div class="tab-pane',  isset($_SESSION["select_task"]) ? 'actice' : '', '" id="tab_b">';?>
				        <div class="tab-pane active" id="tab_b">
				            <form action="profil.php" method="POST">
				            	<div class="table-responsive">
					            	<table class="table table-striped">
										<tr>
											<th>
												<p>Select Task</p>
											</th>
										    <td scope="row">
										    	<?php echo '<select id="select_task" name="select_task" ', $task->priority ? 'disabled': '','>'; ?>
											    	<option>select...</option>
								            		<?php
								            			$controller->getAllTaskToWork($_SESSION['UserData']->user_id);

								            		?>
							            		</select>
											</td>
											<td>
												<input  id="view_task" type="submit" class="btn btn-info" value="Select Project"/>
											</td>

										</tr>
										
										<?php
											if(isset($_POST['select_task']))
											{
												$id = $_POST['select_task'];
												$_SESSION['task_id'] = $id;
											}
											elseif(isset($_SESSION['task_id']))
											{
												$id = $_SESSION['select_task'];
											}
											
											if(isset($id))	
												if(strpos($id, '...') !== FALSE)
												{
													if(isset($_POST['task_id']))
													{
														$id = $_POST['task_id'];
														$_SESSION['task_id'] = $id;
													}
												}

											if(!isset($id) || $id == '')
											 $id = -1;
											
											if(empty($task))
												$task = $controller->model->getTask($id, $_SESSION['UserData']->user_id);
											
										if(isset($task->priority))
										{
											echo '<tr>
														<td>
															<div class="alert alert-danger">This is the priority Task</div>
														</td>
													</tr>';
										}

										?>

										<tr>
											<td>
												<h4>Task Information</h1>
											</td>
										</tr>

										<?php
											include('view/print_task.php');									
										?>
									</table>
				            	</div>
				        	</form>
				        </div>
			        
				        <div class="tab-pane" id="tab_c">
			            	<?php
			            		include('view/profile_asign_project.php');
			            	?>
						</div>
						<div class="tab-pane" id="tab_d">
			            	<?php
			            		include('view/set_priority_project.php');
			            	?>
						</div>
					</div>
			    </div>
		    </div>
	    </div>
	</body>
</html>