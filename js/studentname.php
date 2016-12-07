<?php
	require_once("../include/config.php");
	include_once("../include/class.utility.php");
	header("Content-Type: text/xml");

	$sno = $_GET['student'];
	
	echo "<response>";
	$conn = mysqli_connect(db_server,db_user,db_password,db_database);
	$selectSQL = "SELECT student_fname,student_mname,student_lname FROM tblStudent WHERE student_number = '" .$sno. "'";
	$result = mysqli_query($conn,$selectSQL);
	$rs = mysqli_fetch_array($result);
	
	
	$name = $obj->getFullName($rs['student_fname'],$rs['student_mname'],$rs['student_lname']);
	echo "<name>";
	echo $name;
	echo "</name>";
	
	echo "</response>";
	mysqli_close($conn);
?>