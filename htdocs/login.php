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
		<h1> Login </h1>
		<input type="text" id="username" placeholder = "Username" required>
		<br>
		<input type="password" id="password" placeholder = "Password" required>
		<br>
		<br>
		<button type="submit" id="submit">Login</button>
	</div>
</main>
	
</body>
</html>