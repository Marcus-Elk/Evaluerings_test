<?php
	session_start();

	require_once("./include/db_connect.php");
	require_once("./include/roles.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="./style/stylesheet.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign up</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
	<script src="./account/signup.js" defer></script>
</head>
<body>
<?php include("./include/navbar.php"); ?>

<main>
	<div id="message"></div>
	<div class="container" id="signup_form">
	<H1> Sign Up </H1>
		
		<input type="text" id="first_name" placeholder = "First Name" required>
		<br>


		<input type="text" id="last_name" placeholder = "Last Name" required>
		<br>
		

		<input type="password" id="password" placeholder = "Password" required>
		<br>
		

		<input type="password" id="password_" placeholder = "Confirm Password" required>
		<br>
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
		<br>
		<button type="button" id="submit">Sign up</button>
	</div>
	<script src="./style/select_list.js" defer></script>

</main>
</body>
</html>
