<?php
	session_start();
	require('./include/class.admin.php');
	include_once('./include/class.utility.php');
	
	if($_SESSION['log'] != true || $_SESSION['type'] != 'ADMINISTRATOR'){
		$obj->redirect('login.php');}

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
      <a class="navbar-brand" href="#"><img src = "img/sjlogo.png" height = "85px" width = "100px" ></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style = "float:right;">
      <ul class="nav nav-pills">
	  
        <li><a href="Admin.php">Accounts</a></li>
        <li class="active"><a data-toggle = "pill" href = "AdminAudit.php">Audit</a></li> 
		<li><a href = "AdminReports.php">Reports</a></li>
		<li><a href = "login.php">Log-Out</a></li>
           </ul>   
    </div>
  </div>
</nav>
	
<div id = "home">
	<div class="container" style = "float:left;">
  <h3>Welcome Administrator</h3>
  <ul class="nav nav-pills nav-stacked col-md-2" >
    <li class="active"><a data-toggle="pill" href="#logs">View Logs</a></li>	
  </ul>
<!--SIde navigation-->

<div class="tab-content">
<div id="logs" class="tab-pane fade in active">
      <h3>View Logs</h3>
	

 <form class = "form-horizontal" align = "center"
		  action = '<?php echo $_SERVER['SCRIPT_NAME']; ?>' method = 'post'
			chartset = 'utf-8'>
		<fieldset>
			<table class = 'table table-bordered' id = 'tblAccount' align = "center">
			<thead>
				<tr><th>Log number</th>
					<th>User Account Name</th>
					<th>User IP Address</th>
					<th>Log Date/Time</th>
				</tr>
			</thead>
			<tbody>
				
					
				<?php $a->getLogs();?>
			</tbody>
		</table>
			
		</fieldset>
	  </form>
      
	</div>  
    </div>
	
    	
      
    
	<!--End of Section-->
    
  </div>
  <!--Tab Content-->
</div>











</body>



</html>