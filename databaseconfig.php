<?php
	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "SkinCareShop";
	
	$connection = mysqli_connect($host, $username, $password, $database);

	if (mysqli_connect_errno()) {
		echo "Failed to connect to database" . mysqli_connect_error();
		exit();
	  }
?>