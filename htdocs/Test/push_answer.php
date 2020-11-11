

<?php
    session_start();

    require_once("../include/db_connect.php");

    $data = json_decode($_POST['json'], TRUE);

    $t_id = $data['id'];
    $a_ids = $data['answers'];

    $query = "SELECT t.`id` FROM `results` AS r
    INNER JOIN `answer_options` AS a
        ON r.`answer_option_id`=a.`id`
    INNER JOIN `questions` AS q
        ON a.`question_id`=q.`id`
    INNER JOIN `tests` as t
        ON q.`test_id`=t.`id`
    WHERE r.`user_id`={$_SESSION['user_id']} AND t.`id`=$t_id
    LIMIT 1;";

    $result = mysqli_query($db, $query) or die(json_encode(array('result' => -1)));

    if(mysqli_num_rows($result) > 0) {
        die(json_encode(array('result' => 1)));
    }

    $query = "SELECT `id` FROM `questions` WHERE `test_id`=$t_id;";
    $result = mysqli_query($db, $query) or die(json_encode(array('result' => -1)));

    $query = "INSERT INTO `results`(`answer_option_id`, `user_id`) VALUES ";

    while($q_row = mysqli_fetch_assoc($result)) {
        $query .= "({$a_ids[$i]}, {$_SESSION['user_id']}),";
    }

    $query = substr($query, 0, -1);
    $query .= ";";

    mysqli_query($db, $query) or die(json_encode(array('result' => -1)));
    
    die(json_encode(array('result' => 0)));
?>
