<!--Εγγραφή χρήστη-->
<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php'; 
echo "Connected Successfully";
echo "<br>";

?>
 
<!DOCTYPE html>
<html>
  <head>
    <title>Sign up Page</title>
  </head>
  <body>
  
  <!--Menu-->
  <a href='/login-system.php'>Log in</a>
  <a href='/signup-system.php'>Sign up</a>
   <h1>Please Register</h1>
   <form action="?" method="post">
   
   <!--Είσοδος στοιχείων-->
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
	  <script>
	  //var name="<?=$user?>";
	  //var mail="<?=$email?>";
	  //var password="<?=$pass?>";
	  //var confirm="<?=$conpass?>";
	  //console.log(name + mail + password + confirm);	  
	  </script>
	</form>
	</body>
</html>	