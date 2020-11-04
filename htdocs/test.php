<?php
    session_start();

    require_once("./include/db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test</title>
	

</head>
<body>

	<?php
        $t_id = intval($_GET['t']);
        
        $query	= "SELECT `title`, `team_id` FROM `tests` WHERE `id`=$t_id;";
        $result	= mysqli_query($db, $query) or die(mysqli_error($db));
        $row	= mysqli_fetch_assoc($result);
		 
		$t_title	= $row['title'];
		$t_team_id	= $row['team_id'];

		if($t_team_id != $_SESSION['team_id']) {
			die("This test is not for you.");
		}

	?>

	<h1 class="test-title">
		<?= $t_title ?>
	</h1>
	
	<div id="questions">
		<?php
			$query		= "SELECT `id`, `title`, `text` FROM `questions` WHERE `test_id`=$t_id";
			$q_result	= mysqli_query($db, $query) or die(mysqli_error($db));

			while($q_row = mysqli_fetch_assoc($q_result)) {
				$q_id		= $q_row['id'];
				$q_title	= $q_row['title'];
				$q_text		= $q_row['text'];

		?>
		
		<div class="question">
			<h2 class="question-title"><?= $q_title ?></h2>
			<p class="question-text"><?= $q_text ?></p>
			<div class="answers">

				<?php
					$query		= "SELECT `text` FROM `answer_options` WHERE `question_id`=$q_id;";
					$a_result	= mysqli_query($db, $query) or die(mysqli_error($db));

					while($a_row = mysqli_fetch_assoc($a_result)) {
						$a_text	= $a_row['text'];
				?>
				<div class="answer">
					<p class="answer-text"><?= $a_text ?></p>
				</div>
				<?php
					}
				?>
			</div>
		</div>
		<?php
			}
		?>


	</div>


    
</body>
</html>