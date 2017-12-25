<!DOCTYPE html>
<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
  <head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Welcome to Art Talk!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="assets/styles/register-page.css">
	<script
	  src="https://code.jquery.com/jquery-3.2.1.min.js"
	  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	  crossorigin="anonymous">
	</script>
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
  </head>
  <body class = "wrapper">
	  
	  <?php
		if(isset($_POST['register_button'])) {
			echo '
			<script>

			$(document).ready(function() {
				$("#first").hide();
				$("#second").show();
			});

			</script>

			';
	    }

	  ?>
	<div class= "container">
		
		<div class ="login_box">
			
			<div class="login_header">
				<h1>Art Talk!</h1>
				<h4>Login or sign up!</h4>
			</div>
			
			<div id="first">
				<form action="register.php" method="POST">
					<input type="email" name="log_email" placeholder="Email Address" value="<?php 
					if(isset($_SESSION['log_email'])) {
						echo $_SESSION['log_email'];
					} 
					?>" required>
					<br>
					<input type="password" name="log_password" placeholder="Password">
					<br>
					<?php if(in_array("Email or password was incorrect<br>", $error_array)) echo  "<div class='card-panel red lighten-2 z-depth-5'>Email or password was incorrect<br></div>"; ?>
					<input class="waves-effect waves-light btn" type="submit" name="login_button" value="Login">
					<a href="#" id="signup" class="signup">Need an account? Register here!</a>
				</form>
			</div>
			
			<div id="second">
				<form action="register.php" method="POST">
					<input type="text" name="reg_fname" placeholder="First Name" value="<?php 
					if(isset($_SESSION['reg_fname'])) {
						echo $_SESSION['reg_fname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("<div class='card-panel red lighten-2 z-depth-5'>Your first name must be between 2 and 25 characters<br></div>", $error_array)) echo "<div class='card-panel red lighten-2 z-depth-5'>Your first name must be between 2 and 25 characters<br></div>"; ?>
					
					<input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
					if(isset($_SESSION['reg_lname'])) {
						echo $_SESSION['reg_lname'];
					} 
					?>" required>
					<br>
					<?php if(in_array("<div class='card-panel red lighten-2 z-depth-5'>Your last name must be between 2 and 25 characters<br></div>", $error_array)) echo "<div class='card-panel red lighten-2 z-depth-5'>Your last name must be between 2 and 25 characters<br></div>"; ?>
					
					<input type="email" name="reg_email" placeholder="Email" value="<?php 
					if(isset($_SESSION['reg_email'])) {
						echo $_SESSION['reg_email'];
					} 
					?>" required>
					<br>
					
					<input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
					if(isset($_SESSION['reg_email2'])) {
						echo $_SESSION['reg_email2'];
					} 
					?>" required>
					<br>
					<?php if(in_array("<div class='card-panel red lighten-2 z-depth-5'>Email already in use<br></div>", $error_array)) echo "<div class='card-panel red lighten-2 z-depth-5'>Email already in use<br></div>"; 
					else if(in_array("<div class='card-panel red lighten-2 z-depth-5'>Invalid Email Format<br></div>", $error_array)) echo "<div class='card-panel red lighten-2 z-depth-5'>Invalid Email Format<br></div>";
					else if(in_array("<div class='card-panel red lighten-2 z-depth-5'>Emails Don't Match<br></div>", $error_array)) echo "<div class='card-panel red lighten-2 z-depth-5'>Emails Don't Match<br></div>"; ?>
					
					<input type="password" name ="reg_password" placeholder="Password" required>
					<br>
					<input type="password" name ="reg_password2" placeholder="Confirm Password" required>
					<br>
					<?php if(in_array("<div class='card-panel red lighten-2 z-depth-5'>Your passwords do not match<br></div>", $error_array)) echo "<div class='card-panel red lighten-2 z-depth-5'>Your passwords do not match<br></div>"; 
					else if(in_array("<div class='card-panel red lighten-2 z-depth-5'>Your password can only contain english characters or numbers<br></div>", $error_array)) echo "<div class='card-panel red lighten-2 z-depth-5'>Your password can only contain english characters or numbers<br></div>";
					else if(in_array("<div class='card-panel red lighten-2 z-depth-5'>Your password must be betwen 5 and 30 characters<br></div>", $error_array)) echo "<div class='card-panel red lighten-2 z-depth-5'>Your password must be betwen 5 and 30 characters<br></div>"; ?>
					
					<input class="waves-effect waves-light btn" type="submit" name="register_button" value="Register">
					
					<?php if(in_array("<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>", $error_array)) echo "<div class='card-panel green lighten-2 z-depth-3'>You can now login! Have Fun!<br></div>"; ?>
					<a href="#" id="signin" class="signin">Already have an account? Sign in here.</a>
			    </form>
			</div>
			
		</div>
	</div>
  <script src="assets/scripts/register.js"></script>
  </body>
</html>
