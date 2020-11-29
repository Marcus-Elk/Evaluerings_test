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
	
		if(!isset($_SESSION['user_id'])) {
			die('<a href="./login.php">Log in</a> to see see the test.');
		}

		if(!isset($_GET['t'])) {
			header("Location: ./view_test.php");
			die();
		}

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
			$query		= "SELECT `id`, `title`, `text` FROM `questions` WHERE `test_id`=$t_id ORDER BY `index`";
			$q_result	= mysqli_query($db, $query) or die(mysqli_error($db));
			
			$i = 0;
			while($q_row = mysqli_fetch_assoc($q_result)) {
				$i++;
				$q_id		= $q_row['id'];
				$q_title	= "Q$i: ".$q_row['title'];
				$q_text		= $q_row['text'];
		?>
		
		<div class="question" id="q<?=$q_id?>">
			<button class="question-toggle" type="button">
				<h2 class="question-title"><?= $q_title ?></h2>
				<h2 class="toggle-symbol">+</h2>
			</button>
			<div class="question-content">
				<p class="question-text"><?= $q_text ?></p>
				<ul class="answers">

					<?php
						$query		= "SELECT `text`, `index` FROM `answers` WHERE `question_id`=$q_id ORDER BY `index`;";
						$a_result	= mysqli_query($db, $query) or die(mysqli_error($db));

						while($a_row = mysqli_fetch_assoc($a_result)) {
							$a_index	= $a_row['index'];
							$a_text		= $a_row['text'];
					?>
					<li class="answer">
						<input type="radio" id="q<?=$q_id."a".$a_index?>" name="<?=$q_id?>" value="<?=$a_index?>"></input>
						<label class="answer-text" for="q<?=$q_id."a".$a_index?>"><?=$a_text?></label>
					</li>
					<?php
						}
					?>
				</ul>
			</div>
		</div>
		<?php
			}
		?>
	</div>

	<button class="submit-button" type="button">Submit answers</button>

</main>
</body>
</html>