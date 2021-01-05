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
    <title>Upload Page</title>
  </head>
  <body>
  <a href='/logout-system.php'>Log out</a>
  <a href='/profile.management-system.php'>Profile management</a>
  <a href='/upload-system.php'>Upload</a>
  <a href='/home-system.php'>Home</a>
  <h1>Choose a File to Upload</h1>
  <form action="?" method="post" enctype="multipart/form-data">
  <input type="file" name="file"> <br> <br>
  <button type="submit" name="submit">Upload File</button> <br> <br>  
    <a href="myfile" download=""><button type="button">Download File</button></a>
    <?php include 'upload-process.php' ?>	
  </body>
</html>