<?php
	require_once("../include/config.php");
	header("Content-type: text/xml");
	echo '<?xml version = "1.0" encoding = "UTF-8" standalone = "yes" ?>';
	echo "<response>";
	$faculty = $_GET['faculty'];
	$selectSQL = "SELECT faculty_lname, faculty_contact, faculty_email, faculty_address from tblFaculty WHERE faculty_number = '" .$faculty. "'";
	$conn = mysqli_connect(db_server,db_user,db_password,db_database);
	$result = mysqli_query($conn,$selectSQL);
	echo "<profile>";
	while($rs = mysqli_fetch_array($result)){
			echo "<lastname>" .$rs['faculty_lname']. "</lastname>";
			echo "<contact>" .$rs['faculty_contact']. "</contact>";
			echo "<email>" .$rs['faculty_email']. "</email>";
			echo "<address>" .$rs['faculty_address']. "</address>";
	}
	mysqli_close($conn);
	echo "</profile>";
	echo "</response>";
?>