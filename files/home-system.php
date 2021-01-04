<?php

include_once 'connect.php';
echo "Connected Successfully";
echo "<br>";

session_start();
$user = $_SESSION['user'];
echo "Welcome ".$user;
echo "<br>";
//$user=$_POST['user'];
//$email=$_POST['email'];
//$pass=$_POST['pass'];
//$conpass=$_POST['conpass'];
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Home Page</title>
  </head>
  <body>
  <a href='/logout-system.php'>Log out</a>
  <a href='/profile.management-system.php'>Profile Management</a>
  <a href='/upload-system.php'>Upload</a>
  <a href='/home-system.php'>Home</a>
   <h1>Welcome</h1>
   <form action="?" method="post">
   <p>Αν θες να κάνεις Upload πάτα εδώ</p>
   <input type="submit" name ="upload" value="Upload">
   <p>Αν θες να κάνεις διαχείρηση πληροφοριών πάτα εδώ</p>
   <input type="submit" name ="profile" value="Profile Management">
   </form>
   <?php include 'home.buttons-systems.php' ?>
   <script>
	  console.log("<?=$user?>")
	  console.log("<?=$email?>")
	  console.log("<?=$pass?>")
	  console.log("<?=$conpass?>")	  
	</script>
  </body>
</html>
   
   