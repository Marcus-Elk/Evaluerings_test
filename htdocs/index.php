<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./style/stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="./js/load_mathjax.js" defer></script>
    <script src="./js/index.js" defer></script>

    <title>Home</title>
</head>
<body>
<?php include("./include/navbar.php"); ?>

<main>
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
    
</main>
</body>
</html>