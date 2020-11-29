$(document).ready(function() {
    $(".add-answer").click(function() {
        $("#answer-template .answer").clone(true).appendTo($(this).parent().parent().children(".answer-options"));
    });
	$(".add-question").click(function() {
        $("#question-template .question").clone(true).appendTo("#test");
    });
    $(".remove-question").click(function() {  //delete Questions
        $(this).parent().parent().remove();
    });
    $(".remove-answer").click(function() {  //delete Questions
        $(this).parent().remove();
    });

    $(".text-field").bind("input propertychange", function() {
        let out = $(this).next(".text-preview");
        
        out.text($(this).val().replace(/(?:\r\n|\r|\n)/g, '<br>'));
        MathJax.typeset(out);
    });


    $(".save").click(function() {
        let test = {
            title: $("#test_title").val().trim(),
            team_id: parseInt($("#team_select").val().trim()),
            questions: []
        };

        // add questions to test:
        $("#test .question").each(function(){
            let question = {
                title: $(this).find(".title-field").val().trim(),
                text: $(this).find(".text-field").val().trim(),
                correct_index: -1,
                answers: [],
            }

            // add answers to question:
            $(this).find(".answer").each(function(answer_index){

                if($(this).children("input[type=checkbox]").is(":checked")){
                    question.correct_index = answer_index;
                }

                let answer = {
                    text: $(this).find(".text-field").val().trim(),
                };

                question.answers.push(answer);
            });

            test.questions.push(question);

        });

        $.ajax({
            url: "./test/push_test.php",
            type: "post",
            data: {
                json: JSON.stringify(test)
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
