<?php
    session_start();

    require_once("./include/db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="./style/stylesheet.css">
	<link rel="stylesheet" href="./style/test.css">
	
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
	<script src="./js/load_mathjax.js" defer></script>
	<script src="./js/test.js" defer></script>

	<title>Test</title>
</head>
<body>
<?php include("./include/navbar.php"); ?>

<main>
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
			<button class="question-toggle" type="button">
				<h2 class="question-title"><?= $q_title ?></h2>
			</button>
			<div class="question-content">
				<p class="question-text"><?= $q_text ?></p>
				<div class="answers">

					<?php
						$query		= "SELECT `id`, `text` FROM `answer_options` WHERE `question_id`=$q_id;";
						$a_result	= mysqli_query($db, $query) or die(mysqli_error($db));

						while($a_row = mysqli_fetch_assoc($a_result)) {
							$a_id	= $a_row['id'];
							$a_text	= $a_row['text'];
					?>
					<div class="answer">
						<p class="answer-text"><?=$a_text?></p>
						<input type="radio" name="<?=$q_id?>" value="<?=$a_id?>"></input>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
		<?php
			}
		?>
	</div>

	<button type="button">Submit answers</button>

</main>
</body>
</html>