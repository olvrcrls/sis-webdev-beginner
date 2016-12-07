<?php
	session_start();
	require_once('./include/class.utility.php');
	require_once('./include/class.admin.php');
	
	
	if($_SESSION['log'] === false || strtoupper($_SESSION['type']) != 'ADMINISTRATOR'){
			$obj->redirect('login.php');	}

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
  <script src = "js/refreshaccount.js"></script>

	
</head>

<body onload = 'process()'>


	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#"><img src = "img/sjlogo.png" height = "85px" width = "100px" ></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style = "float:right;">
      <ul class="nav nav-pills">
	  
        <li><a data-toggle = "pill" href="Admin.php">Accounts</a></li>
        <li><a href = "AdminAudit.php">Audit</a></li> 
		<li class="active"><a href = "AdminReports.php">Reports</a></li>
		<li><a href = "login.php">Log-Out</a></li>
      </ul>   
    </div>
  </div>
</nav>
	
<div id = "home">
	<div class="container" style = "float:left;">
  <h3>Welcome Administrator</h3>
  <ul class="nav nav-pills nav-stacked col-md-2" >
    <li class="active"><a data-toggle="pill" href="#accountlist">List of Accounts</a></li>
    <li><a data-toggle="pill" href="#logsinfo">Logs Information Report</a></li>
  </ul>
<!--SIde navigation-->


<div class="tab-content">
    <div id="accountlist" class="tab-pane fade in active">
      <h3>View Accounts</h3>
		
		
		 <form class = "form-horizontal" align = "center"
		  action = '<?php echo $_SERVER['SCRIPT_NAME']; ?>' method = 'post'
			chartset = 'utf-8'>
		<fieldset>		
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="usertype">User Type:</label>
					<div class="col-sm-3"> 
						<select class = "form-control" name="usertype">
						  <option value="registrar">Registrar</option>
						  <option value="faculty">Faculty</option>
						  <option value="student">Student</option>
						</select>
					</div>
				<button type = "search" class = "control-label btn-success col-sm-1" id = "submit" name = 'search' >Search</button>
			</div>
		
			<table class = 'table table-bordered' id = 'tblAccount' align = "center">
			<thead>
				<tr><th>Account number</th>
					<th>Account username</th>
					<th>Account password</th>
					<th>Account email</th>
					<th>Account type</th>
					<th>Last Log-In</th>
				</tr>
			</thead>
			<tbody>
				
					
				
			</tbody>
		</table>
		<div class="form-group">
				<label class="control-label col-sm-3" for="numberofaccount">Number of Account/s:</label>
	
				<label class="control-label col-sm-1" for="numberofaccount">100</label>	
			</div>
			
		</fieldset>
	  </form>
	  
    </div>
	
    <div id="logsinfo" class="tab-pane fade">
      <h3>Add Account</h3>
		 <form class = "form-horizontal" align = "center"
		  action = '<?php echo $_SERVER['SCRIPT_NAME']; ?>' method = 'post'
			chartset = 'utf-8'>
		<fieldset>
			<div class="form-group">
				<label class="control-label col-sm-4" for="startdate">Start Date:</label>
					<div class="col-sm-3">
					<input type="date" name = 'startdate' class="form-control" id="startdate">
					</div>
			</div>
			
			
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="enddate">End Date:</label>
				<div class="col-sm-3">
					<input type="date" name = 'enddate' class="form-control" id="enddate">
					</div>
					
			</div>
			
			
			
			<div class="form-group">
				<button type = "submit" class = "control-label btn-success" id = "submit" name = 'createAccount'>Search</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			
			
			<table class = 'table table-bordered' id = 'tblAccount' align = "center">
			<thead>
				<tr><th>Account number</th>
					<th>Account username</th>
					<th>Account password</th>
					<th>Account email</th>
					<th>Account type</th>
					<th>Last Log-In</th>
				</tr>
			</thead>
			<tbody>
				
				
				
			</tbody>
		</table>
			
				<div class="form-group">
				<label class="control-label col-sm-3" for="numberofaccount">Number of Account/s:</label>
	
				<label class="control-label col-sm-1" for="numberofaccount">100</label>	
			</div>
			
		</fieldset>
	  </form>

		
      
    </div>
    
	<!--End of Section-->
    
  </div>
  <!--Tab Content-->
</div>
</div>
</body>
</html>
