<?php
	require("../include/config.php");
	include_once("../include/class.utility.php");
	
	header("Content-Type: text/xml");
	
	
	
	 $student = $_GET['student'];
	
	echo "<response>";
	$conn = mysqli_connect(db_server,db_user,db_password,db_database);
	$selectSQL = "select student_fname,student_lname,student_mname, year_name, section_name from tblstudentlevel inner join
	tblstudent on studentlevel_student = student_number inner join tblyearsection on studentlevel_ys = ys_id WHERE studentlevel_id = '" .$student. "'";
	$result = mysqli_query($conn,$selectSQL);
	while($rs = mysqli_fetch_array($result)){
			$name = $obj->getFullName($rs['student_fname'],$rs['student_mname'],$rs['student_lname']);
			$ys = $rs['year_name']."-".$rs['section_name'];
			echo "<name>";
			echo $name;
			echo "</name>";
			
			echo "<ys>";
			echo $ys;
			echo "</ys>";		
	}
	
	
	echo "</response>";
	mysqli_close($conn);
?>