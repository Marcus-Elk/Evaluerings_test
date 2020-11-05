
$(document).ready(function() {
	
	$(".question-toggle").each(function(index) {

		$(this).click(function() {
			$(this).toggleClass("expanded");

			let content = $(this).next()[0];

			if (content.style.maxHeight){
				content.style.maxHeight = null;
			} else {
				content.style.maxHeight = content.scrollHeight + "px";
			}
		});
	});

});

