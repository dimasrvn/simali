<?php
	
	$db_host		="localhost";
	$db_database	="simali";
	$db_username	="root";
	$db_password	="";
	
	$mysqli = new mysqli($db_host, $db_username, $db_password, $db_database);

	if (mysqli_connect_errno()) {
		die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
?>