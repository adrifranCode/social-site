<?php
require 'config/config.php';

if(isset($_SESSION['username'])){
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}
else{
	header("Location: register.php");
}
?>

<html>
  <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Welcome Home!</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
	<script
	  src="https://code.jquery.com/jquery-3.2.1.min.js"
	  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	  crossorigin="anonymous">
	</script>
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type ="text/css" href="assets/styles/main-style.css">	
	<link rel="stylesheet" type ="text/css" href="assets/styles/animate.css">
  </head>
  <body>
	   <div class="navbar-fixed">
		  <nav>
			<div class="nav-wrapper">
			  <a href="#" class="brand-logo">Art Talk!</a>
			  <ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a href="<?php echo $userLoggedIn; ?>"><?php echo $user['first_name'];?></a></li>
				<li><a href="index.php"><i class="material-icons">home</i></a></li>
				<li><a href="#"><i class="material-icons">drafts</i></a></li>
				<li><a href="#"><i class="material-icons">new_releases</i></a></li>
				<li><a href="#"><i class="material-icons">people</i></a></li>
				<li><a href="#"><i class="material-icons">settings</i></a></li>
				<li><a href="includes/handlers/logout.php"><i class="material-icons">exit_to_app</i></a></li>
			  </ul>
			</div>
		  </nav> 
		</div>
		
		
		
