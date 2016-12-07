<?php
	
	require_once("./include/class.faculty.php");
	include_once("./include/class.utility.php");
	if($_SESSION['log'] != true || $_SESSION['type'] != 'FACULTY'){
			
			$obj->redirect("login.php");
			
	}
	
	
	
	if(isset($_POST['btnSend'])){
			
			$f->sendMessage($_POST['msgEmail'],$_POST['msgNumber'],$_POST['msgSubject'],$_POST['msgMessage']);
			
			
	}
	
	
	if(isset($_POST['changeEmail'])){
			
			if($_POST['newemail'] != $_POST['confirmnew']){
					$obj->msg("New email and confirmation email is not matched.");
					die;
			}
			
			else $f->changeEmail($_POST['newemail'],$_POST['oldemail']);
			
	}
	
	
	if(isset($_POST['changePassword'])){
			
			if($_POST['newpassword'] != $_POST['confirmationpassword']){
					
					$obj->msg("New password and confirmation password does not match.");
					die;
					
			}
			
			else $f->changePassword($_POST['oldpassword'],$_POST['newpassword']);
			
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
      <a class="navbar-brand" href="#"><img src = "img/sjlogo.png" height = "85px" width = "100px" ></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style = "float:right;">
      <ul class="nav nav-pills">
        <li><a href = "Faculty.php">Grading</a></li>
		<li class="active"><a href = "FacultySettings.php">Settings</a></li>	
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
	<li class = "active"><a data-toggle="pill"	 href="#changepassword">Change Password</a></li>
    <li><a data-toggle="pill"	 href="#changeemail">Change Email Address</a></li>
	<li><a data-toggle="pill"	 href="#compose">Compose Message</a></li>
     </ul>
<!--SIde navigation-->





	<div class="tab-content">
    <div id="changepassword" class="tab-pane fade in active">
      <h3>Change Password</h3>
		<form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>"
				method = "post">
		<fieldset>
			<div class="form-group">
				<label class="control-label col-sm-4" for="oldpass">Input Old Password:</label>
					<div class="col-sm-3">
					<input name = "oldpassword" type="password" class="form-control" id="oldpass" >
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="newpass">Input New Password</label>
					<div class="col-sm-3"> 
						<input name = "newpassword" type="password" class="form-control" id="newpass" >
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="changepass">Reconfirm New Password</label>
					<div class="col-sm-3"> 
						<input name = "confirmationpassword" type="password" class="form-control" id="newpass" >
					</div>
			</div>
			
			<div class="form-group">
				<button name = "changePassword" type = "submit" class = "control-label btn-success" id = "submit">Change</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
	  </div>
	  </fieldset>
	</form>
		
    <div id="changeemail" class="tab-pane fade">
      <h3>Change E-mail Address</h3>
	  
	  <form class = "form-horizontal" align = "center" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>"
		method = "post">
		<fieldset>
			<div class="form-group">
				<label class="control-label col-sm-4" for="oldemail">Input Old E-mail Address:</label>
					<div class="col-sm-3">
					<input name = "oldemail" type="text" class="form-control" id="oldemail" >
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="newemail">Input New E-mail Address</label>
					<div class="col-sm-3"> 
						<input name = "newemail" type="text" class="form-control" id="newemail" >
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-4" for="changeemail">Reconfirm New E-mail Address</label>
					<div class="col-sm-3"> 
						<input name = "confirmnew" type="text" class="form-control" id="changeemail" >
					</div>
			</div>
			
			<div class="form-group">
				<button name = "changeEmail" type = "submit" class = "control-label btn-success" id = "submit">Change</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			  	  
   </fieldset>
   </form>
   
   
	  </div>
	
  <div id="compose" class="tab-pane fade">
      <h3>Compose</h3>
	  
	  <form class = "form-horizontal" align = "left" action = "<?php echo $_SERVER['SCRIPT_NAME']; ?>"
		method = "post" >
		<fieldset>
			<div class="form-group">
				<label class="control-label col-sm-1" for="emailadd">To:</label>
					<div class="col-sm-6">
					<input name = "msgEmail" type="email" class="form-control" id="emailadd" placeholder="tosomeone@somewhere.com"/>
					<input name = "msgNumber" type="text" class="form-control" id="numberadd" pattern = "[0-9,+]{11,13}" placeholder="09123-456-7890"/>
					</div>
					<div class = "col-sm-1">
						<input type="checkbox" class = "form-control" id = "sendtype" name = "checkEmail"><span>Email </span>
						<input type="checkbox" class = "form-control" id = "sendtype" name = "checkSMS"><span>SMS </span>
					</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-sm-1" for="subject">Subject:</label>
					<div class="col-sm-5"> 
						<input name = "msgSubject" type="text" class="form-control" id="subject" placeholder="This is why I message you.."/>
					</div>
			</div>
			
			<div class="form-group">
				<label for="Message">Write Message:</label>
					<textarea name = "msgMessage" class="form-control" rows="10" id="message" placeholder= "Input your message here..."></textarea>
			</div>
			
			<div class="form-group">
				<button type = "submit" name = "btnSend" class = "control-label btn-success" id = "submit">Send</button>
				<button type = "reset" class = "control-label btn-danger" id = "reset">Clear Fields</button>
			</div>
			  	  
   </fieldset>
   </form>

  <!--Tab Content--> 
 </div>
	
	
    
  </div>

</div>
  <!--Tab Content-->

</body>



</html>