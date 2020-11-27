$(document).ready(function() {

	$("#submit").click(function() {

		let username = $("#username").val().trim();
		let password = $("#password").val().trim();

		if(username !== "" && password !== "") {
			
			$.ajax({
				url:  './account/authenticate.php',
				type: 'post',
				data: {
					username:	username,
					password:	password
				},
				success:function(response) {
					json = JSON.parse(response);

					switch(json.result) {
						case 0:
							window.location = "./index.php";
							break;
						case 1:
							$("#msg").html("Invalid username or password");
							break;
						case -1:
							$("#message").html("Serverside error occured, please try again later.");
							break;
					}
				}
			});
		}
	});
})
