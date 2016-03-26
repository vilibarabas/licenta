$(document).ready(function (){
	$('#reset_password').click( function()	{
		$.ajax({
			url:"ajax/user/reset_password.php",
			type:"POST",
			data: {current:$('#current_password').val(),newPass:$('#new_password').val(),confirm:$('#confirm_password').val(),yourPassword:$('#your_password').val(),user_id:$('#user_id').val()},
			success: function(result){
				$('#load_container_resetPass').html(result);
			}
		});
	});
	$('#register').click( function()	{
		$.ajax({
			url:"ajax/user/register_user.php",
			type:"POST",
			data: {username:$('#Username').val(),password:$('#password').val(),confirm:$('#Confirm_Password').val(),nume:$('#nume').val(),prenume:$('#prenume').val()},
			success: function(result){
				$('#load_container').html(result);
			}
		});
	});
});