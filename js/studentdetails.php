<?php
	require_once("../include/config.php");
	header("Content-type: text/xml");
	echo '<?xml version = "1.0" encoding = "UTF-8" standalone = "yes" ?>';
	echo "<response>";
	$student = $_GET['student'];
	$selectSQL = "SELECT student_lname, student_contact, student_email, student_address from tblStudent WHERE student_number = '" .$student. "'";
	$conn = mysqli_connect(db_server,db_user,db_password,db_database);
	$result = mysqli_query($conn,$selectSQL);
	echo "<profile>";
	while($rs = mysqli_fetch_array($result)){
			echo "<lastname>" .$rs['student_lname']. "</lastname>";
			echo "<contact>" .$rs['student_contact']. "</contact>";
			echo "<email>" .$rs['student_email']. "</email>";
			echo "<address>" .$rs['student_address']. "</address>";
	}

	
	
	mysqli_close($conn);
	echo "</profile>";
	echo "</response>";
?>