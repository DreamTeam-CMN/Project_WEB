<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
?>
<div class="menu">
<?php
session_start();
$user = $_SESSION['user'];
echo "Welcome ".$user;
echo "<br>";
?>
</div>

<!DOCTYPE html>
<html>
  <head>
    <title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="stylesheet-home.css"></link>
  </head>
  <body>
  
   <!--Menu-->
   <div class="menu">
  <a href='/logout-system.php'>Log out</a>
  <a href='/profile.management-system.php'>Profile Management</a>
  <a href='/upload-system.php'>Upload</a>
  <a href='/home-system.php'>Home</a>
  </div>
  <div class="container">
  <div class="header">
   <form id="home" action="?" method="post">
   <h1>Welcome</h1>
   <div class="sep"></div>
   <p>Για να κάνεις Upload πάτα εδώ: </p>
   <input type="submit" name ="upload" value="Upload">
   <p>Για να κάνεις διαχείρηση πληροφοριών πάτα εδώ: </p>
   <input type="submit" name ="profile" value="Profile Management">
   <p>Για να δεις το χάρτη πάτα εδώ: </p>
   <input type="submit" name ="map" value="Map">
   </form>
   </div>
   </div>
   <!--Σύνδεση με την σελίδα home.buttons-systems.php-->
   <?php include 'home.buttons-systems.php' ?>
   
  </body>
</html>
   
   