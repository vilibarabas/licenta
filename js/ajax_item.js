function getEmptyContainer(container){

	var container = document.getElementById(container).getElementsByClassName('empty');
	if(container.length > 0){
		return true;
	}
	else{
		return null;
	}
}

$(document).ready(function (){
	$('#add_monitor').click( function()	{
		if(getEmptyContainer('monitor_container')){
			$.ajax({
				url:"ajax/item/add_or_remove_item.php",
				type:"POST",
				data: {user_id:$('#user_id').val(),monitor_index:$('#select_monitor').val()},
				success: function(result){
					$('#item_message').html(result);
				}
			});
		}
	});
	$('#add_unitate').click( function()	{
		if(getEmptyContainer('unitate_container')){
			$.ajax({
				url:"ajax/item/add_or_remove_item.php",
				type:"POST",
				data: {user_id:$('#user_id').val(),unitate_index:$('#select_unit').val()},
				success: function(result){
					$('#item_message').html(result);
				}
			});
		}
	});
	$('#add_mouse').click( function()	{
		$.ajax({
			url:"ajax/item/add_or_remove_item.php",
			type:"POST",
			data: {user_id:$('#user_id').val(),mouse_index:$('#select_mouse').val()},
			success: function(result){
				$('#item_message').html(result);
			}
		});
	});
	$('.accept_button').click( function(event)	{
		var row = $(event.target).parent().parent().parent();
		var nr = row.find('.register_nr').text();
		var item = row.find('.item_name').text();
		var user = row.find('.user_name').text();
		row.remove();
		console.log(nr);
		$.ajax({
			url:"ajax/item/accept_decline_team_leader.php",
			type:"POST",
			data: {accept:1, item:item, user:user, nr:nr},
			success: function(result){
				$('#item_accept_message').html(result);
			}
		});
	});
	$('.decline_button').click( function(event)	{
		var row = $(event.target).parent().parent().parent();
		var nr = row.find('.register_nr').text();
		var item = row.find('.item_name').text();
		var user = row.find('.user_name').text();
		row.remove();
		console.log(nr);
		$.ajax({
			url:"ajax/item/accept_decline_team_leader.php",
			type:"POST",
			data: {decline:1, item:item, user:user, nr:nr},
			success: function(result){
				$('#item_accept_message').html(result);
			}
		});
	});
	$('.done_button').click( function(event)	{
		var row = $(event.target).parent().parent().parent();
		var nr = row.find('.register_nr').text();
		var item = row.find('.item_name').text();
		var user = row.find('.user_name').text();
		row.remove();
		console.log(nr);
		$.ajax({
			url:"ajax/admin/done_or_delete_item_ask.php",
			type:"POST",
			data: {accept:1, item:item, user:user, nr:nr},
			success: function(result){
				$('#item_accept_message').html(result);
			}
		});
	});
	$('.delete_button').click( function(event)	{
		var row = $(event.target).parent().parent().parent();
		var nr = row.find('.register_nr').text();
		var item = row.find('.item_name').text();
		var user = row.find('.user_name').text();
		row.remove();
		console.log(nr);
		$.ajax({
			url:"ajax/admin/done_or_delete_item_ask.php",
			type:"POST",
			data: {decline:1, item:item, user:user, nr:nr},
			success: function(result){
				$('#item_accept_message').html(result);
			}
		});
	});
});