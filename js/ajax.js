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

	$('#set_status').click( function()	{
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
				$('#load_container').html(result);
			}
		});
	});

	$('#asign_project').click( function()	{
		$.ajax({
			url:"ajax/save_task_data.php",
			type:"POST",
			data: {user:$('#asign_select_user').val(),status:$('#asign_select_status').val(), task_id:$('#asign_task_id').val(), percent:$('#asign_select_percent').val(), descriotion:$('#asign_description').val(), observation:$('#asign_observation').val()}
		});
	});
});

