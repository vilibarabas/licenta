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
			data: {status:$('#select_status').val(), task_id:$('#task_id').val(), percent:$('#select_percent').val(), descriotion:$('#description').val(), observation:$('#observation').val()}
		});
	});
});

