<?php
	// Database Constants
	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "ashish");
	
	$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	if (mysqli_connect_error()) {
		die("Database connection failed: " . mysqli_connect_error()." (".mysqli_connect_errno().")");
	}
	
?>
