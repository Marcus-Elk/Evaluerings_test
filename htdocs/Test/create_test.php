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

</body>
</html>