
	$(document).ready(function() {

	$(".nav-link[href]").each(function(index) {

		if(this.href == window.location.href) {
			$(this).addClass("current");
		}
	}); 





});


theme = !theme;

$("#theme-mode").click(function(){
	theme = !theme;

	$.ajax({
		url: "./style/theme.php",
		method: "post",
		data: {
			theme: theme ? 1 : 0,
		},
		success: function(response){

		}

	});

	if(theme){
	 $(":root")
		 .css("--one","#313131")
		 .css("--two","#525252")
		 .css("--three","#fffff0")
		 .css("--four","#CA3E47")
		 .css("--five","#414141")
		 .css("--six","#fffff0")
		 .css("--seven","#414141")
		 .css("--filter-hover","grayscale(100%) brightness(1.4)");
	} else {
		$(":root").removeAttr("style");

	}
})
.click();