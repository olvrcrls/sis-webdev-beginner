<?php
	session_start();
	require('./include/class.registrar.php');
	include_once('./include/class.utility.php');
	if($_SESSION['log'] != true || $_SESSION['type'] != 'REGISTRAR'){
		$obj->redirect('login.php');}
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
  <script src="js/bootstrap.min.js"></script>
  <script src = "js/registrarreports.js"></script>

	
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
        <li><a href = "RegistrarStudents.php">Student</a></li> 
        <li><a href = "RegistrarFaculty.php">Faculty</a></li>
		<li><a href = "RegistrarMiscellaneous.php">Miscellaneous</a></li>
		<li class="active"><a href = "RegistrarReports.php">Reports</a></li>
		<li><a href = "login.php">Log-Out</a></li>

      </ul>   
    </div>
  </div>
</nav>
	
<div id = "home">
	<div class="container" style = "float:left;">
  <h3>Welcome Registrar</h3>
  <ul class="nav nav-pills nav-stacked col-md-2" >
    <li class="active"><a data-toggle="pill" href="#overall">Overall Enrolled Students</a></li>
    <li><a data-toggle="pill" href="#persection">Students Per Section</a></li>
    <li><a data-toggle="pill" href="#member">Faculty Members</a></li>
  </ul>
<!--SIde navigation-->


<div class="tab-content">
    
	<div id="overall" class="tab-pane fade in active">
      <h3>Overall Enrolled Students</h3>
		<form  action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>" 
			method = "post">
			<fieldset>
				<table class ="table table-bordered ">
						<thead>
							<tr>
								<th  colspan ="4">
									<form role="form">
									<div class="form-group col-sm-4">
									  <select class="form-control" id="Overall_acadyear">
											<option value = '' active>Select AY</option>
											<?php $r->selectAcademicYear(); ?>
									  </select>
									  
									 <select class="form-control col-sm-4" id="Overall_year" align="right">
										<option value = '' active>Select year level</option>
										<?php $r->selectYear(); ?>
									  </select>
									  <div class="form-group">
										<button type = "button" class = "control-label btn-success" id = "searchOverall" name = 'createAccount'>Search</button>
										<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
									  </div>
									  
								</th>
								
							</tr>
							<tr>
								<th>Student Number</th>
								<th>Student Name</th>
								<th>Section</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody id = "tableBody">
							
						</tbody>
						
				</table>
				<div class="form-group">
				<label class="control-label col-sm-3" for="numberofaccount">Number of Students:</label>
	
				<label class="control-label col-sm-1" for="numberofaccount"><span id = "Overall_totalnumber"></span></label>	
			</div>
			
				</fieldset>
			</form>
    </div>
	
    <div id="persection" class="tab-pane fade">
      <h3>Students per Section</h3>
		<form>
			<fieldset>
				<table class ="table table-bordered ">
						<thead>
							<tr>
								<th  colspan ="4">
									<form role="form">
									<div class="form-group col-sm-4">
									  <select class="form-control" id="perAy">
										<option value = '' active>Select academic year</option>
										<?php $r->selectAcademicYear(); ?>
									  </select>
									  
									 <select class="form-control col-sm-4" id="perYs" align="right">
										<option value = '' active>Select Year & Section</option>
										<?php $r->selectYearSection(); ?>
									  </select>
									  
									  <div class="form-group">
										<button type = "button" class = "control-label btn-success" id = "btnPerSection" name = 'createAccount'>Search</button>
										<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
								      </div>
									  
								</th>
							</tr>
							<tr>
								<th>Student Number</th>
								<th>Student Name</th>
								<th>Section</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody id = "tbPerSection">
						</tbody>
				</table>
				<div class="form-group">
				<label class="control-label col-sm-3" for="numberofaccount">Number of Account/s:</label>
	
				<label class="control-label col-sm-1" for="numberofaccount"><span id = "perTotal"></span></label>	
			</div>
			
				</fieldset>
			</form>
    </div>
    <div id="member" class="tab-pane fade">
      <h3>Faculty Members</h3>
		<form>
			<fieldset>
				<table class ="table table-bordered ">
						<thead>
							<tr>
								<th  colspan ="4">
									<form role="form">
										<div class="form-group col-sm-4">
											<div class="form-group">
												<label class="control-label col-sm-4" for="selectDepartment">Department:</label>
													<select id = "selectDepartment" class = 'form-control'>
													<option value = '' active>Select Department</option>
													<?php $r->selectDepartment(); ?>
													</select>
												<div class="form-group">
			</div>
											
											</div>
									  
									
									  
								</th>
							</tr>
							<tr>
								<th>Faculty Number</th>
								<th>Faculty Name</th>
								<th>Gender</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody id = "tbFaculty">
							
						</tbody>
				</table>
				<div class="form-group">
				<label class="control-label col-sm-3" for="numberofaccount">Number of Teachers:</label>
	
				<label class="control-label col-sm-1" for="numberofaccount"><span id = "totalFaculty"></span></label>	
			</div>
			
				</fieldset>
			</form>
    </div>
   
    </div>
  </div>
  <!--Tab Content-->
</div>
</body>
</html>