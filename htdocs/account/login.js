
$(document).ready(function() {

	$("#submit").click(function() {

		let username = $("#username").val().trim();
		let password = $("#password").val().trim();

		if(username !== "" && password !== "") {
			$.ajax({
				url: 'authenticate.php',
				type: 'post',
				data: {
					username:username,
					password:password
				},
				success: function(response) {
					response = $.trim(response);

					let msg = "";
					
					if(response == "success") {
						window.location = "../index.php";
					} else {
						msg = "Invalid username or password";
					}
					
					$("#msg").html(msg);
				}
			});
		}

	});
})
