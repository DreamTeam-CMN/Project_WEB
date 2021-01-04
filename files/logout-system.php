<?php

include_once 'connect.php';
echo "Connected Successfully";
echo "<br>";


session_start();
session_unset();
session_destroy();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Log out Page</title>
	</head>
	<body>
		You have been logged out.
		<a href="login-system.php">Log in</a>
	</body>
</html>
	
	  
	 
 