<?php
	require("../finalsis/include/config.php");
	include_once("../include/class.utility.php");
	header("Content-Type: application/json");
	$ay = $_GET['ay'];
	$year = $_GET['year'];
	
	$ay = $obj->cleanString($ay);
	$year = $obj->cleanString($year);
	
	
	$conn = mysqli_connect(db_server,db_user,db_password,db_database);
	$ay = mysqli_real_escape_string($conn,$ay);
	$year = mysqli_real_escape_string($conn,$year);
	
	$selectSQL = "SELECT studentlevel_student, student_fname, student_mname, student_lname,
	section_name, student_status FROM tblstudentlevel inner join
	tblstudent on studentlevel_student = student_number inner join
	tblyearsection on studentlevel_ys = ys_id WHERE studentlevel_acadyear = '" .$ay."' AND year_name = '" .$year. "'";
	$result = mysqli_query($conn,$selectSQL);
	
	$data = array();
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