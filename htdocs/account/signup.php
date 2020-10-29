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
    <title>Sign out</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
</head>
<body>

    <div class="container" id="signup_form">
		<label for="username"><b>Username:</b></label>
		<input type="text" id="username" required>
		<br>
		<label for="password"><b>Password:</b></label>
        <input type="password" id="password" required>
        <br>
        <label for="password_"><b>Confirm password:</b></label>
        <input type="password_" id="password" required>
        <br>"
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

		<button type="button" id="submit">Sign up</button>
	</div>


</body>
</html>
