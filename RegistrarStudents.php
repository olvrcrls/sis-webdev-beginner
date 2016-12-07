<?php
	session_start();
	include_once('./include/class.utility.php');
	require_once('./include/class.registrar.php');
	
	if($_SESSION['log'] != true || $_SESSION['type'] != 'REGISTRAR'){
		$obj->redirect('login.php');
	}


?>
<?php

	if(isset($_POST['createStudentLevel'])){
			$r->createStudentLevel($_POST['astudent_number'],$_POST['ays']);
	}

	if(isset($_POST['editStudent']) && isset($_POST['estudent_level'])){
			$r->editStudent($_POST['estudent_number'],$_POST['estudent_lname'],$_POST['estudent_contact'],$_POST['estudent_address'],$_POST['estudent_email'],
				$_POST['estudent_level']);
	}
	
	if(isset($_POST['enrollStudent'])){
			$r->enrollStudent($_POST['enroll_student'],$_POST['enroll_subject']);
	}

?>



<!DOCTYPE html>
<html lang = 'en'>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/simple-sidebar.css" rel="stylesheet">
  
  
  <script src="js/jquery.js"></script>
  <script src = "js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src = "js/retrieveInfo.js"></script>
  <script src = "js/enroll.js"></script>

	
</head>

<body>


	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="RegistrarHome.php"><img src = "img/sjlogo.png" height = "85px" width = "100px" ></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style = "float:right;">
      <ul class="nav nav-pills">
        <li><a href="RegistrarHome.php">Home</a></li>
        <li class="active"class="active"><a href = "RegistrarStudents.php">Student</a></li> 
        <li><a href = "RegistrarFaculty.php">Faculty</a></li>
		<li><a href = "RegistrarMiscellaneous.php">Miscellaneous</a></li>
		<li><a href = "RegistrarReports.php">Reports</a></li>		
		<li><a href = "login.php">Log-Out</a></li>
      </ul>   
    </div>
  </div>
</nav>
	
<div id = "home">
	<div class="container" style = "float:left;">
  <h3>Student</h3>
  <ul class="nav nav-pills nav-stacked col-md-2" >
	<li class = "active"><a data-toggle="pill" href="#view">View Student Info</a></li>
    <li><a data-toggle="pill" href="#new">New Student Info</a></li>
    <li><a data-toggle="pill" href="#yns">Assign Year and Section</a></li>
	<li><a data-toggle="pill" href ="#enrollment">Enroll Student</a></li>
    <li><a data-toggle="pill" href="#editinfo">Edit Student Info</a></li>
  </ul>
<!--SIde navigation-->


