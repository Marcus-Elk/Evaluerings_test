<?php

	class Roles {
		const STUDENT 	= 1<<0;
		const TEACHER 	= 1<<1;
		const ADMIN		= 1<<2;
	}

	function isStudent() {
		return ($_SESSION['user_roles'] & Roles::STUDENT) > 0;
	}
	
	function isTeacher() {
		return ($_SESSION['user_roles'] & Roles::TEACHER) > 0;
	}
	
	function isAdmin() {
		return ($_SESSION['user_roles'] & Roles::ADMIN) > 0;
	}

	function makeStudent($roles = 0) {
		$roles |= Roles::STUDENT;
		return $roles;
	}

	function makeTeacher($roles = 0) {
		$roles |= Roles::TEACHER;
		return $roles;
	}

	function makeAdmin($roles = 0) {
		$roles |= Roles::ADMIN;
		return $roles;
	}


?>