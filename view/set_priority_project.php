<div class="table-responsive">
	<div id="delete_project_container"></div>
	<div id="create_project_container"></div>
	<table class="table table-striped">
		<tr>
			<td>
				<strong>Select project for edit</strong>
			</td>
		    <td scope="row">
		    	<select id="select_task_for_edit">
			    	<option>select...</option>
            		<?php
            			$controller->getAllTaskToWork(-2, $_SESSION['UserData']->department);
            		?>	
        		</select>
			</td>
			<td id="asignProject">
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalEdit" id="asignProject">Select Project</button>
			</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr>
			<td>
				<strong>All projects</strong>
			</td>
		    <td scope="row">
		    	<select id="select_task_for_delete_1">
			    	<option value"">select...</option>
            		<?php
            			$controller->getAllTaskToWork(-3);
            		?>	
        		</select>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Team projects</strong>
			</td>
			<td scope="row">
		    	<select id="select_task_for_delete_2">
			    	<option value"">select...</option>
            		<?php
            			$controller->getAllTaskToWork(-2, $_SESSION['UserData']->department);
            		?>	
        		</select>
			</td>
		</tr>
		<tr>
			<td id="asignProject">
				<button type="button" class="btn btn-danger" id="deleteProject">Delete Project</button>
			</td>
		</tr>
		<tr>
			<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalCreate" id="asignProject11">Create Project</button></td>
		</tr>
	</table>
	<?php
	echo '
	<div class="create_project">';
        include('create_new_project.php');
	echo '</div>';
	?>
	<!-- Modal content-->
	<div id="load_container_edit">
	</div>
</div>