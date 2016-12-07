<?php
	require("../include/config.php");
	include_once("../include/class.utility.php");
	header("Content-Type: application/json");
	
	$department = $_GET['department'];
	$conn = mysqli_connect(db_server,db_user,db_password,db_database);
	
	$department = $obj->cleanString($department);
	$department = mysqli_real_escape_string($conn,$department);
	$selectSQL = "SELECT tbldepartmentfaculty.faculty_number as fno, faculty_fname, faculty_gender, faculty_mname, faculty_lname, faculty_status FROM tbldepartmentfaculty
	inner join tblfaculty on tbldepartmentfaculty.faculty_number = tblfaculty.faculty_number WHERE department_name = '" .$department. "'";
	$data = array();
	$result = mysqli_query($conn,$selectSQL);
	while($rs = mysqli_fetch_array($result)){
			$name = $obj->getFullName($rs['faculty_fname'],$rs['faculty_mname'],$rs['faculty_lname']);
			$data[] = array(
				'fno' => $rs['fno'],
				'name' => $name,
				'gender' => $rs['faculty_gender'],
				'status' => $rs['faculty_status']
			);
	}
	
	
	mysqli_close($conn);
	echo json_encode($data);

?>