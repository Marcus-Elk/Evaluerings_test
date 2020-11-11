
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
    <ul class="test-list">
    <?php
        if(!isset($_SESSION['user_id'])) {
            die('<a href="./login.php">Log in</a> to see your tests.');
        }

        if(isStudent()) {
            $query = "SELECT `id`, `title` FROM `tests` WHERE `team_id`={$_SESSION['team_id']} LIMIT 50;";
            $result = mysqli_query($db, $query) or die("error");

            while($row = mysqli_fetch_assoc($result)) {
                ?>
                    <li><a href="./result.php?t=<?= $row['id']?>"><?= $row['title']?></a></li>
                <?php
            }
        }
    
    ?>
    </ul>

</main>
</body>
</html>

