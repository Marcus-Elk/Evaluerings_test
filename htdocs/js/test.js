
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


	$(".submit-button").click(function() {
		
		let test = {
			answers: []
		}

		$(".question").each(function(index) {
			let q_id = parseInt(this.id.substring(1));
			let a_id = parseInt($("input[name="+q_id+"]:checked").val());
			test.answers.push(a_id);
		});

		console.log(test);

		$.ajax({
			url:'./test/push_answer.php',
			method: 'POST',
			data: {
				json: JSON.stringify(test)
			},
			success: function(response) {
				alert(response);

				// let json = JSON.parse(response);

				// if(json.result == 0) {
				// 	alert("success");
				// } else {
				// 	alert("failure");
				// }

			}
		});

	});

});

