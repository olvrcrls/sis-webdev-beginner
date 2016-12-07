<?php
		require("../include/config.php");
		include_once("../include/class.utility.php");

		header("Content-Type: text/xml");

		$subject = $_GET['subject'];
	
		echo "<response>";
		$conn = mysqli_connect(db_server,db_user,db_password,db_database);
		$selectSubject = "select faculty_fname,faculty_mname,faculty_lname from tblfaculty inner join
							tblfacultysubject on tblfaculty.faculty_number = tblfacultysubject.faculty_number WHERE fs_id = ".$subject;
		$subjectResult = mysqli_query($conn,$selectSubject);
		while($sr = mysqli_fetch_array($subjectResult)){
				$faculty = $obj->getFullName($sr['faculty_fname'],$sr['faculty_mname'],$sr['faculty_lname']);
				echo "<faculty>";
				echo $faculty;
				echo "</faculty>";
			}
			
		echo "</response>";
		mysqli_close($conn);


?>