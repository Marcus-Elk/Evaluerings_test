
$(document).ready(function() {
	$("#add_question").click(function() {
        $("#test").append($("#question_template").html());
        reassignQuestionID();
        
	});
})

function reassignQuestionID (){
    $(".question").removeAttr("id");
    $("#test .question").each(function(index){

        $(this).attr("id","question_" + index);

    })
}