
<?php require_once("./include/roles.php") ?>

<nav class="navbar">
	<link rel="stylesheet" href="./style/navbar.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
	<script src="./js/navbar.js" defer></script>

	<ul class="nav-list">
<?php if(isset($_SESSION['user_id'])): ?>

	<?php if(isStudent()): ?>
		<li class="nav-item">
			<a class="nav-link" href="view_test.php">
				<img class="nav-icon" src="./icon/view_test.svg">
				<span class="nav-text">See tests</span>
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
<?php endif;?>
		<li class="nav-item">
			<ul class="nav-list">

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

<!-- <?php
require_once("./include/roles.php");
if(isset($_SESSION['user_id'])) {
	echo("<ul>");
		echo("<li><a class=\"active\" href=\"./index.php\">Home</a></li>");
			if(isStudent()){
				echo("<li><a href=\"./view_test.php\">Check Available Test</a></li>");
			}
			if(isTeacher()){
				echo("<li><a href=\"./create_test.php\">Create Test</a></li>");
			}
			if(isAdmin()){
				echo("<li><a id = \"import\">Import Data</a></li>");
			}
		echo("<li><a href=\"./account/logout.php\">Log out</a></li>");
	echo("</ul>");
} else {
	echo("<ul>");
		echo("<li><a class=\"active\" href=\"./index.php\">Home</a></li>");
		echo("<li><a href=\"./login.php\">Log in</a></li>");
		echo("<li><a href=\"./signup.php\">Sign up</a></li>");
	echo("</ul>");
}
?> -->