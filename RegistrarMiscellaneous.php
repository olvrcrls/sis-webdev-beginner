<?php
	session_start();
	require("./include/class.registrar.php");
	include_once("./include/class.utility.php");
	
	if($_SESSION['log'] != true || $_SESSION['type'] != 'REGISTRAR'){
			$obj->redirect("login.php");}
?>


<?php
	if(isset($_POST['addDepartment'])){
			$r->createDepartment($_POST['adepartment_name']);}
	
	if(isset($_POST['addYear'])){
			$r->createYear($_POST['ayear']);
	}
	
	
	if(isset($_POST['addSection'])){
			$r->createSection($_POST['asection']);
	}
	
	if(isset($_POST['addYearSection'])){
			$r->createYearSection($_POST['ayear_level'],$_POST['asection_level']);
	}

	if(isset($_POST['editDepartment'])){
			$r->editDepartment($_POST['edepartment_name'],$_POST['edepartment_code']);
	}
	
	if(isset($_POST['addSubject'])){
			$r->createSubject($_POST['subject_name']);
	}

	
	if(isset($_POST['assignSubject'])){
			$r->assignSubjectYear($_POST['asubject_name'],$_POST['ayear_name']);
	}
	
	
	if(isset($_POST['reenrollStudent'])){
			$r->reenrollStudent($_POST['reenroll_studentnumber'], $_POST['reenroll_yearsection']);
	}
	
	
	if(isset($_POST['assignFacultySubject'])){
			$r->assignFacultySubject($_POST['facultysubject_faculty'],$_POST['facultysubject_subject']);
	}
	
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/simple-sidebar.css" rel="stylesheet">
  
  
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/retrieve.js"></script>

	
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
        <li ><a href="RegistrarHome.php">Home</a></li>
        <li><a href = "RegistrarStudents.php">Student</a></li> 
        <li><a href = "RegistrarFaculty.php">Faculty</a></li>
		<li class="active"><a href = "RegistrarMiscellaneous.php">Miscellaneous</a></li>
		<li><a href = "RegistrarReports.php">Reports</a></li>
		<li><a href = "login.php">Log-Out</a></li>
      </ul>   
    </div>
  </div>
</nav>
	
<div id = "home">
	<div class="container" style = "float:left;">
  <h3>Miscellaneous</h3>
  <ul class="nav nav-pills nav-stacked col-md-2" >
    <li class = "active"><a data-toggle = "pill" href="#department">Add Department</a></li>
    <li><a data-toggle="pill" href="#year">Add Year</a></li>
    <li><a data-toggle="pill" href="#section">Add Section</a></li>
    <li><a data-toggle="pill" href="#studentlevel">Add Student Level</a></li>
	<li><a data-toggle="pill" href="#addsubject">Add Subject</a></li>
	<li><a data-toggle="pill" href ="#assignsubject">Assign Subject to Year Level</a></li>
	<li><a data-toggle="pill" href="#enroll">Re-enroll Student</a></li>
	<li><a data-toggle="pill" href="#assignfaculty">Assign Faculty</a></li>
  </ul>
<!--SIde navigation-->


