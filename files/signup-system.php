<!--Εγγραφή χρήστη-->
<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php'; 

?>
 
<!DOCTYPE html>
<html>
  <head>
    <title>Sign up Page</title>
	<link rel="stylesheet" type="text/css" href="stylesheet-signup.css"></link>
  </head>
  <body>
  
  <!--Menu-->
  <div class="menu">
  <a href='/login-system.php'>Log in</a>
  <a href='/signup-system.php'>Sign up</a>
  </div>
   <div class="container">
   <form id="signup" action="?" method="post">
   <div class="header">
   <h3>Please Register</h3>
   </div>
   <!--Είσοδος στοιχείων-->
   <div class="sep"></div>
	<div class="inputs">
	  <label>Username</label>
	  <input type="text" name="user" value="<?php $user ?>"> <br>
	  <label>Email</label>
	  <input type="text" name="email" value="<?php $email ?>"> <br>
	  <label>Password</label>
	  <input type="password" name="pass" value="<?php $pass ?>"> <br>
	  <label>Confirm Password</label>
	  <input type="password" name="conpass" value="<?php $conpass ?>"> <br>
	  <input type="submit" name ="signup" value="Sign up">
	  
	  <!--Έλεγχος ορθότητας του password-->
	  <?php include 'signup-system-errors.php' ?>
	 
	</div>
	</form>
	</div>
	</body>
</html>	