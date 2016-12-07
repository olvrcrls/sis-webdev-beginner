<?php
	require("config.php");
	include_once('class.utility.php');
	
	$r = new Registrar();
	Class Registrar{
		
		private $conn;
		function __construct(){
			
			$this->conn = mysqli_connect(db_server,db_user,db_password,db_database);
			
		}
		
		function __destruct(){
			mysqli_close($this->conn);
		}
		
		
		public function createStudent($fname,$mname,$lname,$bdate,$address, $gender,$contact,$email){
			$obj = new Utility();
			$sn = $_SESSION['ret']; 
			
			if(empty($fname) || empty($lname) || empty($bdate) || empty($gender)||
				 empty($email)){
					 $obj->msg('Fill in all input fields.');
					 return false;
				 }
			if(strlen(trim($fname)) <= 0 || strlen(trim($lname)) <= 0 || strlen(trim($address)) <= 0
				|| strlen(trim($email)) <= 0){
					$obj->msg('Some are invalid in input fields.');
					return false;
				}
			
			$bdate = $obj->cleanString($bdate);
			$fname = $obj->cleanString($fname);
			$mname = $obj->cleanString($mname);
			$lname = $obj->cleanString($lname);
			$bdate = $obj->dateFormat($bdate);
			$address = $obj->cleanString($address);
			$gender = $obj->cleanString($gender);
			
			$contact = $obj->cleanString($contact);
			$email = $obj->cleanString($email);
			
			$fname = $this->sanitize($fname);
			$mname = $this->sanitize($mname);
			$lname = $this->sanitize($lname);
			
			$bdate = $this->sanitize($bdate);
			$address = $this->sanitize($address);
			$gender = $this->sanitize($gender);
			
			$contact = $this->sanitize($contact);
			$email = $this->sanitize($email);
			
			$prepareSQL = "INSERT INTO tblStudent(student_number, student_fname, student_mname, student_lname,
				student_gender, student_address, student_contact, student_email, student_birthdate) 
				VALUES(?,?,?,?,?,?,?,?,?)";
				
			$callSQL = "CALL createAccount(?,?,?,?)"; $type = "STUDENT";
			$password = $obj->generatePassword();
			$stmt = mysqli_prepare($this->conn,$prepareSQL);
			$call = mysqli_prepare($this->conn,$callSQL);
			mysqli_stmt_bind_param($stmt,'sssssssss',$sn,$fname,$mname,$lname,$gender,$address,$contact,$email,$bdate);
			mysqli_stmt_bind_param($call,'ssss',$sn,$password,$type,$email);
			
			
			
			if(!mysqli_stmt_execute($stmt)){
				$obj->msg('Student record already exist.');
				mysqli_stmt_close($stmt);
				return false;
			}
			
			if(!mysqli_stmt_execute($call)){
				$obj->msg('Cannot insert new student account.');
				mysqli_stmt_close($stmt);
				return false;
			}
			mysqli_stmt_close($stmt);
			$obj->msg('Successfully inserted student record.');
			return true;
			
		}// insert new student profile.
		
		
		public function createFaculty($fname,$mname,$lname,$bdate,$address,$gender,$contact,$email,$dept){
			$obj = new Utility();
			if(empty($fname) || empty($lname) || empty($bdate) || empty($gender)||
			empty($email)){
				$obj->msg('Fill in all input fields.');
				return false;
			}
			
			if(strlen(trim($fname)) <= 0 || strlen(trim($lname)) <= 0 || strlen(trim($address)) <= 0
			|| strlen(trim($email)) <= 0){
				$obj->msg('Some are invalid in input fields.');
				return false;
			}
			
			$bdate = $obj->cleanString($bdate);
			$fname = $obj->cleanString($fname);
			$mname = $obj->cleanString($mname);
			$lname = $obj->cleanString($lname);
			$bdate = $obj->dateFormat($bdate);
			$address = $obj->cleanString($address);
			$gender = $obj->cleanString($gender);
			
			$contact = $obj->cleanString($contact);
			$email = $obj->cleanString($email);
			
			$fname = $this->sanitize($fname);
			$mname = $this->sanitize($mname);
			$lname = $this->sanitize($lname);
			$dept = $this->sanitize($dept);
			$bdate = $this->sanitize($bdate);
			$address = $this->sanitize($address);
			$gender = $this->sanitize($gender);
			
			$contact = $this->sanitize($contact);
			$email = $this->sanitize($email);
			$fno = $_SESSION['fac'];	
			$type = "FACULTY"; $status = "ACTIVE";
			$password = $obj->generatePassword();
			$accountSQL = "CALL createAccount(?,?,?,?)";
			$prepareSQL = "INSERT INTO tblFaculty(faculty_number,faculty_fname,faculty_mname,faculty_lname,faculty_birthdate,faculty_address,
							faculty_gender, faculty_contact, faculty_email,faculty_status) VALUES (?,?,?,?,?,?,?,?,?,?)";
			$deptSQL = "INSERT INTO tbldepartmentfaculty(department_name,faculty_number) VALUES (?,?)";
			
			$stmt = mysqli_prepare($this->conn,$prepareSQL);
			$stmtdept = mysqli_prepare($this->conn,$deptSQL);
			$account = mysqli_prepare($this->conn,$accountSQL);
			
			mysqli_stmt_bind_param($stmt,'ssssssssss',$fno,$fname,$mname,$lname,$bdate,$address,$gender,$contact,$email,$status);
			mysqli_stmt_bind_param($stmtdept,'ss',$dept,$fno);
			mysqli_stmt_bind_param($account,'ssss',$fno,$password,$type,$email);
			
			if(!mysqli_stmt_execute($stmt)){
					$obj->msg("Faculty record already exist.");
					mysqli_stmt_close($stmt);
					return false;
			}
			
			
			
			if(!mysqli_stmt_execute($account)){
				$obj->msg("Cannot create user account.");
				mysqli_stmt_close($account);
				return false;
			}
			
			if(!mysqli_stmt_execute($stmtdept)){
				$obj->msg("Faculty record already assigned.");
				mysqli_stmt_close($stmtdept);
				return false;
			}
			
			mysqli_stmt_close($stmt);
			mysqli_stmt_close($account);
			mysqli_stmt_close($stmtdept);
			$obj->msg("Successfully created.");
			return true;
		}//insert new faculty profile
		
		
		public function createSubject($name){
				$obj = new Utility();
				
				if(empty($name)){
						$obj->msg("Input subject name.");
						return false;
				}
				
				if(strlen(trim($name)) <= 0){
						$obj->msg("Invalid subject name.");
						return false;
				}

				$name = $obj->cleanString($name);
				$name = $this->sanitize($name);
				
				$insertSQL = "INSERT INTO tblsubject(subject_name) VALUES (?)";
				$stmt = mysqli_prepare($this->conn,$insertSQL);
				mysqli_stmt_bind_param($stmt,'s',$name);
				
				if(!mysqli_stmt_execute($stmt)){
						$obj->msg("Subject name already exist.");
						return false;
				}
				
				$obj->msg("Successfully added.");
				
				return true;
					
		}//insert new subject
		
		
		
		public function editStudent($sno,$lname,$contact,$address,$email,$ys){
			$obj = new Utility();
			$sno = $obj->cleanString($sno);
			$lname = $obj->cleanString($lname);
			$contact = $obj->cleanString($contact);
			$address = $obj->cleanString($address);
			$email = $obj->cleanString($email);
			$ys = $obj->cleanString($ys);
			
			$sno = $this->sanitize($sno);
			$lname = $this->sanitize($lname);
			$contact = $this->sanitize($contact);
			$address = $this->sanitize($address);
			$email = $this->sanitize($email);
			$ys = $this->sanitize($ys);
			
			
			if(empty($sno) && empty($lname) && empty($contact) && empty($address) && empty($email) && empty($ys)){
					$obj->msg("Invalid input.");
					return false;
			}
			
			if(strlen(trim($sno)) <= 0 || strlen(trim($lname)) <= 0 ||
				strlen(trim($address)) <= 0 || strlen(trim($email)) <= 0 || strlen(trim($ys)) <= 0 ){
						$obj->msg("Invalid input.");
						return false;
				}
				
			$updateSQL = "UPDATE tblStudent SET student_lname = '" .$lname. "', student_contact = '" .$contact. "' , student_email = '" .$email.
							"' ,student_address = '" .$address. "' WHERE student_number = '" .$sno. "'";
			$updateStudentLevel = "UPDATE tblStudentLevel SET studentlevel_ys = " .$ys. " WHERE studentlevel_student = '".$sno."'";
			$resultUpdate = mysqli_query($this->conn,$updateSQL);
			$resultUpdateStudentLevel = mysqli_query($this->conn,$updateStudentLevel);
			
			if(!$resultUpdate || !$resultUpdateStudentLevel){
					$obj->msg("Cannot update student record.");
					echo mysqli_error($this->conn);
					return false;
			}
				$obj->msg("Successfully updated.");
				return true;
				
		}//editStudent
		
		public function editFaculty($fno,$lname,$contact,$address,$email,$dept){
			$obj = new Utility();
			$fno = $obj->cleanString($fno);
			$lname = $obj->cleanString($lname);
			$contact = $obj->cleanString($contact);
			$address = $obj->cleanString($address);
			$email = $obj->cleanString($email);
			$dept = $obj->cleanString($dept);
			
			$fno = $this->sanitize($fno);
			$lname = $this->sanitize($lname);
			$contact = $this->sanitize($contact);
			$address = $this->sanitize($address);
			$email = $this->sanitize($email);
			$dept = $this->sanitize($dept);
			
			if(empty($fno) && empty($lname) && empty($contact) && empty($address) && empty($email) && empty($dept)){
				$obj->msg("Invalid input.");
				return false;
			}
			
			if(empty($_POST['efaculty_department'])){
					$obj->msg("Department is not set.");
					return false;
			}
			
			if(strlen(trim($fno)) <= 0 || strlen(trim($lname)) <= 0 ||
			strlen(trim($address)) <= 0 || strlen(trim($email)) <= 0 || strlen(trim($dept)) <= 0 ){
				$obj->msg("Invalid input.");
				return false;
			}
			
			$updateSQL = "UPDATE tblFaculty set faculty_lname = '$lname', faculty_email = '$email', faculty_address = '$address',
							faculty_contact = '$contact' WHERE faculty_number = '$fno'";
			$deptUpdate = "UPDATE tbldepartmentfaculty set department_name = '$dept' WHERE faculty_number = '$fno'";
			
			$resultUpdate = mysqli_query($this->conn,$updateSQL);
			$deptUpdate = mysqli_query($this->conn,$deptUpdate);
			
			if(!$resultUpdate || !$deptUpdate){
					$obj->msg("Cannot update faculty record.");
					return false;
			}
			
			$obj->msg("Successfully updated record.");
			return true;
		}
		
		public function createDepartment($name){
				$obj = new Utility();				
				if((strlen(trim($name)) <= 0) ){
						$obj->msg("Invalid input");
						return false;
				}

				$name = $obj->cleanString($name);
				$name = $this->sanitize($name);
				
				$insertSQL = "INSERT INTO tblDepartment(department_name) VALUES (?)";
				$stmt = mysqli_prepare($this->conn,$insertSQL);
				mysqli_stmt_bind_param($stmt,'s',$name);
				if(!mysqli_stmt_execute($stmt)){
						$obj->msg("Department record already exist.");
						mysqli_stmt_close($stmt);
						return false;
				}
				$obj->msg("Successfully added.");
				mysqli_stmt_close($stmt);
				return true;
		}//create department
		
		
		public function createYear($name){
			$obj = new Utility();
			if((strlen(trim($name)) <= 0) ){
						$obj->msg("Invalid input");
						return false;
				}
			
			$name = $obj->cleanString($name);
			$name = $this->sanitize($name);
			
			$insertSQL = "INSERT INTO tblyear(year_name) VALUES (?)";
			$stmt = mysqli_prepare($this->conn,$insertSQL);
			mysqli_stmt_bind_param($stmt,'s',$name);
			if(!mysqli_stmt_execute($stmt)){
				$obj->msg("Year level record already exist.");
				mysqli_stmt_close($stmt);
				return false;
			}
			$obj->msg("Successfully added.");
			mysqli_stmt_close($stmt);
			return true;
		}//create year
		
		public function createSection($name){
			$obj = new Utility();
			if((strlen(trim($name)) <= 0) ){
						$obj->msg("Invalid input");
						return false;
				}
			
			$name = $obj->cleanString($name);
			$name = $this->sanitize($name);
			
			$insertSQL = "INSERT INTO tblsection(section_name) VALUES (?)";
			$stmt = mysqli_prepare($this->conn,$insertSQL);
			mysqli_stmt_bind_param($stmt,'s',$name);
			if(!mysqli_stmt_execute($stmt)){
				$obj->msg("Section record already exist.");
				mysqli_stmt_close($stmt);
				return false;
			}
			$obj->msg("Successfully added.");
			mysqli_stmt_close($stmt);
			return true;
		}//create section
		
		public function createYearSection($year,$section){
				$obj = new Utility();
				if(empty($year) || empty($section)){
						$obj->msg("Invalid input");
						return false;
				}
			
				$year = $obj->cleanString($year);
				$section = $obj->cleanString($section);
				
				$year = $this->sanitize($year);
				$section = $this->sanitize($section);
				
				$insertSQL = "INSERT INTO tblyearsection(year_name,section_name) VALUES (?,?)";
				$stmt = mysqli_prepare($this->conn,$insertSQL);
				mysqli_stmt_bind_param($stmt,'ss',$year,$section);
				if(!mysqli_stmt_execute($stmt)){
				$obj->msg("Year level and Section record is already assigned.");
				mysqli_stmt_close($stmt);
				return false;
			}
				$obj->msg("Successfully added.");
				mysqli_stmt_close($stmt);
				return true;
		}
		
		
		public function assignSubjectYear($subject,$year){
				
				$obj = new Utility();
				
				if(empty($subject) || empty($year)){
						
						$obj->msg("Input all fields.");
						return false;
				}
				
				$subject = $obj->cleanString($subject);
				$year = $obj->cleanString($year);
				
				$subject = $this->sanitize($subject);
				$year = $this->sanitize($year);
				
				
				$insertSQL = "INSERT INTO tblyearsubject(subject_name,year_name) VALUES (?,?)";
				$stmt = mysqli_prepare($this->conn,$insertSQL);
				
				mysqli_stmt_bind_param($stmt,'ss',$subject,$year);
				if(!mysqli_stmt_execute($stmt)){
						
						mysqli_stmt_close($stmt);
						$obj->msg("Assigning of that subject to the year level already assigned.");
						return false;
				}
				
				
						mysqli_stmt_close($stmt);
						$obj->msg("Successfully assigned.");;
				
				
				return true;
				
				
		}
		
		
		public function reenrollStudent($sno,$ys){
				
				$obj = new Utility();
				
				if(empty($sno) || empty($ys)){
						$obj->msg("Select a student or year and section level.");
						return false;
				}
				
				$sno = $obj->cleanString($sno);
				$ys = $obj->cleanString($ys);
				
				$sno = $this->sanitize($sno);
				$ys = $this->sanitize($ys);
				$status = "ACTIVE";
				$curr_year = Date("Y");
				$next_year = $curr_year+1;
				$acadyear = $curr_year."-".$next_year;
				
				
				$updateSQL = "UPDATE tblStudent SET student_status = '" .$status. "' WHERE student_number = '" .$sno. "'";
				$updateResult = mysqli_query($this->conn,$updateSQL);
				
				if(!$updateResult){
						$obj->msg("Cannot re-enroll student.");
						echo mysqli_error($this->conn);
						return false;
				}
				
				
				$insertSQL = "INSERT INTO tblStudentLevel(studentlevel_student,studentlevel_ys,studentlevel_acadyear) VALUES (?,?,?)";
				$stmt = mysqli_prepare($this->conn,$insertSQL);
				mysqli_stmt_bind_param($stmt,'sds',$sno,$ys,$acadyear);
				
				if(!mysqli_stmt_execute($stmt)){
						$obj->msg("The student is already re-enrolled.");
						mysqli_stmt_close($stmt);
						return false;
				}
				
				mysqli_stmt_close($stmt);
				$obj->msg("Successfully re-enrolled student.");
				return true;
		}//enroll student
		
		
		
		public function assignFacultySubject($faculty,$subject){
				
				$obj = new Utility();
				
				if(empty($faculty) || empty($subject)){
						$obj->msg("Select all fields.");
						return false;
				}
				
				$status = "ACTIVE";
				
				$faculty = $obj->cleanString($faculty);
				$subject = $obj->cleanString($subject);
				
				$faculty = $this->sanitize($faculty);
				$subject = $this->sanitize($subject);
				
				$insertSQL = "CALL assignFacultySubject(?,?,?)";
				$stmt = mysqli_prepare($this->conn,$insertSQL);
				
				mysqli_stmt_bind_param($stmt,'sss',$faculty,$subject,$status);
				
				if(!mysqli_stmt_execute($stmt)){
						$obj->msg("Faculty is already assigned to that subject.");
						return false;
				}
				
				
				$obj->msg("Successfully assigned.");
				return true;
				
				
		}
		
		
		
	
		public function createStudentLevel($sno,$ys){
				$obj = new Utility();
				if(empty($sno) || empty($ys)){
						$obj->msg("Select input fields.");
						return false;
				}
				$insertSQL = "INSERT into tblstudentlevel(studentlevel_student, studentlevel_ys, 
studentlevel_acadyear) VALUES (?,?,?)";
				$curr_year = Date("Y");
				$next_year = $curr_year + 1;
				$acadyear = $curr_year."-".$next_year;
				$sno = $obj->cleanString($sno);
				$ys = $obj->cleanString($ys);
				$sno = $this->sanitize($sno);
				$ys = $this->sanitize($ys);
				
				$stmt = mysqli_prepare($this->conn,$insertSQL);
				mysqli_stmt_bind_param($stmt,'sds',$sno,$ys,$acadyear);
				
				if(!mysqli_stmt_execute($stmt)){
						$obj->msg("Cannot assign that student to year level and section.");
						mysqli_stmt_close($stmt);
						echo mysqli_error($this->conn);
						return false;
				}
				$obj->msg("Successfully assigned student.");
				mysqli_stmt_close($stmt);
				return true;
		}
		
		
		public function enrollStudent($studentlevel,$facultysubject){
				
				$obj=new Utility();
				if(empty($studentlevel) || empty($facultysubject)){
						
						$obj->msg("Select all information.");
						return false;
				}
				
				$studentlevel = $obj->cleanString($studentlevel);
				$facultysubject = $obj->cleanString($facultysubject);
				
				$facultysubject = $this->sanitize($facultysubject);
				$studentlevel = $this->sanitize($studentlevel);
				
				$curr = Date("Y");
				$next = $curr+1;
				$acadyear = $curr."-".$next;
				
				$selectSQL = "SELECT studentlevel_student from tblstudentlevel where studentlevel_id = " .$studentlevel;
				$sno = mysqli_query($this->conn,$selectSQL);
				$student_number = mysqli_fetch_array($sno);
				
				$selectSubject = "SELECT subject_name FROM tblfacultysubject WHERE fs_id = " .$facultysubject;
				$sub = mysqli_query($this->conn,$selectSubject);
				$subject_name = mysqli_fetch_array($sub);
				
				$id = $acadyear."-".$student_number['studentlevel_student']."-".$subject_name['subject_name'];
				
				$insertSQL = "INSERT INTO tblenrollment(enrollment_id,enrollment_student,enrollment_subject,enrollment_acadyear)
								VALUES(?,?,?,?)";
				$stmt = mysqli_prepare($this->conn,$insertSQL);
				mysqli_stmt_bind_param($stmt,'sdds',$id,$studentlevel,$facultysubject,$acadyear);
				
				if(!mysqli_stmt_execute($stmt)){
						$obj->msg("Student is already enrolled to that subject this AC: ".$acadyear);
						mysqli_stmt_close($stmt);
						return false;
				}
				
				mysqli_stmt_close($stmt);
				$obj->msg("Successfully enrolled student.");
				return true;
				
		}
		
		
		
		
		public function displayStudent(){
			$obj = new Utility();
			$selectSQL = "SELECT student_number, student_fname, student_lname, student_mname, student_status FROM tblStudent";
			$result = mysqli_query($this->conn,$selectSQL);
			
			while($rs = mysqli_fetch_array($result)){
				$name = $obj->getFullName($rs['student_fname'],$rs['student_mname'],$rs['student_lname']);
				echo "<tr>
						<td>" .$rs['student_number']. "</td>
						<td>" .$name. "</td>
						<td>" .$rs['student_status']. "</td>
						</tr>";
			}
		
		}
		
		public function displayFaculty(){
			$obj = new Utility();
			$selectSQL = "select tblFaculty.faculty_number, faculty_status, faculty_fname, faculty_mname, faculty_lname, department_name from tblFaculty
							inner join tbldepartmentfaculty on tblFaculty.faculty_number = tbldepartmentfaculty.faculty_number";
			$result = mysqli_query($this->conn,$selectSQL);
			
			while($rs = mysqli_fetch_array($result)){
				$name = $obj->getFullName($rs['faculty_fname'],$rs['faculty_mname'],$rs['faculty_lname']);
				echo "<tr>
						<td>" .$rs['faculty_number']. "</td>
						<td>" .$name. "</td>
						<td>" .$rs['department_name']. "</td>
						<td>" .$rs['faculty_status']. "</td>
						</tr>";
		
				}
		
		}
		
		public function displayDepartment(){
			$obj = new Utility();
			$selectDepartment = "SELECT department_name, department_id from tblDepartment";
			$resultDepartment = mysqli_query($this->conn,$selectDepartment);
			while($rsDepartment = mysqli_fetch_array($resultDepartment)){
			$selectFaculty = "SELECT count(faculty_number) counter FROM tbldepartmentfaculty WHERE department_name = '" .$rsDepartment['department_name']. "'";
			$resultFaculty = mysqli_query($this->conn,$selectFaculty);
			$rsFaculty = mysqli_fetch_array($resultFaculty);
			$count = $rsFaculty['counter'];
			echo 	"<tr>
						<td> " .$rsDepartment['department_id']. "</td>
						<td> " .$rsDepartment['department_name']. "</td>
						<td> " .$count. "</td>
					</tr>";
			
			}
		}
		
		
		public function displayEnrolled(){
				$obj = new Utility();
				$studentSQL = "SELECT student_number, student_fname, student_mname, student_lname, student_status
								FROM tblStudent";
				$result = mysqli_query($this->conn,$studentSQL);
				
				while($rs = mysqli_fetch_array($result)){
					$name = $obj->getFullName($rs['student_fname'],$rs['student_mname'],$rs['student_lname']);	
					$ysSQL = "select year_name, section_name from tblstudentlevel inner join tblyearsection on 
					studentlevel_ys = ys_id WHERE studentlevel_student = '" .$rs['student_number']. "'";
					$r = mysqli_query($this->conn,$ysSQL);
					$rss = mysqli_fetch_array($r);
					$ys = $rss['year_name']."-".$rss['section_name'];
						echo "<tr>
									<td>" .$rs['student_number']. "</td>
									<td>" .$name. "</td>
									<td>" .$ys. "</td>
									<td>" .$rs['student_status']. "</td>
								</tr>";
						
				}
				
				
				
				
		}
		
		
		public function selectFaculty(){
			$obj = new Utility();
			$selectSQL = "SELECT faculty_number, faculty_fname, faculty_lname, faculty_mname from tblFaculty";
			$result = mysqli_query($this->conn,$selectSQL);
			while($rs = mysqli_fetch_array($result)){
				$name = $obj->getFullName($rs['faculty_fname'],$rs['faculty_mname'],$rs['faculty_lname']);
				echo "<option value = " .$rs['faculty_number']. ">(" .$rs['faculty_number']. ") " .$name. "</option>";
			}
				
		}
		
		public function selectDepartment(){
				$selectSQL = "SELECT department_name FROM tblDepartment";
				$result = mysqli_query($this->conn,$selectSQL);
				while($rs = mysqli_fetch_array($result)){
					echo "<option value = '" .$rs['department_name']. "'> " .$rs['department_name']. "</option>";
				}
		}
		
		public function selectYear(){
			$selectSQL = "SELECT year_id, year_name FROM tblyear";
			$result = mysqli_query($this->conn,$selectSQL);
			
			while($rs = mysqli_fetch_array($result)){
				echo "<option value = " .$rs['year_name']. ">" .$rs['year_name']. "</option>";
			}
		}

		public function selectSection(){
			$selectSQL = "SELECT section_id, section_name FROM tblsection";
			$result = mysqli_query($this->conn,$selectSQL);
			
			while($rs = mysqli_fetch_array($result)){
				echo "<option value = " .$rs['section_name']. ">" .$rs['section_name']. "</option>";
			}	
		}

		
		public function selectYearSection(){
			$selectSQL = "SELECT ys_id, year_name, section_name FROM tblyearsection";
			$result = mysqli_query($this->conn,$selectSQL);
			
			while($rs = mysqli_fetch_array($result)){
				echo "<option value = " .$rs['ys_id']. ">" .$rs['year_name']."-".$rs['section_name']. "</option>";
			}
		}
		
		
		public function selectStudent(){
				$obj = new Utility();
				$selectSQL = "SELECT student_number, student_fname, student_lname, student_mname from tblStudent";
				$result = mysqli_query($this->conn,$selectSQL);
				while($rs = mysqli_fetch_array($result)){
						$name = $obj->getFullName($rs['student_fname'],$rs['student_mname'],$rs['student_lname']);
						echo "<option value = " .$rs['student_number']. ">(" .$rs['student_number']. ") " .$name. "</option>";
				}
		}
		
		public function selectEnrolledStudent(){
				
				$obj = new Utility();
			$selectSQL = "select student_number, student_fname, student_lname, student_mname, studentlevel_id from tblstudentlevel inner join tblstudent
							on student_number = studentlevel_student";
			$result = mysqli_query($this->conn,$selectSQL);
			while($rs = mysqli_fetch_array($result)){
						$name = $obj->getFullName($rs['student_fname'],$rs['student_mname'],$rs['student_lname']);
						echo "<option value = " .$rs['studentlevel_id']. ">(" .$rs['student_number']. ") " .$name. "</option>";
			}
		}
		
		
		public function selectAssignStudent(){
				$obj = new Utility();
				$selectSQL = "SELECT student_number, student_fname, student_lname, student_mname from tblStudent WHERE student_status = 'ACTIVE'";
				$result = mysqli_query($this->conn,$selectSQL);
				
				
				while($rs = mysqli_fetch_array($result)){
					$compareSQL = "SELECT studentlevel_student FROM tblstudentlevel WHERE studentlevel_student = '" .$rs['student_number']. "'";
					$compareResult = mysqli_query($this->conn,$compareSQL);
					if(!$compareResult || mysqli_num_rows($compareResult) <= 0){
							$name = $obj->getFullName($rs['student_fname'],$rs['student_mname'],$rs['student_lname']);
							echo "<option value = " .$rs['student_number']. ">(" .$rs['student_number']. ") " .$name. "</option>";
					}//if
				}
		}
		
		
		
		
		public function selectAssignInactive(){
			$obj = new Utility();
			$selectSQL = "SELECT student_number, student_fname, student_lname, student_mname from tblStudent WHERE student_status = 'INACTIVE'";
			$result = mysqli_query($this->conn,$selectSQL);
			
			
			while($rs = mysqli_fetch_array($result)){
				$compareSQL = "SELECT studentlevel_student FROM tblstudentlevel WHERE studentlevel_student = '" .$rs['student_number']. "'";
				$compareResult = mysqli_query($this->conn,$compareSQL);
				if(!$compareResult || mysqli_num_rows($compareResult) <= 0){
					$name = $obj->getFullName($rs['student_fname'],$rs['student_mname'],$rs['student_lname']);
					echo "<option value = " .$rs['student_number']. ">(" .$rs['student_number']. ") " .$name. "</option>";
				}//if
			}
				
				
		}
		
		
		
		public function selectSubject(){
				
				$selectSQL = "SELECT subject_name from tblsubject";
				$result = mysqli_query($this->conn,$selectSQL);
				while($rs = mysqli_fetch_array($result)){
						echo "<option value = " .$rs['subject_name']. ">" .$rs['subject_name']. "</option>";
				}	
		}
		
		
		public function selectEnrollSubject(){
				
				$selectSQL = "SELECT fs_id, subject_name from tblfacultysubject";
				$result = mysqli_query($this->conn,$selectSQL);
			while($rs = mysqli_fetch_array($result)){
				echo "<option value = " .$rs['fs_id']. ">(" .$rs['fs_id']. ")" .$rs['subject_name']. "</option>";
			}	
				
				
		}


		public function selectAcademicYear(){
				
				$selectSQL = "SELECT DISTINCT studentlevel_acadyear FROM tblstudentlevel";
				$result = mysqli_query($this->conn,$selectSQL);
				while($rs = mysqli_fetch_array($result)){
						
						echo "<option value = " .$rs['studentlevel_acadyear']. ">" .$rs['studentlevel_acadyear']. "</option>";
						
				}
		}
		
		
		private function sanitize($str){
			if(function_exists("mysqli_real_escape_string")){
				$ret = mysqli_real_escape_string($this->conn,$str);
			} else $ret = addslashes($str);
			
			return $ret;
			
		}
		
		public function displayStudentNumber(){
			$ret = $this->generateStudentNumber();
			$_SESSION['ret'] = $ret;
			return $ret;
		}
		
		
		private function generateStudentNumber($length = 5){
		$chars = "0123456789";
		$number = substr( str_shuffle( $chars ), 0, $length );
		$curr_year = Date('Y');
		$student_number = "SJNHS".'-'.$curr_year.'-'.$number;
		return $student_number;
		}
		
		public function displayFacultyNumber(){
				$ret = $this->generateFacultyNumber();
				$_SESSION['fac'] = $ret;
				return $ret;
		}
		
		private function generateFacultyNumber(){
				
				$sqlCount = "SELECT count(faculty_number) counter from tblFaculty";
				$result = mysqli_query($this->conn,$sqlCount);
				$rs = mysqli_fetch_array($result);
				$rs['counter'] += 1;
				if($rs['counter'] < 10){
						$fno = "FACULTY-0000".$rs['counter'];
				}
				else if($rs['counter'] >= 10 && $rs['counter'] < 100){
						$fno = "FACULTY-000".$rs['counter'];
				}
				
				else if($rs['counter'] >= 100 && $rs['counter'] < 1000){
						$fno = "FACULTY-00".$rs['counter'];
				}
				else{
						$fno = "FACULTY-0".$rs['counter'];
				}
				
				
				
				return $fno;
		}
		
		
	}//class registrar




?>