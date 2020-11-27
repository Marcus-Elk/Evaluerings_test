<?php 
    session_start();

    require_once("./include/db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./style/stylesheet.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
</head>
<body>
    <?php include("./include/navbar.php") ?>

<main>

    <h1 type="text">View Results</h1>
    <div class="white-line"></div>

    <?php
        function testList($team_id, $title) {
            global $db;
            
            echo("<h3>$title</h3>");
            echo("<ul class=\"test-list\">");

            $query = "SELECT `id`, `title` FROM `tests` WHERE `team_id`=$team_id;";
            $result = mysqli_query($db, $query) or die("error");

            while($row = mysqli_fetch_assoc($result)) {
                ?>
                    <li><a class="test-options" href="./result.php?t=<?= $row['id']?>"><?= $row['title']?></a></li>
                <?php
            }

            echo("</ul>");

        }

        if(!isset($_SESSION['user_id'])) {
            die('<a href="./login.php">Log in</a> to see your results.');
        }

        if(isTeacher()) {
            $query = "SELECT `id`, `name` FROM `teams`;";
            $result = mysqli_query($db, $query) or die("error");

            while ($team = mysqli_fetch_assoc($result)) {
                testList($team['id'], $team['name']);
            }

        }
    ?>

    <?php
        if(isStudent()) {
            testList($_SESSION['team_id'], "Your tests");
        }
    
    ?>

</main>
</body>
</html>

