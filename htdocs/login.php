<!DOCTYPE html>
<html lang="en">
<head>
	
	<link rel="stylesheet" href="./style/stylesheet.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
	<script src="./account/login.js" defer></script>
</head>
<body>
	<?php include("./include/navbar.php"); ?>

<main>
	<div id="msg"></div>
	
	<div class="container" id="login_form">
		<label for="username"><b>Username:</b></label>
		<input type="text" id="username" required>
		<br>
		<label for="password"><b>Password:</b></label>
		<input type="password" id="password" required>
		<br>
		<button type="submit" id="submit">Login</button>
	</div>
</main>
	
</body>
</html>