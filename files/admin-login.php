<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';


?>
<!-- HTML για τη σελίδα του διαχειριστή.-->
<!DOCTYPE html>
<html>
  <head>
    <title>Log in Page</title>
	<link rel="stylesheet" type="text/css" href="stylesheet-login.css"></link>
  </head>
  <body> 
  <!--Menu-->
  <div class="menu">
  <a href='/login-system.php'>Previous page</a>
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
	  <input type="submit" name ="loginad" value="Log in">
	  <?php include 'admin-login-errors.php' ?> 
    </form>
	</div>
   </div>
 </body>
</html>