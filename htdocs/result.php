<?php
    session_start();

    require_once("./include/db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./style/stylesheet.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
</head>
<body>
<?php include("./include/navbar.php") ?>

<main>


    <?php
        if(isTeacher()) {
            $query = "SELECT `id`, `username` FROM `users` WHERE `team_id`={$_SESSION['team_id']};";
            $u_result = mysqli_query($db, $query) or die("error");

            $query = "SELECT `id` FROM `questions` WHERE `test_id`={$_GET['t']};";
            $q_result = mysqli_query($db, $query) or die("error");
            $q_count = mysqli_num_rows($q_result);

            // $r_results = [];

            // while($q_row = mysqli_fetch_assoc($q_result)) {
            //     $query = "SELECT a.`is_correct` "
            //     $r_result = mysqli_query($db, $query) or die("error");
            //     array_push($r_results, $r_result);
            // }

            ?>
            <table>
                <tr>
                    <th>Username</th>

                    <?php
                        for($i = 1; $i <= $q_count; $i++) {
                            echo("<th>Q$i</th>");
                        }
                    ?>

                    <th>Total</th>
                    <th>%</th>
                </tr>
                <?php
                    while($u_row = mysqli_fetch_assoc($u_result)) {
                        echo("<tr>");
                        echo("<td>{$u_row['username']}</td>");
                        
                        $query = "SELECT a.`is_correct` FROM `results` AS r
                            INNER JOIN `answer_options` AS a
                                ON r.`answer_option_id`=a.`id`
                            WHERE r.`user_id`={$u_row['id']};";
                        
                        $r_result = mysqli_query($db, $query);

                        for($i = 0; $i < $q_count; $i++) {
                            $r_row = mysqli_fetch_assoc($r_result) or $r_row = array('is_correct' => "N/A");
                            echo("<td>{$r_row['is_correct']}</td>");
                        }

                        echo("<td></td>");
                        echo("<td></td>");
                        echo("</tr>");
                    }
                ?>
            </table>
            

            <?php
        }

        if(isStudent()) {
            $query = "SELECT r.`user_id`, a.`is_correct`  FROM `results` AS r
                INNER JOIN `answer_options` AS a
                    ON r.`answer_option_id`=a.`id`
                INNER JOIN `questions` AS q
                    ON a.`question_id`=q.`id`
                INNER JOIN `tests` AS t
                    ON q.`test_id`=t.`id`
                WHERE r.`user_id`={$_SESSION['user_id']} AND t.`id`={$_GET['t']};";
            
            $result = mysqli_query($db, $query) or die("error");

            $total = mysqli_num_rows($result);
            $correct = 0;

            while($row = mysqli_fetch_assoc($result)) {
                if($row['is_correct']) {
                    $correct++;
                }
            }

            echo($correct."/".$total);
        }

    ?>

</main>    
</body>
</html>

