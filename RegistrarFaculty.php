<?php
	session_start();
	require("./include/class.registrar.php");
	include_once("./include/class.utility.php");
	if($_SESSION['log'] != true || $_SESSION['type'] != "REGISTRAR"){
			
			$obj->redirect("login.php");
	}

?>

<?php

	if(isset($_POST['addFaculty']) && isset($_POST['faculty_gender'])){
			$r->createFaculty($_POST['faculty_fname'],$_POST['faculty_mname'],$_POST['faculty_lname'],
			$_POST['faculty_birthdate'],$_POST['faculty_address'],$_POST['faculty_gender'],$_POST['faculty_contact'],$_POST['faculty_email'],
			$_POST['department_name']);
	}

	if(isset($_POST['editFaculty']) && isset($_POST['efaculty_number'])){
			$r->editFaculty($_POST['efaculty_number'],$_POST['efaculty_lname'],$_POST['efaculty_contact'],
							$_POST['efaculty_address'], $_POST['efaculty_email'], $_POST['efaculty_department']);
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
  <script src="js/retrieveFacultyInfo.js"></script>

	
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
        <li class="active"><a href = "RegistrarFaculty.php">Faculty</a></li>
		<li><a href = "RegistrarMiscellaneous.php">Miscellaneous</a></li>	
		<li><a href = "RegistrarReports.php">Reports</a></li>
		<li><a href = "login.php">Log-Out</a></li>
      </ul>   
    </div>
  </div>
</nav>
	
<div id = "home">
	<div class="container" style = "float:left;">
  <h3>Faculty</h3>
  <ul class="nav nav-pills nav-stacked col-md-2" >
	<li class = "active"><a data-toggle="pill"	 href="#view">View Faculty Information</a></li>
    <li><a data-toggle="pill"	 href="#new">New Faculty Information</a></li>
    <li><a data-toggle="pill" href="#edit">Edit Faculty Information</a></li>
     </ul>
<!--SIde navigation-->


<div class="tab-content">


	<div id="view" class="tab-pane fade in active">
      <h3>View Faculty Information</h3>
		<div class="col-md-10">
			<table class ="table table-bordered ">
				<thead>
					<tr>
						<th>Faculty Number</th>
						<th>Faculty Name</th>
						<th>Department</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php $r->displayFaculty(); ?>
				</tbody>
			</table>
		</div>
	  
    </div>
	

    <div id="new" class="tab-pane fade">
      <h3>New Faculty Information</h3>
     <form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>"
		method = "post" charset = "utf-8">
		<fieldset>
		
		<div class="form-group">
				<label class="control-label col-sm-4" for="factcode">Faculty Code:</label>
					<div class="col-sm-3"> 
						<input type="text" class="form-control" id="factcode" disabled 
						value = "<?php echo $r->displayFacultyNumber(); ?>"/>
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="firstname">First Name:</label>
					<div class="col-sm-4">
					<input type="text" class="form-control" id="firstname"placeholder="Enter First Name"
					 name = "faculty_fname" />
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="middlename">Middle Name:</label>
					<div class="col-sm-4"> 
						<input type="text" class="form-control" id="middle" placeholder="Enter Middle Name"
						name = "faculty_mname" />
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="lastname">Last Name:</label>
					<div class="col-sm-4"> 
						<input type="text" class="form-control" id="lastname" placeholder="Enter Last Name" 
						name = "faculty_lname" />
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="deptname">Birthdate:</label>
					<div class="col-sm-4"> 
						<input type="date" class="form-control" id="birthday" 
						name = "faculty_birthdate" />
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="deptname">Gender:</label>
					<div class="col-sm-4"> 
						<div class="radio">
							<label><input type="radio" name="faculty_gender" value = "MALE">Male</label>
							<label><input type="radio" name="faculty_gender" value = "FEMALE">Female</label>	
						</div>
				</div>
				
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="contact">Contact:</label>
					<div class="col-sm-3"> 
						<input type="text" class="form-control" id="contact" name = "faculty_contact" />
					</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="address">Home Address:</label>
				<div class="col-sm-4"> 
					<input type="text" class="form-control" id="address" name = "faculty_address" />
				</div>
			</div>
			
			
			
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="email">Email:</label>
					<div class="col-sm-4"> 
						<input type="email" class="form-control" id="email" name = "faculty_email" />
					</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="department">Department:</label>
					<div class="col-sm-4">
						<select class="form-control" id="department" name = "department_name" >
							<option active value = ''>Select department</option>
							<?php $r->selectDepartment(); ?>
						</select>
					</div>
			</div>
			
			<div class="form-group">
				<button name = "addFaculty" type = "submit" class = "control-label btn-success" id = "submit">Submit</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			
		</fieldset>
	  </form>
    </div>
	
    <div id="edit" class="tab-pane fade">
      <h3>Edit Faculty Information</h3>
      <form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>"
	   method = "post" charset = "utf-8">
		<fieldset>
		
		<div class="form-group">
				<label class="control-label col-sm-4 " for="factcode">Faculty Code:</label>
					<div class="col-sm-4"> 
						<select class = 'form-control' name = "efaculty_number" id = "efactcode">
							<option value = '' active>Select faculty number</option>
							<?php $r->selectFaculty(); ?>
						</select>
					</div>
				<div class="col-sm-3"> 
					<button type = "button" id = "btnRetrieve" class = "form-control" >Reset details</button>
				</div>
			</div>
			
		
		
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="lastname">Last Name:</label>
					<div class="col-sm-4"> 
						<input name = "efaculty_lname" type="text" class="form-control" id="elastname" placeholder="Enter Last Name">
					</div>
			</div>
			
	
			
		
				
			<div class="form-group">
				<label class="control-label col-sm-4" for="contact">Contact:</label>
					<div class="col-sm-4"> 
						<input name = "efaculty_contact" type="text" class="form-control" id="econtact" >
					</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="eaddress">Home Address:</label>
				<div class="col-sm-5"> 
					<input name = "efaculty_address" type="text" class="form-control" id="eaddress" />
				</div>
			</div>
			
			
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="email">Email:</label>
					<div class="col-sm-4"> 
						<input name = "efaculty_email" type="email" class="form-control" id="eemail" >
					</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="edepartment">Department:</label>
					<div class="col-sm-4">
						<select name = "efaculty_department" class="form-control" id="edepartment">
							<option value = '' active>Select department</option>
							<?php $r->selectDepartment(); ?>
						</select>
					</div>
			</div>
			
			<div class="form-group">
				<button name = "editFaculty" type = "submit" class = "control-label btn-success" id = "submit">Update</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			
		</fieldset>
	  </form>
   
  </div>

</div>
  <!--Tab Content-->








</body>



</html>