<?php
    session_start();

    require_once("../include/db_connect.php");

    $data = json_decode($_POST['json'], TRUE);

    $t_id = $data['id'];
    $results = $data['results'];

    $query = "INSERT INTO `results`(`user_id`, `question_id`, `answer_index`) VALUES ";

    foreach ($results as $result) {
        $query .= "({$_SESSION['user_id']}, {$result['q_id']}, {$result['a_index']}),";
    }

    $query = substr($query, 0, -1);
    $query .= ";";

    mysqli_query($db, $query) or die(json_encode(array(
        'result' => -1
    )));
    
    die(json_encode(array('result' => 0)));
?>
