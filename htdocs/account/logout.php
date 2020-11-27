<?php
	session_start();

	$theme = $_SESSION['theme'];

	foreach($_SESSION as $key => $value) {
		unset($_SESSION[$key]);
	}

	$_SESSION['theme'] = $theme;

	header("Location: ../index.php");
	die();
?>