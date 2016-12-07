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
	  
        <li class="active"><a data-toggle = "pill" href="StudentGrades.php">Grades</a></li>
        <li><a href = "StudentSettings.php">Settings</a></li> 
		<li><a href = "login.php">Log-Out</a></li>
           </ul>   
    </div>
  </div>
</nav>
	
<div id = "home">
	<div class="container" style = "float:left;">
  <h3>Welcome Student Name</h3>
  <ul class="nav nav-pills nav-stacked col-md-2" >
    <li class="active"><a data-toggle="pill" href="#grades">Display Grades</a></li>
    <li><a data-toggle="pill" href="#enrollment">Display Enrollment Schedule</a></li>
	<li><a data-toggle="pill" href="#time">Display Time Schedule</a></li>
  </ul>
<!--SIde navigation-->


<div class="tab-content">
    <div id="grades" class="tab-pane fade in active">
      <h3>Display Grades</h3>
      
	  
    </div>
	
    <div id="enrollment" class="tab-pane fade">
      <h3>Enrollment Schedule</h3>
      
    </div>
    <div id="time" class="tab-pane fade">
	<!--Section-->
      <h3>Time Schedule</h3>
      
    </div>
	<!--End of Section-->
    
  </div>
  <!--Tab Content-->
</div>











</body>



</html>