<?php

/*Σύνδεση με την σελίδα connect.php*/
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
    <title>Home Page</title>
  </head>
  <body>
  
   <!--Menu-->
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
   
   <!--Σύνδεση με την σελίδα home.buttons-systems.php-->
   <?php include 'home.buttons-systems.php' ?>
   
   <!--Άδεια από το χρήστη για χρήση τοποθεσίας-->
   <script>
	const successCallback=(position) => {
		console.log(position);
	};
    const errorCallback=(error) => {
		console.error(error);
	};
    navigator.geolocation.getCurrentPosition(successCallback,errorCallback);	
    </script>
	
  </body>
</html>
   
   