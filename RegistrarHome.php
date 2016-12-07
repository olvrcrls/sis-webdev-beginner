<?php
	session_start();
	require('./include/class.registrar.php');
	include_once('./include/class.utility.php');
	if($_SESSION['log'] != true || $_SESSION['type'] != 'REGISTRAR'){
		$obj->redirect('login.php');
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
        <li class="active"><a href="RegistrarHome.php">Home</a></li>
        <li><a href = "RegistrarStudents.php">Student</a></li> 
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
  <h3>Welcome Registrar</h3>
  <ul class="nav nav-pills nav-stacked col-md-2" >
    <li class="active"><a data-toggle="pill" href="#faculty">Faculty</a></li>
    <li><a data-toggle="pill" href="#student">Student</a></li>
    <li><a data-toggle="pill" href="#department">Department</a></li>
  </ul>
<!--SIde navigation-->


<div class="tab-content">
    <div id="faculty" class="tab-pane fade in active">
      <h3>Faculty</h3>
		<form>
			<fieldset>
		<table class = 'table table-hovered'>
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
		</fieldset>
	</form>
    </div>
    <div id="student" class="tab-pane fade">
      <h3>Student</h3>
	  <form>
		<fieldset>
      <table class = 'table table-hovered'>
			<thead>
				<tr>
					<th>Student Number</th>
					<th>Student Name</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php $r->displayStudent(); ?>
			</tbody>
		</table>
		</fieldset>
		</form>
    </div>
    <div id="department" class="tab-pane fade">
      <h3>Department</h3>
	  <form>
		<fieldset>
      <table class = 'table table-hovered'>
			<thead>
				<tr>
					<th>Department ID</th>
					<th>Deparment Name</th>
					<th>Number of faculty</th>
				</tr>
			</thead>
			<tbody>
				<?php $r->displayDepartment(); ?>
			</tbody>
		</table>
		</fieldset>
	</form>
		</div>
   
    </div>
  </div>
  <!--Tab Content-->
</div>
</body>
</html>