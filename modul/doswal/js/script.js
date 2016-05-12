$("#form").submit(function(e) {

    var url = $(this).attr('action');

    $.ajax({
		type: "POST",
		url: url,
		data: $("#form").serialize(),
		dataType: 'json',
		success: function(response)
		{
		   	if(response.status == "success") {
		   		$('#myModal').modal('hide');
		   		if(response.action == "update") {
		   			var row = $('tr[data-id=' + response.doswal.id_doswal + ']');
		   			row.children().eq(0).html(response.doswal.nama);
		   			row.children().eq(1).html(response.doswal.username);
		   			row.children().eq(2).html(response.doswal.password);
		   			row.children().eq(3).html(response.doswal.level);
		   		}
		   		else {
		   			$("#tabel_doswal").find('tbody')
				    .append($('<tr>')
				    	.attr('data-id', response.doswal.id_doswal)
				    	.append($('<td>').addClass('col-md-4').html(response.doswal.nama))
						.append($('<td>').addClass('col-md-4').html(response.doswal.username))
						.append($('<td>').addClass('col-md-4').html(response.doswal.password))
				    	.append($('<td>').addClass('col-md-4').html(response.doswal.level))
				    	.append($('<td>').addClass('text-right col-md-4')					    		
				    		.append($('<a>')
				    			.attr('href', "#")
				    			.attr('class', 'update')
				    			.text('')
				    		)
				    	)
						.append($('<td>').addClass('text-right col-md-4')					    		
				    		.append($('<a>')
				    			.attr('href', "#")
				    			.attr('class', 'update btn btn-block btn-sm bg-green')
				    			.text('NEW')
				    		)
				    	)
				    );
		   		}
				window.location.reload(0);		   		
		   	}
		   	else {
		   		alert(response.message);
		   	}
		}
	});
    e.preventDefault();
});

$('#save').on('click', function() {
	$("#form").submit();
});

$('body').delegate('.delete', 'click', function() {
	var row = $(this).closest("tr"),
		id = row.attr('data-id');

	if(!confirm("Press a button!")) return false;

	$.ajax({
		type: 'POST',
		dataType: 'json',
		data: {id: id},
		url: 'delete.php',
		success: function(response) {
			if(response.status == "success") {
				row.remove();
			}
			else {
				alert(response.message);
			}
		}
	});
	return false;
});

$('body').delegate('.update', 'click', function() {
	var row = $(this).closest("tr"),
		id = row.attr('data-id');

	$.ajax({
		type: 'GET',
		dataType: 'json',
		data: {id: id},
		url: 'view.php',
		success: function(response) {
			if(response.status == "success") {
				$('#myModal').modal('show');
				$('input#id_doswal').val(response.id_doswal);
				$('input#nama').val(response.nama);
				$('input#username').val(response.username);
				$('input#password').val(response.password);
				$('select#level').val(response.level);
				
			}
			else {
				alert(response.message);
			}
		}
	});
	return false;
});