<?php
	
	ob_start();
	session_start();

	$timezone = date_default_timezone_set("America/Barbados");
	$con = mysqli_connect("localhost", "root","", "social");

	if(mysqli_connect_errno()){
		
		echo "Could not connect: " . mysqli_connect_errno();
	}

?>
