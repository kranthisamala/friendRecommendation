$('#Recom_sel').change(function(event) {
	/* Act on the event */
	$.post("rec_lel.php",{'rec':''+$(this).val()},function(data){
		$("#rec_list").html(data);
	});
});