
$(document).ready(function() {


	$(".nav-link[href]").each(function(index) {

		if(this.href == window.location.href) {
			$(this).addClass("current");
		}
	}); 


});