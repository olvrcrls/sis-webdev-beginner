<?php
	require_once("../include/config.php");
	include_once("../include/class.utility.php");
	header("Content-Type: text/xml");

	
	$fno = $_GET['faculty'];
	
	echo "<response>";
	$conn = mysqli_connect(db_server,db_user,db_password,db_database);
	$selectFaculty = "SELECT faculty_fname,faculty_mname,faculty_lname FROM tblFaculty WHERE faculty_number = '" .$fno. "'";
	$resultFaculty = mysqli_query($conn,$selectFaculty);
	$rsFaculty = mysqli_fetch_array($resultFaculty);
	$faculty = $obj->getFullName($rsFaculty['faculty_fname'],$rsFaculty['faculty_mname'],$rsFaculty['faculty_lname']);
	
	echo "<faculty>";
	echo $faculty;
	echo "</faculty>";

	echo "</response>";
	mysqli_close($conn);
?>