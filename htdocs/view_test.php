<?php
    session_start();

    require_once("./include/db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./style/stylesheet.css"/>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Tests</title>
</head>
<body>
    <?php include("./include/navbar.php") ?>
<main>
    <h1 type="text">Your tests</h1>
    <div class="white-line"></div>
    <ul class="test-list">
        <?php
            if(!isset($_SESSION['user_id'])) {
                die('<a href="./login.php">Log in</a> to see your tests.');
            }

            if(isStudent()) {
                $query = "SELECT t1.`id`, t1.`title`, t2.`name` FROM `tests` AS t1
                INNER JOIN `teams` AS t2
                    ON t1.`team_id`=t2.`id`
                WHERE t1.`team_id`={$_SESSION['team_id']} LIMIT 50;";
                $result = mysqli_query($db, $query) or die("error");

                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <li><a class="test-options" href="./test.php?t=<?= $row['id']?>"><?= $row['title']?> <?= $row['name']?></a></li>
                    <?php
                }
            }

        ?>
    </ul> 
</main>
</body>
</html>