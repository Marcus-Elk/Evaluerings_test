<?php
    session_start();

    require_once("../include/db_connect.php");
    require_once("../include/roles.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="./create_test.js" defer></script>
</head>
<body>

    <input id="test_title" name="title" placeholder="Title"></input>
    <br>
    
    <label for="team_select">Choose a team:</label>
    <select id="team_select" name="team_select_name">
        <?php
            $sqlTeams = "SELECT * FROM `teams`;";
            $result = mysqli_query($db,$sqlTeams);
            
            if(!$result){
                die("error");
            }
            while($row = mysqli_fetch_array($result)){
                extract($row);
                echo("<option value=\"$id\">$name</option>");
            } 
        ?>
    </select>

    <div id="test">

    </div>
    
    <button type="button" id="add_question">Add questions</button>
    <br>
    <button type="button" id="save_test">Publish Test</button>

    <div style="display:none" class="template" id="question_template"> <!--Lav ydre div hidden ("display:none")-->
        <div class="question">
            <input id="question_title" name="title" placeholder="Title"></input>
            <br>
            <textarea id="question_text" name="question_text" rows="5" cols="100" placeholder="Write the question"></textarea>
            <br>
            <div id="answer_options">

            </div>
            <button type="button" id="add_answer">Add answer</button>
            <br>
            <label for="select_correct_answer">Choose correct answer: </label>
            <select id="select_correct_answer" name="select_correct_answer">

            </select>
        </div>
        
         
    </div>
    <div style="display:none" class="template" id="answer_template">
        <textarea class="answer" id="answer_text" name="answer_text" rows="3" cols="30" placeholder="Write the answer"></textarea>
    </div>
</body>
</html>