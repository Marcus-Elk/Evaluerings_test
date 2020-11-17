<?php
    session_start();

    require_once("../include/db_connect.php");
    require_once("../include/roles.php");

    authenticate();

    function authenticate() {
        global $db;

        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        $query = "SELECT `id`, `first_name`, `last_name`, `username`, `password_hash`, `roles`, `team_id` FROM `users` WHERE username='$username';";
        $result = mysqli_query($db, $query);
        if(!$result) {
            die(json_encode(array(
                'result' => -1,
            )));
        }

        if(mysqli_num_rows($result) == 0) {
            die(json_encode(array(
                'result' => 1,
            )));
        }
        $row = mysqli_fetch_assoc($result);

        $password_hash = $row['password_hash'];
        
        if(!password_verify($password, $password_hash)) {
            die(json_encode(array(
                'result' => 1,
            )));
        }

        $_SESSION['user_id']	= $row['id'];
        $_SESSION['username']	= $row['username'];
        $_SESSION['first_name']	= $row['first_name'];
        $_SESSION['last_name']	= $row['last_name'];
        $_SESSION['user_roles'] = $row['roles'];
        $_SESSION['team_id']	= $row['team_id'];

        die(json_encode(array(
            'result' => 0,
        )));

    }

?>
