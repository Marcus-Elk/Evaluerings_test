<?php
    session_start();

    require_once("./include/db_connect.php");
    require_once("./include/roles.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./style/stylesheet_create_test.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Test</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="./test/create_test.js" defer></script>

</head>
<body>
<?php include("./include/navbar.php"); ?>
    
<main class="container">
    <h1 type="text">Create a test</h1>
    <div class="container_top">
        <input class="title" type="text" id="test_title" name="title" placeholder="Title"></input>
        <div class="choose_team">
            <label type="text" for="team_select">Choose a team:</label>
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
        </div>
    </div>
    <div class="white-line"></div>
    <div id="test">

    </div>
    <button type="button" id="add_question">Add questions</button>
    <button type="button" id="save_test">Publish Test</button>
</main>
    
    <div class="template" id="question_template"> <!--Lav ydre div hidden ("display:none")-->
        <div class="question">
            
            <div class="question_title">
                <input type="text" id="question_title" name="title" placeholder="Give the question a title"></input>
            </div>
            <div class="question_textarea">
                <textarea id="question_text" name="question_text" rows="5" cols="100" placeholder="Write the question"></textarea>
            </div>
            <div id="answer_options">

            </div>
            <div class="add_answer_button">
                <button type="button" id="add_answer">Add answer</button>
            </div>  
            <div class="white-line"></div>
        </div>
    </div>

    <div class="template" id="answer_template">
        <div class="answer">
            <textarea id="answer_text" name="answer_text" rows="3" cols="30" placeholder="Write the answer"></textarea> <!--css kode: https://www.w3schools.com/howto/howto_css_switch.asp-->
            <input id="is_correct" type="checkbox">
        </div>
    </div>
</body>
</html>