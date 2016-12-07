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
	  
        <li class="active"><a data-toggle = "pill" href="Admin.php">Accounts</a></li>
        <li><a href = "AdminAudit.php">Audit</a></li> 
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
    <li class="active"><a data-toggle="pill" href="#accounts">View Accounts</a></li>
    <li><a data-toggle="pill" href="#add">Add Account</a></li>
	<li><a data-toggle="pill" href="#edit">Edit Account</a></li>
  </ul>
<!--SIde navigation-->


<div class="tab-content">
    <div id="accounts" class="tab-pane fade in active">
      <h3>View Accounts</h3>
		
		
		 <form class = "form-horizontal" align = "center"
		  action = '<?php echo $_SERVER['SCRIPT_NAME']; ?>' method = 'post'
			chartset = 'utf-8'>
		<fieldset>
			<table class = 'table table-bordered' id = 'tblAccount' align = "center">
			<thead>
				<tr><th>Account number</th>
					<th>Account username</th>
					<th>Account password</th>
					<th>Account email</th>
					<th>Account type</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
			
		</fieldset>
	  </form>
	  
    </div>
	
    <div id="add" class="tab-pane fade">
      <h3>Add Account</h3>
		 <form class = "form-horizontal" align = "center"
		  action = '<?php echo $_SERVER['SCRIPT_NAME']; ?>' method = 'post'
			chartset = 'utf-8'>
		<fieldset>
			<div class="form-group">
				<label class="control-label col-sm-4" for="username">Username:</label>
					<div class="col-sm-3">
					<input type="text" name = 'username' class="form-control" id="username"placeholder="Enter Username">
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="email">Email:</label>
					<div class="col-sm-3"> 
						<input type="email" name = 'email' class="form-control" id="email" placeholder="Enter Email Address"
						pattern = "[a-z0-9._%+-]+@[a-z]+\.[a-z]{2,3}$" />
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="usertype">User Type:</label>
					<div class="col-sm-3"> 
						<select class = "form-control" name="usertype">
						  <option value="administrator">Administrator</option>
						  <option value="registrar">Registrar</option>
						  <option value="faculty">Faculty</option>
						  <option value="student">Student</option>
						</select>
					</div>
			</div>
			
			
			<div class="form-group">
				<button type = "submit" class = "control-label btn-success" id = "submit" name = 'createAccount'>Save</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			
		</fieldset>
	  </form>
      
    </div>

    <div id="edit" class="tab-pane fade">
	<!--Section-->
      <h3>Edit Account</h3>
      
		<form class = "form-horizontal" align = "center"
			action = '<?php echo $_SERVER['SCRIPT_NAME']?>' method = 'post' 
			charset = 'utf-8'>
		<fieldset>
		
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="search">Account user:</label>
					<div class="col-sm-4">
						<select class = "form-control" name = 'search'>
							<option value = '' active>Select user account  </option>
							<?php $a->selectAccount(); ?>
						</select>
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="newemail">New Email:</label>
					<div class="col-sm-3"> 
						<input type="email" class="form-control" name = 'new_email' id="newemail" placeholder="Enter New Email Address">
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="newpassword">New Password :</label>
					<div class="col-sm-3">
					<input type="password" class="form-control" id="newpassword" name = 'new_password' placeholder="Input New Password">
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="confirm_password">Confirm Password:</label>
					<div class="col-sm-3">
					<input type="password" class="form-control" id="confirm_password" name = 'confirm_password' placeholder="Retype Password">
					</div>
			</div>
			
			<div class="form-group">
				<button type = "submit" class = "control-label btn-success" id = "submit" name = 'updateAccount'>Update</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
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

<?php
	if(isset($_POST['createAccount'])){
		if($a->addAccount($_POST['username'],$_POST['email'],$_POST['usertype'])){
			$obj->msg('New user account created.');
		} else die;
	}

	
	if(isset($_POST['updateAccount'])){
		if($_POST['new_password'] != $_POST['confirm_password']){
			$obj->msg('New password and confirmation password does not match.');
			die;
		}
		
		else if($a->updateAccount($_POST['search'], $_POST['new_email'],$_POST['new_password']))
				$obj->msg('User account successfully updated.');
	}
?>