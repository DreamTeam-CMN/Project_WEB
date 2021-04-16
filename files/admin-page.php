<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
echo "Connected Successfully";
echo "<br>";

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin Page</title>
  </head>
  <body>
  <a href='/logout-system.php'>Log out</a>
  <br>
  <br>
  <form action="?" method="post">
  <input type="submit" name ="graphs" value="Press for other charts">
  </form>
  <?php
  
  if (isset($_POST["graphs"])){
	header('Location: graph-system.php');
  }
  
  $result=mysqli_query($conn,"SELECT * FROM userinfo"); 
  $count=mysqli_num_rows($result);
  $count--;
  echo "<br>";
  
  $domain=mysqli_query($conn,"SELECT DISTINCT requestUrl FROM entries"); 
  $count1=mysqli_num_rows($domain);
  echo "<br>";
  
  $pro=mysqli_query($conn,"SELECT DISTINCT provider FROM harfiles"); 
  $count2=mysqli_num_rows($pro);
   
  echo "<table border='1'>
	<tr>
	<th>Basic statistics</th>
	<th>Total</th>
	</tr>";
  echo "
    <tr>
	<td>Registered Users</td>
	<td> ".$count."</td>
	</tr>";
  echo "
    <tr>
	<td>Unique Domains</td>
	<td> ".$count1."</td>
	</tr>";
  echo "
   <tr>
   <td>Unique Providers</td>
   <td> ".$count2."</td>
   </tr>";
  echo "</table>";
  
  echo "<table border='1'>
	<tr>
	<th>Request Method</th>
	<th>Total</th>
	</tr>";
  $plreq=mysqli_query($conn,"SELECT COUNT(*) requestMethod  FROM entries GROUP BY requestMethod");
  $reqname=mysqli_query($conn,"SELECT requestMethod  FROM entries GROUP BY requestMethod");
  while ($row1=mysqli_fetch_array($reqname)){
	$name=$row1['requestMethod'];
	 echo "
     <tr>
    <td>".$name."</td>";
	while ($row2=mysqli_fetch_array($plreq)){ 
		$number=$row2['requestMethod'];
		echo "
	    <td>".$number."</td>
	    </tr>";
		break;
    }  
  }
  echo "<br>";
  
  echo "<table border='1'>
	<tr>
	<th>Code number</th>
	<th>Total</th>
	</tr>";
  $plres=mysqli_query($conn,"SELECT COUNT(*) responseStatus  FROM entries GROUP BY responseStatus");
  $resname=mysqli_query($conn,"SELECT responseStatus  FROM entries GROUP BY responseStatus");
  while ($row1=mysqli_fetch_array($resname)){
	  $name1=$row1['responseStatus'];
	  echo "
       <tr>
       <td>".$name1."</td>";
	while ($row2=mysqli_fetch_array($plres)){ 
		$number1=$row2['responseStatus'];
		echo "
	    <td>".$number1."</td>
	    </tr>";
		break;
    }  
  }
  echo "<br>";
 
  echo "<table border='1'>
  <tr>
  <th>Content Type</th>
  <th>Average Age</th>
  </tr>";
  $avgage=mysqli_query($conn,"SELECT AVG(age) FROM hresponse GROUP BY contentType");
  $avgname=mysqli_query($conn,"SELECT contentType FROM hresponse GROUP BY contentType");
	while ($row1=mysqli_fetch_array($avgname)){
		$name2=$row1['contentType'];
		echo "
        <tr>
        <td>".$name2."</td>";
		while ($row2=mysqli_fetch_array($avgage)){ 
			$number2=$row2['AVG(age)'];
			echo "
	        <td>".$number2."</td>
	        </tr>";
			break;
		}  
	}
	echo "<br>";
	
  ?>
  
  

 </body>
</html>