<div class="table-responsive">
	<div id="delete_project_container"></div>
	<table class="table table-striped">
		<tr>
			<th>
				<p>Select project for edit</p>
			</th>
		    <td scope="row">
		    	<select id="select_task_for_edit">
			    	<option>select...</option>
            		<?php
            			$controller->getAllTaskToWork(-2, $_SESSION['UserData']->department);
            		?>	
        		</select>
			</td>
			<td id="asignProject">
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" id="asignProject">Select Project</button>
			</td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr>
			<th>
				<p>Select from all project for Delete</p>
			</th>
		    <td scope="row">
		    	<select id="select_task_for_delete_1">
			    	<option value"">select...</option>
            		<?php
            			$controller->getAllTaskToWork(-3);
            		?>	
        		</select>
			</td>
			<td>
				<p>Select your team project for Delete</p>
			</td>
			<td scope="row">
		    	<select id="select_task_for_delete_2">
			    	<option value"">select...</option>
            		<?php
            			$controller->getAllTaskToWork(-2, $_SESSION['UserData']->department);
            		?>	
        		</select>
			</td>
			<td id="asignProject">
				<button type="button" class="btn btn-danger" id="deleteProject">Delete Project</button>
			</td>
		</tr>
	</table>
	<!-- Modal content-->
	<div id="load_container_2">
	</div>
</div>