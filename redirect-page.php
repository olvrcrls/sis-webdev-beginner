<?php
	session_start();
	require_once('./include/class.utility.php');

	if($_SESSION['type'] == 'ADMINISTRATOR'){
		$obj->redirect('Admin.php');
	}
	
	else if ($_SESSION['type'] == 'REGISTRAR'){
		$obj->redirect('RegistrarHome.php');
	}

	else if ($_SESSION['type'] == 'STUDENT'){
		$obj->redirect('StudentGrades.php');
	}

	else if ($_SESSION['type'] == 'FACULTY'){
		$obj->redirect('Faculty.php');
	}

	else{
	 $obj->redirect('login.php');
	}

?>