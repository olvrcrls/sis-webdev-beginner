<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	require_once("./include/class.faculty.php");
	include_once("./include/class.utility.php");
	include_once("./include/class.registrar.php");
	if($_SESSION['log'] != true || $_SESSION['type'] != 'FACULTY'){
			
			$obj->redirect("login.php");
			
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
  <script src = "js/faculty.js"></script>
	
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
      <a class="navbar-brand" href="Faculty.php"><img src = "img/sjlogo.png" height = "85px" width = "100px" ></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style = "float:right;">
      <ul class="nav nav-pills">
        <li class="active"><a href = "Faculty.php">Grading</a></li>
		<li><a href = "FacultySettings.php">Settings</a></li>	
		<li><a href = "FacultyReports.php">Reports</a></li>
		<li><a href = "login.php">Log-Out</a></li>
      </ul>   
    </div>
  </div>
</nav>
	
<div id = "home">
	<div class="container" style = "float:left;">
  <h3>Welcome Faculty</h3>
  <ul class="nav nav-pills nav-stacked col-md-2" >
	<li class = "active"><a data-toggle="pill"	 href="#view">View Students</a></li>
    <li><a data-toggle="pill"	 href="#encode">Encode Grades</a></li>
     </ul>
<!--SIde navigation-->


<div class="tab-content">


	<div id="view" class="tab-pane fade in active">
      <h3>View Students</h3>
		<div class="col-md-10">
			<table class ="table table-bordered ">
				<thead>
					<tr>
						<th  colspan ="4">
							<form role="form">
							<div class="form-group col-sm-4">
							  <select class="form-control" id="viewAy">
								<option value = '' active>Select Academic Year</option>
								<?php $r->selectAcademicYear(); ?>
							  </select>
							  
							   <select class="form-control col-sm-4" id="viewSub" align="right">
								<option value = '' active>Select subject</option>
								<?php $f->selectSubject();?>
							  </select><br/>
								<div class = "form-group col-sm-10">
									<button class = 'form-control btn-success' type = "button" id = "viewBtn">View</button>
								</div>
						</th>
						
							
						
					</tr>
					<tr>
						<th>Student Number</th>
						<th>Student Name</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody id = "tbView">
					
				</tbody>
			</table>
		</div>
    </div>
	

    <div id="encode" class="tab-pane fade">
      <h3>Encode Grades</h3>
    <div class="col-md-10">
			<table class ="table table-bordered ">
				<thead>
					<tr>
						<th  colspan ="6">
							<form role="form">
							<div class="form-group col-sm-4">
							  <select class="form-control" id="schoolyear">
								<option>2012-2013</option>
								<option>2013-2014</option>
								<option>2014-2015</option>
								<option>2015-2016</option>
							  </select>
							  
							   <select class="form-control col-sm-4" id="yearandsection" align="right">
								<option>3-Sampaguita</option>
								<option>3-Gumamela</option>
								<option>3-Daisy</option>
								<option>3-Camia</option>
							  </select>
						</th>
					</tr>
					<tr>
						<th>Student Number</th>
						<th>Student Name</th>
						<th>Seatwork</th>
						<th>Homework</th>
						<th>Exam</th>
						<th>Final Grade</th>
					</tr>
					<tr>
						<td>2013-00713-MN-0</td>
						<td>Jhunnar Arconada</td>
						<td><input type="number" class="form-control col-sm-2" id="seatwork" placeholder="Seatwork"/>
						</td>
						<td><input type="number" class="form-control col-sm-2" id="seatwork" placeholder="Homework"/>
						</td>
						<td><input type="number" class="form-control col-sm-2" id="exam" placeholder="Exam"/>
						</td>
						<td>
							100
						</td>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
			<div class="form-group">
				<button type = "submit" class = "control-label btn-success" id = "submit">Save</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
	
		</div>
	  
    
	</div>
	
	
    
  </div>

</div>
  <!--Tab Content-->

</body>



</html>