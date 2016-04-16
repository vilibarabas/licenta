$(document).ready(function (){
	var year = $('#year_print').text();
		var mounth = $('#data_input').text();
		$(".loader").fadeIn();
		$.ajax({
			url:"ajax/statistics/get_next_month.php",
			type: "POST", 
			data: {year:year, mounth:mounth,department:$('#user_department').val()},
			success: function(data) {
				 $(".loader").fadeOut();
				 $("#list_content").html(data);
				 new Info($('table tr td').has('div'));
				}
			
		});
	$('#prev').click( function(){
		var year = $('#year_print').text();
		var mounth = $('#data_input').text();
		$(".loader").fadeIn();
		$.ajax({
			url:"ajax/statistics/get_next_month.php",
			type: "POST", 
			data: {year:year, mounth:mounth,department:$('#user_department').val()},
			success: function(data) {
				 $(".loader").fadeOut();
				 $("#list_content").html(data);
				 new Info($('table tr td').has('div'));
				}
			
		});
	});
	$('#next').click( function(){
		var year = $('#year_print').text();
		var mounth = $('#data_input').text();
		$(".loader").fadeIn();
		$.ajax({
			url:"ajax/statistics/get_next_month.php",
			type:"POST",
			data: {year:year, mounth:mounth, department:$('#user_department').val()},
			success: function(data) {
			  $(".loader").fadeOut();
			  $("#list_content").html(data);
			  new Info($('table tr td').has('div'));
			}
		});
	});
});