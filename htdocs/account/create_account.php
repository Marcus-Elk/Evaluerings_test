<?php
	session_start();

	require_once("../include/db_connect.php");
    
	createAccount();

	function createAccount() {
		global $db;

		$firstName		= mysqli_real_escape_string($db, $_POST['firstName']);
		$lastName		= mysqli_real_escape_string($db, $_POST['lastName']);
		$password		= mysqli_real_escape_string($db, $_POST['password']);
		$passwordHash	= password_hash($password, PASSWORD_DEFAULT);
		$team			= intval($_POST['team']);
		$username		= generateUsername($firstName);

		$query = "INSERT INTO `users`(`first_name`, `last_name`, `username`, `password_hash`, `roles`, `team_id`)
			VALUES('$firstName', '$lastName', '$username', '$passwordHash', 0, $team);";

		$result = mysqli_query($db, $query);
		if(!$result) {
			die(json_encode(array(
				'result' => -1,
			)));
		}

		die(json_encode(array(
			'result' => 0,
			'username' => $username,
		)));
	}

    function generateUsername($name) {
        do {
            $username = substr($name, 0, 4);
            $username = str_pad($username, 4, "xyzw");
            $username .= rand(0, 9);
            $username .= rand(0, 9);
            $username .= rand(0, 9);
            $username .= rand(0, 9);
        } while(usernameExists($username));
        
        return $username;
    }

    function usernameExists($username) {
        global $db;
        $result = mysqli_query($db, "SELECT `id` FROM `users` WHERE `username` = '$username';");
        if(!$result) {
			die("error");
        } else {
            return mysqli_num_rows($result) != 0;
        }
    }

?>
