<?php

	class Roles {
		const STUDENT 	= 1<<0;
		const TEACHER 	= 1<<1;
		const ADMIN		= 1<<2;
	}

	function isStudent($roles) {
		return ($roles & Roles::STUDENT) > 0;
	}
	
	function isTeacher($roles) {
		return ($roles & Roles::TEACHER) > 0;
	}
	
	function isAdmin($roles) {
		return ($roles & Roles::ADMIN) > 0;
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