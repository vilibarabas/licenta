$(document).ready(function (){

	$('div.save_edit_user button').click( function(event)	{
		
		var id = $(event.target).attr('id');
		id = 'userModel_' + id.split('_')[1];
		id = 'div#'+ id + ' '; // acest id e necesar pentru a sti care date sunt schimbate, fara acesta de fiecare data se modifica doar primul utilizator din lista
		$.ajax({
			url:"ajax/admin/save_user_data.php",
			type:"POST",
			data: {user_id:$(id + '#edit_user_id').val(),name:$(id + '#edit_user_name').val(),username:$(id + '#edit_userName').val(),department:$(id + '#edit_user_department').val(),acces_index:$(id + '#edit_user_acces_index').val(),functie:$(id + '#edit_user_functie').val()},
			success:function(result){
				$('#load_container').html(result);
			}
		});
	});
});

