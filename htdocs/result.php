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
            $t_id = $_GET['t'];

            $query = "SELECT `team_id` FROM `tests` WHERE `id`=$t_id;";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));

            $team_id = mysqli_fetch_row($result)[0];

            $query = "SELECT `id`, `index`, `correct_answer_index` FROM `questions` WHERE `test_id`=$t_id ORDER BY `index`;";
            $q_result = mysqli_query($db, $query) or die(mysqli_error($db));

            $q_ids = [];
            $q_cais = [];
            
            ?>
            <table>
                <tr>
                    <th>Username</th>

                    <?php
                        while($q_row = mysqli_fetch_assoc($q_result)) {
                            $friendly_idx = $q_row['index'] + 1;
                            echo("<th>Q$friendly_idx</th>");
                            array_push($q_ids, intval($q_row['id']));
                            array_push($q_cais, intval($q_row['correct_answer_index']));
                        }

                        $query = "SELECT `id`, `username` FROM `users` WHERE `team_id`=$team_id;";
                        $u_result = mysqli_query($db, $query) or die(mysqli_error($db));
                    ?>

                    <th>Total</th>
                    <th>%</th>
                </tr>
                <?php
                    while($u_row = mysqli_fetch_assoc($u_result)) {
                        echo("<tr>");
                        echo("<td>{$u_row['username']}</td>");
                        
                        $correct = 0;
                        $total = count($q_ids);

                        for($i = 0; $i < $total; $i++) {
                            $query = "SELECT `answer_index` FROM `results` WHERE `user_id`={$u_row['id']} AND `question_id`={$q_ids[$i]};";
                            $r_result = mysqli_query($db, $query) or die(mysqli_error($db));

                            if(mysqli_num_rows($r_result) > 0) {
                                $ai = mysqli_fetch_row($r_result)[0];
                                
                                if($ai++ == $q_cais[$i]) {
                                    echo("<td class=\"correct\">$ai</td>");
                                    $correct++;
                                }else {
                                    echo("<td class=\"wrong\">$ai</td>");
                                }
                            }else {
                                echo("<td class=\"wrong\">N/A</td>");
                            }
                        }

                        echo("<td>$correct/$total</td>");
                        echo("<td>" . number_format($correct/$total*100, 2) . "%</td>");
                        echo("</tr>");
                    }
                ?>
            </table>
            

            <?php
        }

        if(isStudent()) {
            
        }

    ?>

</main>    
</body>
</html>

