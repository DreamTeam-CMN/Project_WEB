<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';


?>
<!-- HTML για τη σελίδα του διαχειριστή.-->
<!DOCTYPE html>
<html>
  <head>
    <title>Log in Page</title>
  </head>
  <body> 
   <h1>Please Login</h1>
   <form action="?" method="post">
	  <label>Username</label>
	  <input type="text" name="user" value="<?php $username ?>"> <br>
	  <label>Password</label>
	  <input type="password" name="pass" value="<?php $pass ?>"> <br>
	  <input type="submit" name ="loginad" value="Log in">
	  <?php include 'admin-login-errors.php' ?> 
    </form>
 </body>
</html>