<?php require_once("./include/roles.php"); ?>
<script> var theme = <?= isset($_SESSION['theme']) ? "true" : "false"; ?>; </script>
<nav class="navbar">
	<link rel="stylesheet" href="./style/navbar.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
	<script src="./js/navbar.js" defer></script>

	<ul class="nav-list">

		<li class="nav-item">
			<a class="nav-link" id="logo-link" href="index.php">
				<span class="nav-text" id="logo-text"><b>Math Tests</b></span>
				<img class="nav-icon" id="logo-icon" src="./icon/logo.svg">
			</a>
		</li>

<?php if(isset($_SESSION['user_id'])): ?>

	<?php if(isStudent()): ?>
		<li class="nav-item">
			<a class="nav-link" href="view_test.php">
				<img class="nav-icon" src="./icon/view_test.svg">
				<span class="nav-text">Available tests</span>
			</a>
		</li>
	<?php endif;?>

	<?php if(isTeacher()): ?>
		<li class="nav-item">
			<a class="nav-link" href="create_test.php">
				<img class="nav-icon" src="./icon/create_test.svg">
				<span class="nav-text">Create test</span>
			</a>
		</li>
	<?php endif;?>

		<li class="nav-item">
			<a class="nav-link" href="view_result.php">
				<img class="nav-icon" src="./icon/scores.svg">
				<span class="nav-text">Results</span>
			</a>
		</li>

<?php endif;?>

		<li class="nav-item">
			<ul class="nav-list">
				<li class="nav-item">
					<a class="nav-link" id="theme-mode" href="#">
						<img class="nav-icon" src="./icon/login.svg">
						<span class="nav-text">Change theme</span>
					
					</a>
				</li>

<?php if(isset($_SESSION['user_id'])): ?>
				<li class="nav-item">
						<a class="nav-link" href="./account/logout.php">
							<img class="nav-icon" src="./icon/logout.svg">
							<span class="nav-text">Sign out</span>
						</a>
				</li>
<?php else: ?>
				<li class="nav-item">
					<a class="nav-link" href="login.php">
						<img class="nav-icon" src="./icon/login.svg">
						<span class="nav-text">Sign in</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="signup.php">
						<img class="nav-icon" src="./icon/create_account.svg">
						<span class="nav-text">Sign up</span>
					</a>
				</li>
<?php endif; ?>

			</ul>
		</li>
	</ul> 
</nav>
