$(document).ready(function() {
    $(".add-answer").click(function() {
        $("#answer-template .answer").clone(true).appendTo($(this).parent().parent().children(".answer-options"));
    });
	$(".add-question").click(function() {
        $("#question-template .question").clone(true).appendTo("#test");
    });
    $(".remove-question").click(function() {  //delete Questions
        $('.remove-question').closest('.container2').find('.question').not(':first').last().remove();
    });

    $(".save").click(function() {
        let test = {
            title: $("#test_title").val().trim(),
            team_id: parseInt($("#team_select").val().trim()),
            questions: []
        };

        // add quesions to test:
        $("#test .question").each(function(q_index, q_element){
            let question = {
                title: $(q_element).find(".title-field").val().trim(),
                text: $(q_element).find(".text-field").val().trim(),
                answers: [],
            }

            // add answers to question:
            $(q_element).find(".answer").each(function(a_index, a_element){

                let isChecked = 0;
                if($(a_element).children("input[type=checkbox]").is(":checked")){
                    isChecked = 1;
                }

                let answer = {
                    text: $(a_element).find(".text-field").val().trim(),
                    is_correct: isChecked
                };

                question.answers.push(answer);
            });

            test.questions.push(question);

        });

        let json = JSON.stringify(test);
        console.log(json);
        $.ajax({
            url: "./test/push_test.php",
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
