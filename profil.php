<!DOCTYPE html>
<html>
	<head>
	<title>Licenta</title>
	<?php
			include "controller/controller.php";
			include "core/helper.php";
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
				           <?php 
				          	
					          	echo '<li ',  isset($_GET["profil"]) ? ' class="active"' : '', '><a href="#tab_a" data-toggle="tab">Profil</a></li>'; 
					        
						  		echo '<li ',  isset($_GET["profil"]) ? '' : ' class="active"', '><a href="#tab_b" data-toggle="tab"> Work manager</a></li>';
						  		echo '<li><a href="#tab_e" data-toggle="tab"> Items</a></li>';
						  
						  	if($_SESSION['UserData']->acces_index == 2)
						  	{
						  		echo '<li><a href="#tab_f" data-toggle="tab">Ask Item</a></li>';	 
						  		echo '<li><a href="#tab_c" data-toggle="tab">Assign Project</a></li>';
						  		echo '<li><a href="#tab_d" data-toggle="tab">Edit Project</a></li>';	 
						  	}
						  ?>
				        </ul>
				    </div>
			    </div>
			    <div class="col-md-9">
			        <div class="tab-content">
			        <?php echo '<div class="tab-pane',  isset($_GET["profil"]) ? ' active' : '', '" id="tab_a">';?>
			            <!-- <div class="tab-pane active" id="tab_a"> -->
			            	<div class="table-responsive">
			            		<?php
			            			
		            				$user_data = $controller->model->getUserData($_GET['id']);
									
			            			include('view/user_profile.php');
			            			$task = $controller->model->getTask(-2, $_SESSION['UserData']->user_id);
			            		?>
			            	</div>	
			            </div>
			            <?php echo '<div class="tab-pane',  isset($_GET["profil"]) ? '' : ' active', '" id="tab_b">';?>
				         <!-- <div class="tab-pane" id="tab_b"> --> 
				        	
				            <?php echo '<form method="POST" action="profil.php?id=', $_SESSION['UserData']->user_id.'&work">'; ?>
				            	<div class="table-responsive">
					            	<table class="table table-striped">
										<tr>
											<th>
												<p>Select Task</p>
											</th>
										    <td scope="row">
										    	<?php echo '<select id="select_task" name="select_task" ', (!empty($task) && $task->priority) ? 'disabled': '','>'; ?>
											    	<option>select...</option>
								            		<?php
								            			$controller->getAllTaskToWork($_SESSION['UserData']->user_id, $_SESSION['UserData']->department);

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
												$id = $_SESSION['task_id'];
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
											{
												$task = $controller->model->getTask($id, $_SESSION['UserData']->user_id);
												
											}
											
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
												<h4>Task Information</h4>
											</td>
											<td></td>
											<td></td>
										</tr>

										<?php
											include('view/print_task.php');									
										?>
									</table>
				            	</div>
				        	</form>
				        </div>
			        	<?php
						  	if($_SESSION['UserData']->acces_index == 2)
						  	{
						        echo '<div class="tab-pane" id="tab_c">';
					            	
					            include('view/profile_asign_project.php');	
								echo '</div>
								<div class="tab-pane" id="tab_d">';
					            	
					            include('view/set_priority_project.php');
					            echo '</div>';
					            echo '<div class="tab-pane" id="tab_f">';
							
								
								include('view/ask_item_view.php');
								
								echo '</div>';
							}
							echo '<div class="tab-pane" id="tab_e">';
							
							$items = $controller->model->getUserItems($_SESSION['UserData']->user_id, 1);
							$items = helper::orderItems($items);
							
							$items_asked = $controller->model->getUserItems($_SESSION['UserData']->user_id, 0);
							$items_asked = helper::orderItems($items_asked);
							include('view/item_view.php');
							
							echo '</div>';
						?>
					
	</body>
</html>