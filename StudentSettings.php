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
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style = "float:right;">
      <ul class="nav nav-pills">
	  
        <li><a href="StudentGrades.php">Grades</a></li>
        <li class="active"><a data-toggle = "pill" href = "StudentSettings.php">Settings</a></li>
		<li><a href = "login.php">Log-Out</a></li>
           </ul>   
    </div>
  </div>
</nav>
	
<div id = "home">
	<div class="container" style = "float:left;">
  <h3>Welcome Student Name</h3>
  <ul class="nav nav-pills nav-stacked col-md-2" >
    <li class="active"><a data-toggle="pill" href="#changepassword">Change Password</a></li>
    <li><a data-toggle="pill" href="#changeemail">Change E-mail Address</a></li>
  </ul>
<!--SIde navigation-->


<div class="tab-content">
    <div id="changepassword" class="tab-pane fade in active">
      <h3>Change Password</h3>
		<form class = "form-horizontal" align = "center">
		<fieldset>
			<div class="form-group">
				<label class="control-label col-sm-4" for="oldpass">Input Old Password:</label>
					<div class="col-sm-3">
					<input type="text" class="form-control" id="oldpass" >
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="newpass">Input New Password</label>
					<div class="col-sm-3"> 
						<input type="text" class="form-control" id="newpass" >
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="changepass">Reconfirm New Password</label>
					<div class="col-sm-3"> 
						<input type="text" class="form-control" id="newpass" >
					</div>
			</div>
			
			<div class="form-group">
				<button type = "submit" class = "control-label btn-success" id = "submit">Change</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
	  </div>
	  </fieldset>
	</form>
		
    <div id="changeemail" class="tab-pane fade">
      <h3>Change E-mail Address</h3>
	  
	  <form class = "form-horizontal" align = "center">
		<fieldset>
			<div class="form-group">
				<label class="control-label col-sm-4" for="oldemail">Input Old E-mail Address:</label>
					<div class="col-sm-3">
					<input type="text" class="form-control" id="oldemail" >
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="newemail">Input New E-mail Address</label>
					<div class="col-sm-3"> 
						<input type="text" class="form-control" id="newemail" >
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="changeemail">Reconfirm New E-mail Address</label>
					<div class="col-sm-3"> 
						<input type="text" class="form-control" id="changeemail" >
					</div>
			</div>
			
			<div class="form-group">
				<button type = "submit" class = "control-label btn-success" id = "submit">Change</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
	  </div>
	  	  
    </div>
  </div>
  <!--Tab Content-->
  </fieldset>
 </form>

</div>





</body>






</html>