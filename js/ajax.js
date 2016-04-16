$(document).ready(function (){
	$('#start_button').click( function()	{
		$.ajax({
			url:"ajax/get_contor_data.php",
			type:"POST",
			data: {userName:$('#user_name').val(),userId:$('#user_id').val(),start:1}
		});
	});
	$('#stop_button').click( function()	{

		$.ajax({
			url:"ajax/get_contor_data.php",
			type:"POST",
			data: {userName:$('#user_name').val(),userId:$('#user_id').val(),start:0}
		});
	});

	$('#view_task').click( function()	{
		$.ajax({
			url:"ajax/get_task.php",
			type:"POST",
			data: {taskId:$('#task_id').val()}
		});
	});

	$('#save_project_update').click( function()	{

		$.ajax({
			url:"ajax/save_task_data.php",
			type:"POST",
			data: {user:$('#user').val(),status:$('#select_status').val(), task_id:$('#task_id').val(), percent:$('#select_percent').val(), descriotion:$('#description').val(), observation:$('#observation').val()}
		});
	});

	$('#select_task_for_asign').change( function()	{
		$.ajax({
			url:"ajax/asign_project.php",
			type:"POST",
			data: {taskId:$('#select_task_for_asign').val()},
			success: function(result){
				$('#load_container_asign').html(result);
			}
		});
	});
	$('#select_task_for_edit').change( function()	{
		$.ajax({
			url:"ajax/edit_project.php",
			type:"POST",
			data: {taskId:$('#select_task_for_edit').val()},
			success: function(result){
				$('#load_container_edit').html(result);
			}
		});
	});
	$('#asign_project').click( function()	{
		$.ajax({
			url:"ajax/save_task_data.php",
			type:"POST",
			data: {user:$('#asign_select_user').val(),status:$('#asign_select_status').val(), task_id:$('#asign_task_id').val(), percent:$('#asign_select_percent').val(), descriotion:$('#asign_description').val(), observation:$('#asign_observation').val(), priority:$('#priority').prop('checked')}
		});
	});
	$('#create_project').click( function()	{
		$.ajax({
			url:"ajax/create_task_data.php",
			type:"POST",
			data: {name:$('#create_task_name').val(),description:$('#create_task_description').val(), observation:$('#create_task_observation').val(), time:$('#create_task_time').val()},
			success: function(result){
				$('#create_project_container').html(result);
			}
		});
	});
	$('#deleteProject').click( function()	{
		$.ajax({
			url:"ajax/delete_project.php",
			type:"POST",
			data: {delete_1:$('#select_task_for_delete_1').val(),delete_2:$('#select_task_for_delete_2').val(),sigur:$('#sigurSterg').val()},
			success: function(result){
				$('#delete_project_container').html(result);
			}
		});
	});
});

