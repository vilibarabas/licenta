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
});