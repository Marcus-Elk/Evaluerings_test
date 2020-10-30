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
                answers.push({
                    text: $(a_element).val().trim()
                });
            });
            test.questions.push({
                title: $(q_element).children("#question_title").val().trim(),
                text: $(q_element).children("#question_text").val().trim(),
                answers: answers,
                correct_answer: 0
            });

        });

        console.log(test);

        /*let json = JSON.stringify(test);
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
        });*/
    });
});
