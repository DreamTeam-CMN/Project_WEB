<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
echo "Connected Successfully";
echo "<br>";

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Home Page</title>
  </head>
  <body>
  <a href='/logout-system.php'>Log out</a>
  <?php
  $result=mysqli_query($conn,"SELECT * FROM userinfo"); 
  $count=mysqli_num_rows($result);
  $count--;
  echo "<br>";
  echo "There are " .$count. " users registered.";
  ?>
 </body>
</html>