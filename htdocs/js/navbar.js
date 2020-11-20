
$(document).ready(function() {

	$(".nav-link[href]").each(function(index) {

		if(this.href == window.location.href) {
			$(this).addClass("current");
		}
	}); 



	$("#theme-mode").click(function(){
		 $(":root")
			 .css("--one","#313131")
			 .css("--two","#525252")
			 .css("--three","#fffff0")
			 .css("--four","#414141")
			 .css("--five","CA3E47")
			 
			 ;

	});

});