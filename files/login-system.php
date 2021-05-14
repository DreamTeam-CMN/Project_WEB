<!--Είσοδος χρήστη-->
<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Log in Page</title>
	<link rel="stylesheet" type="text/css" href="stylesheet-login.css"></link>
  </head>
  <body>
  
  <!--Menu-->
  <div class="menu">
  <a href='/login-system.php'>Log in</a>
  <a href='/signup-system.php'>Sign up</a>
  </div>
  <div class="container">
   <form id="login" action="?" method="post">
   <div class="header">
   <h3>Please Login</h3>
   </div>
    <div class="sep"></div>
	<div class="inputs">
	  <label>Username</label>
	  <input type="text" name="user" value="<?php $username ?>"> <br>
	  <label>Password</label>
	  <input type="password" name="pass" value="<?php $pass ?>"> <br>
	<input type="submit" name ="login" value="Log in">
	<!--Έλεγχος ορθότητας των στοιχείων-->
	<?php include 'login-system-errors.php' ?>
	<br>
	<br>
	<br>
	<input type="submit" name ="admin" value="Admin">
	</form>
	</div>
   </div>
	<?php

    if (isset($_POST["admin"])){
	header('Location: admin-login.php');
}
?>
	</body>
</html>	