<?php
    session_start();

    require_once("../include/db_connect.php");
    require_once("../include/roles.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="stylesheet.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="./signup.js" defer></script>
</head>
<body>

    <div id="message"></div>
    <div class="container" id="signup-form">
        <h1>Sign up</h1>

        <input type="text" id="first_name" placeholder = "First name" required>
        <input type="text" id="last_name" placeholder = "Last name" required>
        <input type="password" id="password" placeholder = "Password" required>
        <input type="password" id="password_" placeholder = "Confirm Password" required>
        <br>
        <br>
        <select id="team_select" placeholder = "Choose Team">
            <?php
                $sqlTeams = "SELECT `id`, `name` FROM `teams`;";
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
        <br>
        <br>
		<button type="button" id="submit">Sign up</button>
	</div>


</body>
</html>
