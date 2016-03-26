<table class="table table-striped">
	<tr>
	  <th scope="row"><img id="profile_img" src="img/profile_img.jpg"></th>
	  <?php echo ($user_data['info']->user_id == $_SESSION['UserData']->user_id) ? '<td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#resetPassword">Reset Password</button><div id="load_container_resetPass"></div></td>' : '<td></td>'; ?>
	</tr>
	<tr>
	  <th scope="row">Name: </th>
	  <td><?php echo  $user_data['info']->name; ?></td>
	</tr>
	<tr>
	  <th scope="row">Departament: </th>
	  <td><?php echo  $user_data['info']->department; ?></td>
	</tr>
	<tr>
	  <th scope="row">Functie: </th>
	   <td><?php echo $user_data['info']->functie; ?></td> 
	</tr>
	<tr>
	  <th scope="row">Started Projects: </th>
	   <td><?php echo $user_data['task_count']['started']; ?></td> 
	</tr>
	<tr>
	  <th scope="row">Finished Projects: </th>
	   <td><?php echo $user_data['task_count']['finished']; ?></td> 
	</tr>
	<tr>
	  <th scope="row">Not processed Projects: </th>
	   <td><?php echo $user_data['task_count']['not_processed']; ?></td> 
	</tr>
</table>
<div class="modal fade" id="resetPassword" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reset Password</h4>
        </div>
        <div class="modal-body">
        	<?php echo '<input hidden id="your_password" value="', $_SESSION['UserData']->password,'"/>'; ?>
            <div class="input-group">
			  <span class="input-group-addon">Current Password&nbsp;</span>
			  <input type="password" class="form-control" placeholder="Current password" aria-describedby="basic-addon1" id="current_password">
			</div>
			<div class="input-group">
			  <span class="input-group-addon">New Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			  <input type="password" class="form-control" placeholder="new password" aria-describedby="basic-addon1"  id="new_password">
			</div>
			<div class="input-group">
			  <span class="input-group-addon">Confirm Password</span>
			  <input type="password" class="form-control" placeholder="Confirm Password" aria-describedby="basic-addon1"  id="confirm_password">
			</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal" id="reset_password">Reset</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>