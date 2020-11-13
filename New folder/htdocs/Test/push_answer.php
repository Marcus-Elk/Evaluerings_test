

<?php
    session_start();

    require_once("../include/db_connect.php");

    $data = json_decode($_POST['json'], TRUE);

    $a_ids = $data['answers'];

    $query = "INSERT INTO `results`(`answer_option_id`, `user_id`) VALUES ";

    foreach($a_ids as $a_id) {
        $query .= "($a_id, {$_SESSION['user_id']}),";
    }

    $query = substr($query, 0, -1);
    $query .= ";";

    mysqli_query($db, $query) or die(json_encode(array('result' => -1)));
    
    die(json_encode(array('result' => 0)));
?>
