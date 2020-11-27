
$(document).ready(function() {
	$("#import").click(function() {
		$.ajax({
			url: './import/import_data.php',
			type: 'get',
			success: function(response) {
				response = $.trim(response);
				if(response == "") {
					response = "Import successful";
				}
				
				alert(response);
			}
		});
	});

});
