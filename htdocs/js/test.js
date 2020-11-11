
$(document).ready(function() {
	
	$(".question-toggle").each(function(index) {

		$(this).click(function() {
			$(this).toggleClass("expanded");

			let content = $(this).next()[0];

			if (content.style.maxHeight){
				content.style.maxHeight = null;
				$(this).children(".toggle-symbol").text("+")
			} else {
				content.style.maxHeight = content.scrollHeight + "px";
				$(this).children(".toggle-symbol").text("-")
			}
		});
	});


	$(".submit-button").click(function() {
	
		let url = new URL(window.location.href);
		
		let test = {
			id: url.searchParams.get("t"),
			answers: []
		}

		$(".question").each(function(index) {
			let q_id = parseInt(this.id.substring(1));
			let a_id = parseInt($("input[name="+q_id+"]:checked").val());
			test.answers.push(a_id);
		});

		$.ajax({
			url:'./test/push_answer.php',
			method: 'POST',
			data: {
				json: JSON.stringify(test)
			},
			success: function(response) {

				let json = JSON.parse(response);

				switch(json.result) {
					case 0:
						window.location.href = "./index.php";
						break;
					case -1:
						alert("An error occured while trying to submit your answers.");
						break;
					case 1:
						alert("You have already answered this test");
					break;
				}

				if(json.result == 0) {
					
				} else {
					
				}

			}
		});

	});

});

