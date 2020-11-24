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

        function resultRow($u_id, $u_username) {
            global $db;
            global $q_ids;
            global $q_cais;

            echo("<tr>");
                        
            echo("<td>$u_username</td>");
            
            $correct = 0;
            $total = count($q_ids);

            for ($i = 0; $i < count($q_ids); $i++) {
                $query = "SELECT `answer_index` FROM `results` WHERE `user_id`=$u_id AND `question_id`={$q_ids[$i]};";
                $r_result = mysqli_query($db, $query) or die(mysqli_error($db));

                echo("<td>");

                if(mysqli_num_rows($r_result) > 0) {
                    $ai = mysqli_fetch_row($r_result)[0];
                    
                    
                    if($ai++ == $q_cais[$i]) {
                        echo("<b class=\"correct\">$ai</b>");
                        $correct++;
                    } else {
                        echo("<b class=\"wrong\">$ai</b>");
                    }
                } else {
                    echo("<b class=\"wrong\">N/A</b>");
                }

                echo("</td>");
            }

            echo("<td>$correct/$total</td>");
            echo("<td>" . number_format($correct/$total*100, 2) . "%</td>");
            echo("</tr>");
        }


        function resultHeader() {
            global $db;
            global $q_idxs;

            ?>
            <tr>
                <th>Username</th>

                <?php
                    foreach ($q_idxs as $q_idx) {
                        $friendly_idx = $q_idx + 1;
                        echo("<th>Q$friendly_idx</th>");
                    }

                ?>

                <th>Total</th>
                <th>%</th>
            </tr>
            <?php
        }

        $t_id = $_GET['t'];

        $query = "SELECT `team_id` FROM `tests` WHERE `id`=$t_id;";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));

        $team_id = mysqli_fetch_row($result)[0];

        $query = "SELECT `id`, `index`, `correct_answer_index` FROM `questions` WHERE `test_id`=$t_id ORDER BY `index`;";
        $q_result = mysqli_query($db, $query) or die(mysqli_error($db));

        $q_ids = [];
        $q_idxs = [];
        $q_cais = [];

        while($q_row = mysqli_fetch_assoc($q_result)) {
            $friendly_idx = $q_row['index'] + 1;
            array_push($q_ids, intval($q_row['id']));
            array_push($q_idxs, intval($q_row['index']));
            array_push($q_cais, intval($q_row['correct_answer_index']));
        }

        if(isTeacher()) {

            ?>
            <table>
                <?php
                    resultHeader();

                    $query = "SELECT `id`, `username` FROM `users` WHERE `team_id`=$team_id;";
                    $u_result = mysqli_query($db, $query) or die(mysqli_error($db));

                    while($u_row = mysqli_fetch_assoc($u_result)) {
                        resultRow($u_row['id'], $u_row['username']);
                    }
                ?>
            </table>
            <?php
        }

        if(isStudent()) {
            ?>
            <table>
                <?php
                    resultHeader();
                    resultRow($_SESSION['user_id'], $_SESSION['username']);

                ?>

            </table>
            <?php
        }

    ?>

</main>    
</body>
</html>

