$(document).ready(function (){
	$(".loader").fadeOut();
	$('#send_raport').click( function(){
		$(".loader").fadeIn();
		if($('#send_checked').is(':checked')){
		    var send = true;
		  }else{
		    send = false;
		  }
		$.ajax({
			url:"ajax/raport/send_raport.php",
			type:"GET",
			data: {to:$('#to_email').val(),userId:$('#user_id').val(),text:$('#email_message').val(),send:send}
		}).done(function(result){
			$(".loader").fadeOut();
			$('.raport_send_succes').html(result);
		});
	});
});