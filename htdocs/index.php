<?php
    session_start();
    include("./navbar/navbar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="./style/stylesheet.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="./index.js" defer></script>
</head>
<body>

<div style="margin-left:7%;padding:1px 16px;height:1000px;">
    <?php
        require_once("./include/roles.php");

        if(isset($_SESSION['user_id'])) {
            echo("<p class = \"text\">Username: {$_SESSION['username']}<br></p>");
            
            if(isAdmin()) {
                echo("<p class = \"text\">This is an admin account</p>");
            }

            if(isTeacher()){
                echo("<p class = \"text\">You are logged in as a teacher</p>");
            }

            if(isStudent()){
                echo("<p class = \"text\">You are logged in as a student</p>");
            }
            ?>

         <?php   
        } else {
            echo("<p class = \"text\">You are not logged in</p>");
        }
    ?>

    <div>
        <label for="math-input"> Try the math syntax here:</label><br>
        <textarea class="math-input" rows="5" cols="40" placeholder="Math text here">`[[a, b], [c, d]][[x], [y]]=[[a x + b y], [c x + d y]]`</textarea>
        <p class="math-output"></p>
    </div>

    <div>
        <label for="math-input"> Try the math syntax here:</label><br>
        <textarea class="math-input" rows="5" cols="40" placeholder="Math text here">`[[a, b], [c, d]][[x], [y]]=[[a x + b y], [c x + d y]]`</textarea>
        <p class="math-output"></p>
    </div>
</div>
</body>
</html>