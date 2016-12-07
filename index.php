<?php
	require('./include/class.login.php');
	include_once('./include/class.utility.php');

	if(isset($_POST['login'])){
	if($l->Login($_POST['username'],$_POST['password'])){
		 $obj->redirect('redirect-page.php');
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>San Juan National High School</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/design.css">
  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="./js/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/scripts.js"></script>
  <script src = './js/captcha.js'></script>
  
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage"><img  src="img\sjlogo.png" height = "110px" width = "120px" align="left"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#myPage">HOME</a></li>
        <li><a href="#sjnhs">SJNHS</a></li>
        <li><a href="#about">ABOUT</a></li>
        <li><a class="btn" data-toggle="modal" data-target="#login">LOGIN</a><li>
      </ul>
    </div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="img/img3.jpg" alt="SJNHS" width="1200" height="700">
        <div class="carousel-caption">
          <h3>San Juan National High School</h3>
          <p>A 50 year-old school establishment that produced a lot of achievers.</p>
        </div>      
      </div>

      <div class="item">
        <img src="img/img2.jpg" alt="STUDENTS" width="1200" height="700">
        <div class="carousel-caption">
          <h3>STUDENTS</h3>
          <p>Determination of San Juan National High School students to learn.</p>
        </div>      
      </div>
    
      <div class="item">
        <img src="img/img1.jpg" alt="SJNHS" width="1200" height="700">
        <div class="carousel-caption">
          <h3>San Juan National High School Annex</h3>
          <p>An extension of the 50 year-old school establishment that produced a lot of achievers.</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<!-- Container (The SJNHS Section) -->
<div id="sjnhs" class="container text-center">
  <h3>San Juan National High School</h3>
  <p class="text-center"><em>San Juan City</em></p>
  <p>
	The San Juan National High School is proving each student with all knowledge, skills and attitude that would enable them to be competent professionals who would contribute to the growth of the nation. 
  </p> <br>
  
</div>

<!-- Container (ABOUTSection) -->
<div id="about" class="bg-1">
  <div class="container">
    <h2 class="text-center">ABOUT</h2>
	</div>
	 <div class="container">
    <h2 class="text-center">Vision</h2>
		<div class="row">
			<p class="text-center" id="info">
			It is a community led by
		   highly professional and 
		   competent leaders.It is 
		   a pool of effective and 
		   efficient teachers who
		   exemplify integrity,
		   professionalism, dedication
		   and commitment in the pursuit
		   of total development to attain
		   quality life. It is a place for
		   learners to acquire basic
		   knowledge and skills with values 
		   necessary for active and successful
		   participation in a humane and fast 
		   changing society. It is an institution
		   with an established harmonious 
		   relationship with its neighboring community.
			</p>
			
		</div>
	
	</div>
	
	
	<div class="container">
	<h2 class="text-center">Mission</h2>
		<div class="row" id="info">
			<p>
			I. Administrator
			</p>
			<p class="text-center">Aims to develop a highly professional 
			and competent work force at all levels 
			in the school by encouraging them to show
			their creativity honesty innovativeness
			efficiency integrity and productivity 
			in the interest of public service.</p>
			<p>
			II. Teachers
			</p>
			<p class="text-center">
			Aims to develop a pool of effective and efficient teachers who 
			exemplify integrity professionalism dedication and commitment 
			in the pursuit of the total development and in the attainment
			of quality life. They should be instrumental in producing 
			disciplined productive self-fullfilled and God-loving 
			citizens of our country.

			</p>

			<p>
			III. Students
			</p>
			<p class="text-center">
			Aims to equip all learners with basic knowledge and skills 
			right values necessary for active and successful participation 
			in a humane and fast changing society.
			
			<p>
			V. Parents
			</p>
			<p class="text-center">
			Aims to establish a harmonious relationship between the school
			and the community through constant communication and participation
			in all important school activities.

			</p>
			
		</div>
	
	</div>
	
	
  </div>
  <!-- Modal -->
  <div class="modal fade" id="login" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body">
         
		  <form role="form"autocomplete = "off" action = "<?php echo $_SERVER['SCRIPT_NAME'];?>"
			method = "post" charset = "utf-8">
				<div class="form-group">
					<label id = "l_username" for = "username">Username: </label>
					<input type = "text" maxlength = "16"
						title = "Enter your username" name = "username" id = "username"
						class="form-control"><br/>

					<label id = "l_password" for = "password">Password: </label>
					<input type = "password" maxlength = "16"
						title = "Enter your password" name = "password" id = "password"
						class="form-control"><br/><br/>
				</div>
					<button type = "submit" class="btn btn-block" name = "login" id = "login" >Login</button>
					<button type = "reset" class="btn btn-block" name = "clear" id = "clear">Clear Fields</button>
				</div>


			</form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn  btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </button>
          <p><button class="btn btn-danger btn-default pull-right" data-toggle="modal" data-target="#forgot">
            <span class="glyphicon glyphicon-remove"></span> Forgot Password
          </button></p>
        </div>
      </div>
    </div>
	
	
	<!-- Modal -->
  <div class="modal fade" id="forgot" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4><span class="glyphicon glyphicon-lock"></span>Retrieve Password</h4>
        </div>
        <div class="modal-body">
         
		  <!--<form role="form"autocomplete = "off" action = "<?php echo $_SERVER['SCRIPT_NAME'];?>"
			method = "post" charset = "utf-8">
				<div class="form-group">
					<label id = "l_username" for = "username">Username: </label>
					<input type = "text" maxlength = "16"
						title = "Enter your username" name = "username" id = "username"
						class="form-control"><br/>

					<label id = "l_password" for = "password">Password: </label>
					<input type = "password" maxlength = "16"
						title = "Enter your password" name = "password" id = "password"
						class="form-control"><br/><br/>
				</div>
					<button type = "submit" class="btn btn-block" name = "login" id = "login" >Login</button>
					<button type = "reset" class="btn btn-block" name = "clear" id = "clear">Clear Fields</button>
				</div>


			</form>-->
			<form action = "<?php $_SERVER['SCRIPT_NAME'];?>" method = "post"
			charset = 'utf-8' autocomplete = "off" name = "forgotForm"
			>

				<label for = "account_username">Account Username:</label>
				<input type = "text" maxlength = "20"
				 name = "account_username" size = "20" placeholder = "Input your username."
					required
					class="form-control"/>
				 <label for = "account_email">User Email Address:</label>
				 <input type = "text" pattern = "[a-z0-9._%+-]+@[a-z]+\.[a-z]{2,3}$"
					name = "account_email" size = "20" placeholder = "xxxxx@abc.com" required
					class="form-control"/>
				<label for = "account_type">Account Type:</label>
				<input type = "text" pattern = "[A-Za-z0-9]{7,13}" maxlength = "13"
					size = "13" name = "account_type" placeholder = "Account type." required
					class="form-control"/><br/>
				<label for = "captcha">Type the value you see:</label>
				<div id = "captchaImage" ><br><br>
				<img src = "gd/generateCaptcha.php" id = "imgCaptcha" height="100px" width="200px" align="center" />
				</div>
				<input type = "text" name = "captcha" pattern = "[0-9]{4,4}" maxlength = "4"
					size = "4" required placeholder="X-X-X-X"
					class="form-control"/>
				<input type = "button" name = "refresh" value = "Change" onclick="changeCode()"/ style = "background-color:maroon; color:white;">
				<input type = "submit" name = "retrievePassword" value = "Send" style = "background-color:maroon; color:white;"/>
				<input type = "reset" value = "Clear fields" style = "background-color:maroon; color:white;"/>
			
		</form>
			
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn  btn-default pull-left" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </button>
          
        </div>
      </div>
    </div>
	
  </div>
</div>


<div id="googleMap"></div>

<!-- Add Google Maps -->
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
var myCenter = new google.maps.LatLng(14.6056132, 121.0271883);

function initialize() {
var mapProp = {
center:myCenter,
zoom:12,
scrollwheel:false,
draggable:false,
mapTypeId:google.maps.MapTypeId.ROADMAP
};

var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker = new google.maps.Marker({
position:myCenter,
});

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  Oliver Carlos and Jhunnar Arconada <br>
  <a class="btn btn-default" href="https://www.facebook.com/sharer/sharer.php?u=http://arconadacarlos.hol.es" target="_blank">
  Share on Facebook
</a>
</footer>



</body>
</html>

 <?php
 
	if(isset($_POST['retrievePassword'])){
		if($_SESSION['text'] != $_POST['captcha']){
			$obj->msg('Captcha image and your input does not match.');
			die;
		}
		if(!$l->requestPassword($_POST['account_email'],$_POST['account_type'],$_POST['account_username']))
			die;
	}
 ?>