<div class="tab-content">
    <div id="department" class="tab-pane fade in active">
      <h3>Add Department</h3>
      
	  <form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>" 
		method = "post" charset = "utf-8">
		<fieldset>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="deptname">Department Name:</label>
					<div class="col-sm-5"> 
						<input type="text" class="form-control" id="deptname" placeholder="Enter Department Name"
							required name = "adepartment_name" />
					</div>
			</div>
			
			<div class="form-group">
				<button type = "submit" name = "addDepartment" class = "control-label btn-success" id = "submit">Save</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			
		</fieldset>
	  </form>
    </div>
	<!--End of Department-->
    <div id="year" class="tab-pane fade"> 
	
	
      <h3>Add Year</h3>
		<form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>" 
		method = "post" charset = "utf-8">
		<fieldset>
			<div class="form-group">
				<label class="control-label col-sm-4" for="yearcode">Year Code:</label>
					<div class="col-sm-3">
						<input class = "form-control" type = "text" name = "ayear" id = "yearcode" required />
					</div>
			</div>
			
			<div class="form-group">
				<button type = "submit" name = "addYear" class = "control-label btn-success" id = "submit">Save</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			
		</fieldset>
	  </form>
    </div>
   <!--End of Year-->
   <div id="section" class="tab-pane fade">
	<!--Section-->
      <h3>Add Section</h3>
	   <form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>" 
	   method = "post" charset = "utf-8">
		<fieldset>		
			<div class="form-group">
				<label class="control-label col-sm-4" for="sectionname">Section Name:</label>
					<div class="col-sm-3"> 
						<input type="text" name = "asection" class="form-control" id="sectionname" placeholder="Enter Section Name">
					</div>
			</div>
			
			<div class="form-group">
				<button type = "submit" name = "addSection" class = "control-label btn-success" id = "submit">Save</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			
		</fieldset>
	  </form>
    </div>
	<!--End of EditSection-->
    <div id="addsubject" class="tab-pane fade">
	<!--Section-->
      <h3>Add Subject</h3>
	   <form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>" 
	   method = "post" charset = "utf-8">
		<fieldset>		
			<div class="form-group">
				<label class="control-label col-sm-4" for="subject">Subject Name:</label>
					<div class="col-sm-4"> 
						<input name = "subject_name" type="text" name = "subject" class="form-control" id="subjectname" placeholder="Enter Subject Name">
					</div>
			</div>
			
			<div class="form-group">
				<button type = "submit" name = "addSubject" class = "control-label btn-success" id = "submit">Submit</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			
		</fieldset>
	  </form>
    </div>
	
	<div id="assignsubject" class="tab-pane fade">
		<!--Section-->
		<h3>Add Subject</h3>
		<form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>" 
		method = "post" charset = "utf-8">
			<fieldset>		
				<div class="form-group">
					<label class="control-label col-sm-4" for="subject">Subject:</label>
					<div class="col-sm-4"> 
						<select class = "form-control" name = "asubject_name">
							<option value = '' active>Select subject</option>
							<?php $r->selectSubject(); ?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-4" for="subject">Year Level:</label>
					<div class="col-sm-4"> 
						<select class = "form-control" name = "ayear_name">
							<option value = '' active>Select year level</option>
							<?php $r->selectYear(); ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<button type = "submit" name = "assignSubject" class = "control-label btn-success" id = "submit">Submit</button>
					<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
				</div>
				
			</fieldset>
		</form>
    </div>
	
	
	
	  <div id="enroll" class="tab-pane fade">
	<!--Section-->
      <h3>Re-enroll Student</h3>
	   <form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>" 
	   method = "post" charset = "utf-8">
		<fieldset>		
			<div class="form-group">
				<label class="control-label col-sm-4" for="studentcode">Student Code:</label>
					<div class="col-sm-4">
						<select class="form-control" id="reenroll_student" name = "reenroll_studentnumber">
								<option value = '' active>Select student</option>
								<?php $r->selectAssignInactive();?>
						</select>
							
					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="studentcode">Student Name:</label>
					<div class="col-sm-4">
						
							<input type="text" class="form-control" id="studentname" disabled >
					
							
					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="sectioncode">Section Code:</label>
					<div class="col-sm-4">
					<select class="form-control" id="subjectcode" name = "reenroll_yearsection">
						<option value = '' active>Select section</option>
						<?php $r->selectYearSection(); ?>
					</select>
							
					</div>
			</div>
			
			
			
			
			<div class="form-group">
				<button type = "submit" name = "reenrollStudent" class = "control-label btn-success" id = "submit">Submit</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			
		</fieldset>
	  </form>
    </div>
	
		  <div id="assignfaculty" class="tab-pane fade">
	<!--Section-->
      <h3>Assign Faculty to Subject(s)</h3>
	   <form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>" 
	   method = "post" charset = "utf-8">
		<fieldset>		
			<div class="form-group">
				<label class="control-label col-sm-4" for="facultycode">Faculty Code:</label>
					<div class="col-sm-4">
						<select name = "facultysubject_faculty" class="form-control" id="assign_faculty">
							<option value = '' active>Select faculty</option>
							<?php $r->selectFaculty(); ?>
						</select>
							
					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="facultyname">Faculty Name:</label>
					<div class="col-sm-4">
						
							<input type="text" class="form-control" id="facultyname" disabled >
					
							
					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="subjectcode">Subject Name:</label>
					<div class="col-sm-4">
					<select name = "facultysubject_subject" class="form-control" id="subjectcode">
								<option value = '' active>Select subject</option>
								<?php $r->selectSubject(); ?>
					</select>
							
					</div>
			</div>
			
			
			
			
			
			<div class="form-group">
				<button type = "submit" name = "assignFacultySubject" class = "control-label btn-success" id = "submit">Assign</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			
		</fieldset>
	  </form>
    </div>
	</div>
	<div id="studentlevel" class="tab-pane fade">
	
	
      <h3>Add Student Level</h3>
		<form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>" 
		method = "post" charset = "utf-8">
		<fieldset>
			<div class="form-group">
				<label class="control-label col-sm-4" for="levelcode">Year Code:</label>
					<div class="col-sm-3">
						<select class = "form-control" name = "ayear_level">
							<option value = "" active>Select year</option>
							<?php $r->selectYear(); ?>
						</select>
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="levelname">Section Code:</label>
					<div class="col-sm-3"> 
						<select class = "form-control" name = "asection_level">
							<option value = "" active>Select section</option>
							<?php $r->selectSection(); ?>
						</select>
					</div>
			</div>
			
			<div class="form-group">
				<button type = "submit" name = "addYearSection" class = "control-label btn-success" id = "submit">Save</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			
		</fieldset>
	  </form>
    </div>
	
	
	
      
    </div>
</div>
     
  <!--Tab Content-->
</div>
</div>
</body>



</html>	