<div class="tab-content">





	<div id = "view" class = "tab-pane fade in active">
		<h3>Enrolled Student Information</h3>
		<div class="col-md-10">
			<table class ="table table-bordered ">
				<thead>
					<tr>
						<th>Student Number</th>
						<th>Student Name</th>
						<th>Year and Section</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php $r->displayEnrolled(); ?>
				</tbody>
			</table>
		</div>
		
	</div>


	<div id = "enrollment" class = "tab-pane fade">
		<h3>Enroll Student</h3>
		<form class = "form-horizontal" align = "center" charset = "utf-8"
			action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>" method = "post">
		
			<fieldset>
				<div class = "form-group">
					<label class = "control-label col-sm-4" for = "enroll_student">Student Number:</label>
					<div class = "col-sm-4">
						<select class = "form-control" name = "enroll_student" id = "enroll_student">
							<option value = '' active>Select student</option>
							<?php $r->selectEnrolledStudent(); ?>
						</select>
					</div>
				</div>
				
				<div class = "form-group">
					<label class = "control-label col-sm-4" for = "enroll_studentname">Student Name:</label>
					<div class = "col-sm-4">
						<input class = "form-control" type = "text" disabled id = "enroll_studentname"/>
					</div>
				</div>
				
				<div class = "form-group">
					<label class = "control-label col-sm-4" for = "enroll_yearsection">Year & Section:</label>
					<div class = "col-sm-4">
						<input class = "form-control" type = "text" disabled id ="enroll_yearsection" />
					</div>
				</div>
				
				<div class = 'form-group'>
					<label class = "control-label col-sm-4" for = "enroll_subject">Enroll Subject</label>
					<div class = "col-sm-4">
						<select class = "form-control" id = "enroll_subject" name = "enroll_subject">
							<option value = '' active>Select subject</option>
							<?php $r->selectEnrollSubject(); ?>
						</select>
					</div>
				</div>
				
				<div class = "form-group">
					<label class = "control-label col-sm-4" for = "enroll_facultyname">Faculty-in-charge:</label>
					<div class = "col-sm-4">
						<input disabled type = "text" class = "form-control" id = "enroll_facultyname"/>
					</div>
				</div>
				
				<div class = "form-group">
					<button type = "submit" class = "control-label btn-success" name = "enrollStudent">Enroll</button>
					<button type = "reset" class = "control-label btn-danger" >Clear Fields</button>
				</div>
			</fieldset>
		</form>
		</div>
		
	
	
    <div id="new" class="tab-pane fade">
      <h3>New Student Info</h3>
      <form class = "form-horizontal" align = "center" charset = 'utf-8'
		action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>" method = "post">
		<fieldset>
		
		<div class="form-group">
				<label class="control-label col-sm-4" for="factcode">Student Number:</label>
					<div class="col-sm-3"> 
						<input type="text" class="form-control" id="factcode" disabled 
						 value = "<?php echo $r->displayStudentNumber(); ?>" 
						title = "Student number is randomly auto-generated."/>
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="firstname">First Name:</label>
					<div class="col-sm-3">
					<input type="text" class="form-control" id="firstname"placeholder="Enter First Name"
						name = 'student_fname' title = "Input student's first name" />
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="middlename">Middle Name:</label>
					<div class="col-sm-3"> 
						<input type="text" class="form-control" id="middle" placeholder="Enter Middle Name"
						 name = 'student_mname' title = "Input student's middle name"/>
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="lastname">Last Name:</label>
					<div class="col-sm-3"> 
						<input type="text" class="form-control" id="lastname" placeholder="Enter Last Name"
							name = 'student_lname' title = "Input student's last name"/>
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="birthday">Birthday:</label>
					<div class="col-sm-3"> 
						<input type="date" class="form-control" id="birthday" 
							name = 'student_birthdate' title = "Input student's birthdate"/>
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="student_gender">Gender:</label>
					<div class="col-sm-3"> 
						<div class="radio">
							<label><input type="radio" name="student_gender" value = "MALE">Male</label>
							<label><input type="radio" name="student_gender" value = "FEMALE">Female</label>	
						</div>
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="student_address">Home Address:</label>
					<div class="col-sm-5"> 
						<input type="text" class="form-control" id="student_address" name = 'student_address' 
						 title = "Input student's home address" />
					</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="contact">Contact:</label>
					<div class="col-sm-3"> 
						<input type="text" class="form-control" id="contact" name = 'student_contact' 
						 title = "Input student's contact number" pattern = "[0-9,+,-]{7,13}"/>
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="email">Email:</label>
					<div class="col-sm-3"> 
						<input type="email" class="form-control" id="email" name = 'student_email' 
						title = "Input student's email address" pattern = "[a-z0-9._%+-]+@[a-z]+\.[a-z]{2,3}$" />
					</div>
			</div>
			
			
			
			<div class="form-group">
				<button type = "submit" name = 'createStudent' class = "control-label btn-success" id = "submit">Submit</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			
		</fieldset>
	  </form>
    </div>
	
    <div id="yns" class="tab-pane fade">
     <h3>Assign Year and Section</h3>
	  <form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>"
		method = "post" charset = "utf-8">
		<fieldset>
			<div class="form-group">
				<label class="control-label col-sm-4" for="studcode">Student Number:</label>
					<div class="col-sm-4">
						<select class="form-control" id="studcode" name = "astudent_number">
							<option value = '' active>Select student</option>
							<?php $r->selectAssignStudent(); ?>
						</select>
					</div>
			</div>
			
	
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="yearandsection">Year and Section:</label>
					<div class="col-sm-4">
						<select class="form-control" id="yearandsection" name = "ays">
							<option value = '' active>Select Year & Section</option>
							<?php $r->selectYearSection(); ?>
						</select>
				</div>
			</div>
			
			
			<div class="form-group">
						<button name = "createStudentLevel" type = "submit" class = "control-label btn-success" id = "submit">Submit</button>
						<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
		</fieldset>
	</form>
</div>
			
    <div id="editinfo" class="tab-pane fade">
      <h3>Edit Student Info</h3>
       <form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>"
			method = "post" charset = "utf-8">
		<fieldset>
		
		<div class="form-group">
				<label class="control-label col-sm-4 " for="factcode">Student Code:</label>
					<div class="col-sm-4"> 
						<select id = "estudent_number" class = "form-control" name = "estudent_number">
							<option value = '' active>Select student</option>
							<?php $r->selectStudent(); ?>
						</select>
					</div>
					<div class = "col-sm-3">
						<button id = "btnRetrieve" type = "button" class = "form-control">Reset Details</button>
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="lastname">Last Name:</label>
					<div class="col-sm-4"> 
						<input name = "estudent_lname" type="text" class="form-control" id="elastname">
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="contact">Contact:</label>
					<div class="col-sm-4"> 
						<input name = "estudent_contact" type="text" class="form-control" id="econtact" >
					</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" for="address">Home Address:</label>
				<div class="col-sm-5"> 
					<input type="text" class="form-control" id="estudent_address" name = 'estudent_address' 
					title = "Input student's home address" id = "eaddress"/>
				</div>
			</div>
			

			
			<div class="form-group">
				<label class="control-label col-sm-4" for="email">Email:</label>
					<div class="col-sm-4"> 
						<input name = "estudent_email" type="email" class="form-control" id="eemail" >
					</div>
			</div>
			
			
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="yearandsection">Year and Section:</label>
					<div class="col-sm-4">
						<select name = "estudent_level" class="form-control" id="yearandsection">
							<option  value = '' active>Select Year & Section</option>
							<?php $r->selectYearSection(); ?>
						</select>
					</div>
			</div>
			
			<div class="form-group">
				<button name = "editStudent" type = "submit" class = "control-label btn-success" id = "submit">Update</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			
		</fieldset>
	  </form>
    </div>
	
</div>
</body>
</html>

<?php
	if(isset($_POST['createStudent'])){
		$r->createStudent($_POST['student_fname'], $_POST['student_mname'], $_POST['student_lname'],$_POST['student_birthdate'], $_POST['student_address'], $_POST['student_gender'], $_POST['student_contact'], $_POST['student_email']);
	}


?>
