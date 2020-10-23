
<?php
     
    function import() {
        $conn = mysqli_connect("localhost:3306", "root", "", "grfl_mat");
    
        $file = fopen(__DIR__."/data.csv", "r");    
        
        $i = 0;

        while(!feof($file)) {
            $line = fgets($file);

            $data = explode(",", $line);
            
            /*foreach($data as $str) {
                echo($str."<br>");
            }*/

            //echo(count($data));

            $query = "INSERT INTO `users`(
                `first_name`,
                `last_name`,
                `username`,
                `password_hash`,
                `role`,
                `team_id`
            ) VALUES(
                '".$data[3]."',
                '".$data[4]."',
                '".$i++."',
                '0',
                0x00000001,
                1
            );";

            $result = mysqli_query($conn, $query);
            if(!$result) {
                echo(mysqli_error($conn)."<br>");
            }
        }
        
        
    }
?>
