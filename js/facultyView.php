<?php
	require("../include/config.php");
	include_once("../include/class.utility.php");
	session_start();
	
	
	$acadyear = $_GET['acadyear'];
	$fs = $_GET['fs'];
	$user = $_SESSION['user'];
	
	header("Content-Type: application/json");
	$conn = mysqli_connect(db_server,db_user,db_password,db_database);
	$data = array();
	
	$compareSQL = "SELECT enrollment_number from tblenrollment inner join tblstudentlevel on enrollment_student = studentlevel_id
	WHERE enrollment_subject = (SELECT fs_id FROM tblfacultysubject WHERE faculty_number = '".$user."' AND fs_id = ".$fs.") AND enrollment_acadyear = '".$acadyear."'";
	$result = mysqli_query($conn,$compareSQL);
	while($rs = mysqli_fetch_array($result)){
		$selectSQL = "SELECT student_number, student_fname, student_lname, student_mname, student_status FROM tblStudent inner join
		tblstudentlevel on student_number = studentlevel_student WHERE student_number = (SELECT studentlevel_student from tblenrollment inner join tblstudentlevel on enrollment_student = studentlevel_id
		WHERE enrollment_number = ".$rs['enrollment_number'].")";
		$compareResult = mysqli_query($conn,$selectSQL);
		while($crs = mysqli_fetch_array($compareResult)){
				$name = $obj->getFullName($crs['student_fname'],$crs['student_mname'],$crs['student_lname']);
				$data[] = array(
					'sno' => $crs['student_number'],
					'name' => $name,
					'status' => $crs['student_status']
				);
				
		}
			
			
	}
	
	
	mysqli_close($conn);
	echo json_encode($data);


?>