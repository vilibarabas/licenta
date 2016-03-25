<?php

if(!empty($users))
	foreach($users as $user)
	{
		echo '
			<tr>
				<td>', $user->user_id,'</td>
				<td>', $user->name,'</td>
				<td>', $user->username,'</td>
				<td>', $user->department,'</td>
				<td>', $user->acces_index,'</td>
				<td>', $user->functie,'</td>
				<td><button type="button" class="btn btn-info edit_user" data-toggle="modal" data-target="#userModel_', $user->user_id,'" id="userModel_', $user->user_id,'">Edit</button></td>
			</tr>
		';
		echo '<div id="userModel_', $user->user_id,'" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit User</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
							<div class="col-md-4">
								<strong> User Id: </strong>
							</div>
							<div class="col-md-8">
								<input class="form-control" id="edit_user_id" value="', $user->user_id,'"/>
							</div>                        
                        </div>
                        <div class="row">
							<div class="col-md-4">
								<strong> Name: </strong>
							</div>
							<div class="col-md-8">
								<input class="form-control" id="edit_user_name" value="', $user->name,'"/>
							</div>                        
                        </div>
                        <div class="row">
							<div class="col-md-4">
								<strong> UserName: </strong>
							</div>
							<div class="col-md-8">
								<input class="form-control" id="edit_userName" value="', $user->username,'"/>
							</div>                        
                        </div>
                        <div class="row">
							<div class="col-md-4">
								<strong> Department: </strong>
							</div>
							<div class="col-md-8">
								<input class="form-control" id="edit_user_department" value="', $user->department,'"/>
							</div>                        
                        </div>
                        <div class="row">
							<div class="col-md-4">
								<strong> Acces Index: </strong>
							</div>
							<div class="col-md-8">
								<input class="form-control" id="edit_user_acces_index" value="', $user->acces_index,'"/>
							</div>                        
                        </div>
                        <div class="row">
							<div class="col-md-4">
								<strong> Function: </strong>
							</div>
							<div class="col-md-8">
								<input class="form-control" id="edit_user_functie" value="', $user->functie,'"/>
							</div>                        
                        </div>
                      </div>
                      <div class="modal-footer">
                      <div class="row">
							<div class="col-md-2">
								<button type="button" class="btn btn-info float-left" id="save_edit_user">Save</button>
							</div>
							<div class="col-md-10">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>                        
                        </div>
                        
                      </div>
                    </div>

                  </div>
                </div>';
	}