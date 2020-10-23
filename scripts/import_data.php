
<?php
    function usernameExists($conn, $username) {
        $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `users`.`username` = '{$username}'");
        if(!$result) {
            echo(mysqli_error($conn)."<br>");
        } else {
            return mysqli_num_rows($result) != 0;
        }
    }

    function generateUsername($conn, $name) {
        do {
            $username = substr($name, 0, 4);
            $username = str_pad($username, 4, "x");
            $username .= rand(0, 9);
            $username .= rand(0, 9);
            $username .= rand(0, 9);
            $username .= rand(0, 9);
        } while(usernameExists($conn, $username));
    
        return $username;
    }

    function import() {
        include_once("roles.php");
        
        $conn = mysqli_connect("localhost:3306", "root", "", "grfl_mat");
        
        $file = fopen(__DIR__."/data.csv", "r");    
        
        while(!feof($file)) {
            $line = fgets($file);

            $data = explode(",", $line);

            $username = generateUsername($conn, $data[3]);

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
                    `role`,
                    `team_id`
                ) VALUES(
                    '{$data[3]}',
                    '{$data[4]}',
                    '{$username}',
                    '0',
                    {$roles},
                    1
                );";

            $result = mysqli_query($conn, $query);
            if(!$result) {
                echo(mysqli_error($conn)."<br>");
            }
        }
        
        
    }
?>
