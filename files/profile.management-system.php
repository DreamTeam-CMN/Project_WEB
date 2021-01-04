<?php

include_once 'connect.php';
echo "Connected Successfully";
echo "<br>";

session_start();
$user = $_SESSION['user'];
echo "Welcome ".$user;
echo "<br>";

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Profile Management</title>
  </head>
  <body>
  <a href='/logout-system.php'>Log out</a>
  <a href='/profile.management-system.php'>Profile management</a>
  <a href='/upload-system.php'>Upload</a>
  <a href='/home-system.php'>Home</a>
   <h1>Change Info</h1>
   <form action="?" method="post">
   <label>New Username</label>
   <input type="text" name="user" value="<?php $username ?>"> <br>
   
   <label>Old Password</label>
   <input type="password" name="oldpass" value="<?php $oldpass ?>"> <br>
   
    <label>New Password</label>
	<input type="password" name="pass" value="<?php $pass ?>"> <br>
	
	<label>Confirm New Password</label>
	<input type="password" name="conpass" value="<?php $conpass ?>"> <br>
	
	<input type="submit" name ="submit" value="Submit">
	<?php include 'profile.management-system-errors.php' ?>
	</body>
</html>