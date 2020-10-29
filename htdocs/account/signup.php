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
    <title>Sign up</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="./signup.js" defer></script>
</head>
<body>

    <div id="message"></div>
    <div class="container" id="signup_form">

		<label for="first_name">First name:</label>
        <input type="text" id="first_name" required>
        <br>

        <label for="last_name">Last name:</label>
        <input type="text" id="last_name" required>
		<br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" required>
        <br>
        
        <label for="password_">Confirm password:</label>
        <input type="password" id="password_" required>
        <br>
        
        <label for="team_select">Choose team:</label>
        <select id="team_select">
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

		<button type="button" id="submit">Sign up</button>
	</div>


</body>
</html>
