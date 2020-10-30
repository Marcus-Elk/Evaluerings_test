<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="./index.js" defer></script>
</head>
<body>
    <?php
        require_once("./include/roles.php");

        if(isset($_SESSION['user_id'])) {
            echo("Username: {$_SESSION['username']}<br>");
            echo("<a href=\"./account/logout.php\">log out</a>");
            
            if(isAdmin()) {
                echo("<br>This is an admin account");
                echo("<br><button id=\"import\">import data</button>");
            }

            if(isTeacher()){
                echo("<br>You are logged in as a teacher");
                echo("<br><a href=\"./Test/create_test.php\">Create a test</a>");
            }

            if(isStudent()){
                echo("<br>You are logged in as a student");
                echo("<br><a href=\"./Test/view_test.php\">Your available tests</a>");
            }

        } else {
            echo("<a href=\"./account/login.php\">log in</a><br>");
            echo("<a href=\"./account/signup.php\">sign up</a>");
        }

    ?>

</body>
</html>