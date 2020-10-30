
<?php
    session_start();

    require_once('../include/db_connect.php');
    require_once('../include/roles.php');

    $test = json_decode($_POST['json'], TRUE);

    if(!isTeacher()) {
        die(json_encode(array(
            'result' => -1,
            'text' => "bruh..."
        )));
    } 

    $t_title = mysqli_real_escape_string($db, $test['title']);
    //$team_id = $json['team_id'];

    $query = "INSERT INTO `tests`(`title`, `team_id`) VALUES(
        '$t_title', 1
    );";
    $result = mysqli_query($db, $query) or die(json_encode(array(
        'result' => -1,
        'text' => mysqli_error($db)
    )));

    $t_id = mysqli_insert_id($db);

    foreach($test['questions'] as $question) {

        $q_title = mysqli_real_escape_string($db, $question['title']);
        $q_text = mysqli_real_escape_string($db, $question['text']);
        
        $query = "INSERT INTO `questions`(`title`, `text`, `test_id`) VALUES(
            '$q_title', '$q_text', $t_id
        );";
        $result = mysqli_query($db, $query) or die(json_encode(array(
            'result' => -1,
            'text' => mysqli_error($db)
        )));

        $q_id = mysqli_insert_id($db);

        foreach($question['answers'] as $answer) {

            $a_text     = mysqli_real_escape_string($db, $answer['text']);
            $is_correct = $answer['is_correct'];

            $query = "INSERT INTO `answer_options`(`text`, `is_correct`, `question_id`) VALUES(
                '$a_text', $is_correct, $q_id
            );";
            $result = mysqli_query($db, $query) or die(json_encode(array(
                'result' => -1,
                'text' => mysqli_error($db)
            )));
        }
    }

    die(json_encode(array(
        'result' => 0,  
        'id' => $t_id
    )));
    

?>
