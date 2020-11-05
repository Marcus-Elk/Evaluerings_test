
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
			questions: []
		}

		$(".question").each(function(index) {
			let q_id = this.id.substring(1);
			let a_id = $("input[name="+q_id+"]:checked").val();

			let question = {
				id: q_id,
				answer: a_id
			}

			test.questions.push(question);
		});

		// TODO: send test to server

	});

});

