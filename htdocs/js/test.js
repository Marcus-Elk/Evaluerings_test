
$(document).ready(function() {
	
	$(".question-toggle").each(function(index) {
		$(this).click(function() {
			
			let content = $(this).next();

			if(content.css("max-height") == "0px") {
				content.css("max-height", "none");
			} else {
				content.css("max-height", "0px");
			}
		});
	});




});

