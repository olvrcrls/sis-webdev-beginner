<?php
	require_once('./include/class.login.php');
	include_once('./include/class.utility.php');
	?>

<!DOCTYPE html>

<html>

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta content = "Stundent Information System Log In">
  <meta charset = "utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  
  <title>Account | Forgot Password</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel = "stylesheet" type = "text/css" href = "css/common.css"/>
  <link rel = "stylesheet" type = "text/css" href = "css/login.css"/>
  <link rel = "shortcut icon" href = "img/sjnhslogo.png"/>
  <script src = './js/captcha.js'></script>
</head>

<body >
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"><img  src="img\sjlogo.png" height = "110px" width = "120px" align="left"></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Home</a></li>
		<li><a href="#">Login</a></li>
		
      </ul>

      <ul id="nav-mobile" class="side-nav">
       <li><a href="Homepage.php">Home</a></li>
		<li><a href="login.php">Login</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Account Log-in</h1>
      <div class="row center">
        <div class = "log-form">
			<form action = "<?php $_SERVER['SCRIPT_NAME'];?>" method = "post"
			charset = 'utf-8' autocomplete = "off" name = "forgotForm">
			<fieldset>
				<legend>Retrieve Password</legend>
				<label for = "account_username">Account Username:</label>
				<input type = "text" maxlength = "20"
				 name = "account_username" size = "20" placeholder = "Input your username."
					required/>
				 <label for = "account_email">User E-mail Address:</label>
				 <input type = "text" pattern = "[a-z0-9._%+-]+@[a-z]+\.[a-z]{2,3}$"
					name = "account_email" size = "20" placeholder = "xxxxx@abc.com"required/>
				<label for = "account_type">Account Type:</label>
				<input type = "text" pattern = "[A-Za-z0-9]{7,13}" maxlength = "13"
					size = "13" name = "account_type" placeholder = "Account type." required/><br/>
				<label for = "captcha">Type the value you see:</label>
				<div id = "captchaImage">
				<img src = "gd/generateCaptcha.php" id = "imgCaptcha"/>
				</div>
				<input type = "text" name = "captcha" pattern = "[0-9]{4,4}" maxlength = "4"
					size = "4" required placeholder="X-X-X-X"/>
				<input type = "button" name = "refresh" value = "Change" onclick="changeCode()"/ style = "background-color:maroon; color:white;">
				<input type = "submit" name = "retrievePassword" value = "Send" style = "background-color:maroon; color:white;"/>
				<input type = "reset" value = "Clear fields" style = "background-color:maroon; color:white;"/>
			</fieldset>
		</form>
		</div>
      </div>
      
      <br><br>

    </div>
  </div>

    <div class="section">

    </div>
  </div>

  <footer class="page-footer orange">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Company Bio</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    
	<div class="footer-copyright">
      <div class="container">
      Made by Jhunnar and Oliver
      </div>
    </div>
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