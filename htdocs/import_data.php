
<?php
    session_start();

    require_once("./include/db_connect.php");
    require_once("./include/roles.php");


    if(isset($_SESSION['user_id'])) {
        import();
    }

    function usernameExists($username) {
        global $db;
        $result = mysqli_query($db, "SELECT * FROM `users` WHERE `users`.`username` = '{$username}'");
        if(!$result) {
            echo(mysqli_error($conn)."<br>");
        } else {
            return mysqli_num_rows($result) != 0;
        }
    }

    function generateUsername($name) {
        do {
            $username = substr($name, 0, 4);
            $username = str_pad($username, 4, "x");
            $username .= rand(0, 9);
            $username .= rand(0, 9);
            $username .= rand(0, 9);
            $username .= rand(0, 9);
        } while(usernameExists($username));
        
        return $username;
    }

    function import() {
        global $db;
        $file = fopen("./include/data.csv", "r");    

        while(!feof($file)) {
            $line = fgets($file);

            $data = explode(",", $line);

            $username = generateUsername($data[3]);

            $roles = 0;
            if($data[1] === "Elev") {
                $roles = makeStudent($roles);
            }

            if($data[1] === "L�rer") {
                $roles = makeTeacher($roles);
            }
            
            $query = "INSERT INTO `users`(
                    `first_name`,
                    `last_name`,
                    `username`,
                    `password_hash`,
                    `roles`,
                    `team_id`
                ) VALUES(
                    '{$data[3]}',
                    '{$data[4]}',
                    '{$username}',
                    '0',
                    {$roles},
                    1
                );";

            $result = mysqli_query($db, $query);
            if(!$result) {
                die(mysqli_error($db));
            }
        }
    }
?>
