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
    $team_id = $test['team_id'];

    $query = "INSERT INTO `tests`(`title`, `team_id`) VALUES
    ('$t_title', $team_id);";

    $result = mysqli_query($db, $query) or die(json_encode(array(
        'result' => -1,
        'text' => mysqli_error($db)
    )));

    $t_id = mysqli_insert_id($db);

    for($i = 0; $i < count($test['questions']); $i++) {
        $question = $test['questions'][$i];

        $q_title    = mysqli_real_escape_string($db, htmlspecialchars($question['title']));
        $q_text     = mysqli_real_escape_string($db, htmlspecialchars($question['text']));
        $q_cai      = intval($question['correct_index']);
        
        $query = "INSERT INTO `questions`(`title`, `text`, `test_id`, `index`, `correct_answer_index`) VALUES
        ('$q_title', '$q_text', $t_id, $i, $q_cai);";
        
        $result = mysqli_query($db, $query) or die(json_encode(array('result' => -1)));

        $q_id = mysqli_insert_id($db);

        for($j = 0; $j < count($question['answers']); $j++) {
            $answer = $question['answers'][$j];
            $a_text = mysqli_real_escape_string($db, htmlspecialchars($answer['text']));

            $query = "INSERT INTO `answers`(`text`, `question_id`, `index`) VALUES
            ('$a_text', $q_id, $j);";
            
            $result = mysqli_query($db, $query) or die(json_encode(array('result' => -1)));
        }
    }

    die(json_encode(array(
        'result' => 0,  
        'id' => $t_id
    )));
    

?>
