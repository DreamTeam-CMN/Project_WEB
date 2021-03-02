<!--Είσοδος χρήστη-->
<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
echo "Connected Successfully";
echo "<br>";

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Log in Page</title>
  </head>
  <body>
  
  <!--Menu-->
  <a href='/login-system.php'>Log in</a>
  <a href='/signup-system.php'>Sign up</a>
  
   <h1>Please Login</h1>
   <form action="?" method="post">
	  <label>Username</label>
	  <input type="text" name="user" value="<?php $username ?>"> <br>
	  <label>Password</label>
	  <input type="password" name="pass" value="<?php $pass ?>"> <br>
	<input type="submit" name ="login" value="Log in">
	</form>
	
	<!--Έλεγχος ορθότητας των στοιχείων-->
	<?php include 'login-system-errors.php' ?>
	</body>
</html>	