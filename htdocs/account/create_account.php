

<?php
	session_start();

	require_once("../include/db_connect.php");
	require_once("../include/roles.php");
    
	createAccount();

	function createAccount() {
		global $db;

		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		$query = "INSERT INTO";
		$result = mysqli_query($db, $query);
		if(!$result) {
			die("error");
		}
        


		die("success");
	}

    require_once("authenticate.php");

?>
