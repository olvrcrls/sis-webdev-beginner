<?php
	require("../include/config.php");
	include_once("../include/class.utility.php");
	header("Content-Type: application/json");
	
	$ay = $_GET['ay'];
	$section = $_GET['section'];
	
	$ay = $obj->cleanString($ay);
	$section = $obj->cleanString($section);
	
	$conn = mysqli_connect(db_server,db_user,db_password,db_database);
	$ay = mysqli_real_escape_string($conn,$ay);
	$section = mysqli_real_escape_string($conn,$section);

	$selectSQL = "SELECT studentlevel_student, student_fname, student_mname, student_lname, student_status, section_name FROM tblstudentlevel
	inner join tblstudent on studentlevel_student = student_number inner join tblyearsection
	on studentlevel_ys = ys_id WHERE ys_id = " .$section;
	$data = array();
	$result = mysqli_query($conn,$selectSQL);
	while($rs = mysqli_fetch_array($result)){
			
			$name = $obj->getFullName($rs['student_fname'],$rs['student_mname'],$rs['student_lname']);
			$data[] = array(
				'sno' => $rs['studentlevel_student'],
				'name' => $name,
				'section' => $rs['section_name'],
				'status' => $rs['student_status']	
			);
	}
	
	mysqli_close($conn);
	
	echo json_encode($data);


?>