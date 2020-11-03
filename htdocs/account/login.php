<!DOCTYPE html>
<html lang="en">
<head>
	
	<link rel="stylesheet" href="stylesheet.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
	<script src="./login.js" defer></script>
</head>
<body>

	<div id="msg"></div>
	
	<div class="container" id="login-form">
	<h1>Login</h1>
        <input type="text" id="username" placeholder="Username">
        <br>
        <input type="password" id="password" placeholder="Password">
		<br>
		<br>
		<input type="button" id="submit" value="Login">
		<br>
		<a style="color: white;" href="./signup.php">Don't Have an account? sign up!</a>
		
	</div>


</body>
</html>