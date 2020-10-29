
$(document).ready(function() {
	$("#submit").click(function() {
		
		let firstName	= $("#first_name").val().trim();
		let lastName	= $("#last_name").val().trim();
		let password	= $("#password").val().trim();
		let password_	= $("#password_").val().trim();
		let team		= $("#team_select").val().trim();
		
		if(password !== password_) {
			$("#message").html("Error: password fields must match");
			return;
		}
		
		$.ajax({
			url: 'create_account.php',
			type: 'post',
			data: {
				firstName:	firstName,
				lastName:	lastName,
				password:	password,
				team:		team
			},
			success: function(response) {
				
				let json = JSON.parse(response);

				if(json.result === 0) {
					$.ajax({
						url: 'authenticate.php',
						type: 'post',
						data: {
							username:	json.username,
							password:	password
						},
						success: function(response) {
							let json = JSON.parse(response);
							
							if(json.result === 0) {
								window.location = '../index.php';
							} else {
								$("#message").html("Serverside error occured, please try again later.");
							}
						}
					});
				} else {
					$("#message").html("Serverside error occured, please try again later.");
				}
			}
		});


	});

});
