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
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta content = "Stundent Information System Log In">
  <meta charset = "utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  
  <title>
			Account | Log In
		</title>

		
  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel = "stylesheet" type = "text/css" href = "css/common.css"/>
  <link rel = "stylesheet" type = "text/css" href = "css/login.css"/>
  <link rel = "shortcut icon" href = "img/sjnhslogo.png"/>
<!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"><img  src="img\sjlogo.png" height = "110px" width = "120px" align="left"></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="index.php">Home</a></li>
		<li><a href="login.php">Login</a></li>
		
      </ul>

      <ul id="nav-mobile" class="side-nav">
       <li><a href="index.php">Home</a></li>
		<li><a href="#">Login</a></li>
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
			<form autocomplete = "off" action = "<?php echo $_SERVER['SCRIPT_NAME'];?>"
			method = "post" charset = "utf-8">
				<fieldset>
					<legend style = "font-size: 1.8em;"><img style = "vertical-align: middle;width: 100%;" src = "img/sjnhslogo.png"/></legend>

					<label id = "l_username" for = "username">Username: </label>
					<input type = "text" maxlength = "16"
						title = "Enter your username" name = "username" id = "username" ><br/>

					<label id = "l_password" for = "password">Password: </label>
					<input type = "password" maxlength = "16"
						title = "Enter your password" name = "password" id = "password"><br/><br/>

					<input type = "submit" value = "Log in" name = "login" id = "login" >
					<input type = "reset" value = "Clear fields" name = "clear" id = "clear">
					<a id = "forgot-pw" href = "forgot.php" target = "_blank">Forgot password?</a>
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
