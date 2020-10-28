
<?php
	session_start();

	require_once("../include/db_connect.php");
	require_once("../include/roles.php");

	authenticate();

	function authenticate() {
		global $db;

		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		$query = "SELECT `id`, `first_name`, `last_name`, `roles`, `username`, `password_hash` FROM `users` WHERE `username`='{$username}';";
		$result = mysqli_query($db, $query);
		if(!$result) {
			die("error");
		}

		if(mysqli_num_rows($result) == 0) {
			die("bad credentials");
		}
		$row = mysqli_fetch_assoc($result);

		$password_hash = $row['password_hash'];
		
		if(!password_verify($password, $password_hash)) {
			die("bad credentials");
		}

		$_SESSION['user_id'] = $row['id'];
		$_SESSION['first_name'] = $row['first_name'];
		$_SESSION['last_name'] = $row['last_name'];
		$_SESSION['user_roles'] = $row['roles'];

		die("success");
	}



?>
