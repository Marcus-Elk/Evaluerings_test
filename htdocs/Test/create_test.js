$(document).ready(function() {
    $("#add_answer").click(function() {
        $("#answer_template .answer").clone(true).appendTo($(this).parent().children("#answer_options"));
    });
	$("#add_question").click(function() {
        $("#question_template .question").clone(true).appendTo("#test");
    });

    $("#save_test").click(function() {
        let test = {
            title: $("#test_title").val().trim(),
            team_id: parseInt($("#team_select").val().trim()),
            questions: []
        };
        $("#test .question").each(function(q_index, q_element){
            let answers = [];
            $(q_element).find("#answer_options .answer").each(function(a_index, a_element){
                
                let isChecked = 0;
                if($(a_element).children("#is_correct").is(":checked")){
                    isChecked = 1;
                }
                answers.push({
                    text: $(a_element).children("#answer_text").val().trim(),
                    is_correct: isChecked
                });
            });
            test.questions.push({
                title: $(q_element).children("#question_title").val().trim(),
                text: $(q_element).children("#question_text").val().trim(),
                answers: answers,
            });

        });

        let json = JSON.stringify(test);
        $.ajax({
            url: "push_test.php",
            type: "post",
            data: {
                json: json
            },
            success: function(response){
                json_ = JSON.parse(response);
                if(json_.result === 0){
                    alert("Test successfully published! :)");
                }
            }
        });
    });
});
