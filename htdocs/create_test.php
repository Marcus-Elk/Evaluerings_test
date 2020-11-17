<?php
    session_start();

    require_once("./include/db_connect.php");
    require_once("./include/roles.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./style/stylesheet.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Test</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="./js/load_mathjax.js"></script>
    <script src="./test/create_test.js" defer></script>
    <script src="./style/select_list.js" defer></script>

</head>
<body>
<?php include("./include/navbar.php"); ?>
    
<main class="container2">
    <h1 type="text">Create a test</h1>
    <div class="container2_top">
        <input class="title" type="text" id="test_title" name="title" placeholder="Title"> </input>
        <div class="choose_team">
            <label class="bold" type="text" for="team_select">Choose a team:</label>
            <select class="custom-select" id="team_select" name="team_select_name">
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
    <button type="button" class="add-question">Add questions</button>
    <button type="button" class="save">Publish Test</button>
</main>
    
    <div class="template" id="question-template"> <!--Lav ydre div hidden ("display:none")-->
        <div class="question">
            
            <div class="question-title">
                <input class="title-field" name="title" type="text" placeholder="Give the question a title"></input>
            </div>
            <div class="question-text">
                <textarea class="text-field" name="question-text" rows="5" cols="50" placeholder="Write the question"></textarea>
                <p class="text-preview"></p>
            </div>
            <div class="answer-options">

            </div>
            <div>
                <button type="button" class="add-answer">Add answer</button>
                <button type="button" class="remove-question">Remove question</button>
            </div>
            <div class="white-line"></div>
        </div>
    </div>

    <div class="template" id="answer-template">
        <div class="answer">
            <textarea class="text-field" name="answer-text" rows="3" cols="30" placeholder="Write the answer"></textarea> 
            <p class="text-preview"></p>
            <input type="checkbox">
            <button type="button" class="remove-answer">Remove answer</button>
        </div>
    </div>
</body>
</html>