
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

	let math_input 	= $(".math-input");
	
	math_input.each(function(index) {

		$(this).bind("input propertychange", function() {
			let math_output	= $(this).parent().children(".math-output");

			math_output.html($(this).val().replace(/(?:\r\n|\r|\n)/g, '<br>'));
			MathJax.typeset(math_output);
		});
		
	});

})
