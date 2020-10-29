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
    
    <label for="teams_select">Choose a team:</label>
    <select id="teams_select" name="teams_select_name">
        <?php
            $sqlTeams = "SELECT `name` FROM `teams`;";
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

    <div style="display:none" class="template" id="question_template"> <!--Lav ydre div hidden ("display:none")-->
        <div class="question">
            <input name="title" placeholder="Title"></input>
            <br>
            <textarea name="text_question" rows="5" cols="100" placeholder="Write the question"></textarea>
            <button type="button" id="add_answer">Add answer</button>
        </div>
        
         
    </div>
</body>
</html>