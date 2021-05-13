<!--Αποσύνδεση του χρήστη-->
<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';

/*Αποφόρτωση του username του εκάστοτε χρήστη*/
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
		
		<!--Ανακατεύθυνση στη σελίδα login-system.php κατόπιν εντολής-->
		<a href="login-system.php">Log in</a>
	</body>
</html>
	
	  
	 
 