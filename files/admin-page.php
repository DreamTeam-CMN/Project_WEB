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
  echo "<br>";
  echo "<br>";
    
  $plreq=mysqli_query($conn,"SELECT COUNT(*) requestMethod  FROM entries GROUP BY requestMethod");
  $reqname=mysqli_query($conn,"SELECT requestMethod  FROM entries GROUP BY requestMethod");
  while ($row1=mysqli_fetch_array($reqname)){
	  $name=$row1['requestMethod'];
	  echo $name.": ";
	while ($row2=mysqli_fetch_array($plreq)){ 
		$number=$row2['requestMethod'];
		echo $number;
		echo "<br>";
		break;
    }  
  }
  echo "<br>";

  $plres=mysqli_query($conn,"SELECT COUNT(*) responseStatus  FROM entries GROUP BY responseStatus");
  $resname=mysqli_query($conn,"SELECT responseStatus  FROM entries GROUP BY responseStatus");
  while ($row1=mysqli_fetch_array($resname)){
	  $name=$row1['responseStatus'];
	  echo "code number ".$name.": ";
	while ($row2=mysqli_fetch_array($plres)){ 
		$number=$row2['responseStatus'];
		echo $number;
		echo "<br>";
		break;
    }  
  }
  echo "<br>";
  
  $domain=mysqli_query($conn,"SELECT DISTINCT requestUrl FROM entries"); 
  $count1=mysqli_num_rows($domain);
  echo "There are " .$count1. " unique domains.";
  echo "<br>";
  echo "<br>";
  
  $pro=mysqli_query($conn,"SELECT DISTINCT provider FROM harfiles"); 
  $count2=mysqli_num_rows($pro);
  echo "There are " .$count2. " unique providers.";
  echo "<br>";
  echo "<br>";
  
  $avgage=mysqli_query($conn,"SELECT AVG(age) FROM hresponse GROUP BY contentType");
  $avgname=mysqli_query($conn,"SELECT contentType FROM hresponse GROUP BY contentType");
	while ($row1=mysqli_fetch_array($avgname)){
		$name=$row1['contentType'];
		echo "contentType ".$name.": ";
		while ($row2=mysqli_fetch_array($avgage)){ 
			$number=$row2['AVG(age)'];
			echo $number." average age";
			echo "<br>";
			break;
		}  
	}
  
  ?>
 </body>
</html>