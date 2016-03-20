<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<th>
				<p>Select project</p>
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
	<!-- Modal content-->
	<div id="load_container_2">
	</div>
</div>