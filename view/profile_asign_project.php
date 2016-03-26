<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th>
				<p>Select project for assign</p>
			</th>
		    <td scope="row">
		    	<select id="select_task_for_asign">
			    	<option>select...</option>
            		<?php
            			$controller->getAllTaskToWork(-1, $_SESSION['UserData']->department);
            		?>	
        		</select>
			</td>
			<td id="asignProject">
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalAssign" id="asignProject">Select Project</button>
			</td>
		</tr>
	</table>
	<!-- Modal content-->
	<div id="load_container">
	</div>
</div>