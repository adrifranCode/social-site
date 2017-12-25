<?php
//Declaring Variables to prevent errors

$fname = ""; //First name
$lname = ""; //Last name
$em = ""; //email
$em2 = "";// email 2
$password = ""; //password
$password2 = ""; //password 2
$date =""; //Sign up date
$error_array = array(); //Holds error messages

if(isset($_POST['register_button'])){
	//Registration form values
	
	//First name
	$fname= strip_tags($_POST['reg_fname']); //Remove html tags
	$fname= str_replace(' ','',$fname); //Remove spaces
	$fname= ucfirst(strtolower($fname)); //Uppercase first letter
	$_SESSION['reg_fname'] = $fname; //Stores first name into session variable
	
	//Last name
	$lname= strip_tags($_POST['reg_lname']); //Remove html tags
	$lname= str_replace(' ','',$lname); //Remove spaces
	$lname= ucfirst(strtolower($lname)); //Uppercase first letter
	$_SESSION['reg_lname'] = $lname; //Stores last name into session variable
	
	//Email
	$em= strip_tags($_POST['reg_email']); //Remove html tags
	$em= str_replace(' ','',$em); //Remove spaces
	$em= ucfirst(strtolower($em)); //Uppercase first letter
	$_SESSION['reg_email'] = $em; //Stores email into session variable
	
	//Email2
	$em2= strip_tags($_POST['reg_email2']); //Remove html tags
	$em2= str_replace(' ','',$em2); //Remove spaces
	$em2= ucfirst(strtolower($em2)); //Uppercase first letter
	$_SESSION['reg_email2'] = $em2; //Stores email2 into session variable
	
	//Password
	$password= strip_tags($_POST['reg_password']); //Remove html tags
	$password2= strip_tags($_POST['reg_password2']); //Remove html tags

	$date = date("Y-m-d"); //Get's current date
	
	if($em == $em2){
		if(filter_var($em, FILTER_VALIDATE_EMAIL)){
			$em = filter_var($em, FILTER_VALIDATE_EMAIL);
			
			//Check if email already exists
			
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");
			
			//Count the number of rows returned
			$num_rows = mysqli_num_rows($e_check);
			
			if($num_rows > 0){
				 array_push($error_array, "<div class='card-panel red lighten-2 z-depth-5'>Email already in use<br></div>");
			}
			
			
		}
		else{
			array_push($error_array, "<div class='card-panel red lighten-2 z-depth-5'>Invalid Email Format<br></div>");
		}
	}
	else{
		array_push($error_array, "<div class='card-panel red lighten-2 z-depth-5'>Emails Don't Match<br></div>");
            
	}
	
	if(strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($error_array, "<div class='card-panel red lighten-2 z-depth-5'>Your first name must be between 2 and 25 characters<br></div>");
	}

	if(strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($error_array,  "<div class='card-panel red lighten-2 z-depth-5'>Your last name must be between 2 and 25 characters<br></div>");
	}

	if($password != $password2) {
		array_push($error_array,  "<div class='card-panel red lighten-2 z-depth-5'>Your passwords do not match<br></div>");
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "<div class='card-panel red lighten-2 z-depth-5'>Your password can only contain english characters or numbers<br></div>");
		}
	}

	if(strlen($password > 30 || strlen($password) < 5)) {
		array_push($error_array, "<div class='card-panel red lighten-2 z-depth-5'>Your password must be betwen 5 and 30 characters<br></div>");
	}
	
	if(empty($error_array)) {
		$password = md5($password); //Encrypt password before sending to database

		//Generate username by concatenating first name and last name
		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");


		$i = 0; 
		//if username exists add number to username
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; //Add 1 to i
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}

		//Profile picture assignment
		$rand = rand(1, 2); //Random number between 1 and 2

		if($rand == 1)
			$profile_pic = "assets/images/profile_pics/defaults/icon-accountedit.png";
		else if($rand == 2)
			$profile_pic = "assets/images/profile_pics/defaults/icon-accountlight.png";


		$query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

		array_push($error_array, "<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>");

		//Clear session variables 
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
	}

}

?>
