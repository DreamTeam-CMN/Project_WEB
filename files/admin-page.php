<?php
//αρχική σελίδα΄του διαχειριστή και εμφάνιση πινάκων.
/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
?>
<div class="menu">
<?php
session_start();
$user = $_SESSION['user'];
echo "Welcome admin";
echo "<br>";
?>
</div>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin Page</title>
	<link rel="stylesheet" type="text/css" href="stylesheet-admin.css"></link>
  </head>
  <body>
  <div class="menu">
  <a href='/logout-system.php'>Log out</a>
  </div>
  <br>
  <br>
  
  <form id="admin" action="?" method="post">
  <input type="submit" name ="grapht" value="Timings charts">
  <br>
  <br>
  <input type="submit" name ="graphhe" value="Headers charts">
  <br>
  <br>
  <input type="submit" name ="amap" value="Map">
  </form>
  
  <?php
  //κουμπι για τα timings charts
  if (isset($_POST["grapht"])){
	header('Location: graph.timings-system.php');
  }
  //κουμπι για τα headers charts
  if (isset($_POST["graphhe"])){
	header('Location: graph.headers-system.php');
  }
  //κουμπι για το χάρτη
   if (isset($_POST["amap"])){
	header('Location: admin-map.php');
  }
  //query για την απόκτηση του αριθμού των εγγεγραμένων χρηστών.
  $result=mysqli_query($conn,"SELECT * FROM userinfo"); 
  $count=mysqli_num_rows($result);
  $count--;
  echo "<br>";
  //απόκτηση των μοναδικών domain που υπάρχουν
  $domain=mysqli_query($conn,"SELECT DISTINCT requestUrl FROM entries"); 
  $count1=mysqli_num_rows($domain);
  echo "<br>";
  //απόκτηση μοναδικών παρόχων.
  $pro=mysqli_query($conn,"SELECT DISTINCT provider FROM harfiles"); 
  $count2=mysqli_num_rows($pro);
  //δημιουργία πινάκων 
  ?>
  <div class="cont1">
  <?php
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
  ?>
  </div>
  <div class="cont2">
  <?php
  echo "<table border='1'>
	<tr>
	<th>Request Method</th>
	<th>Total</th>
	</tr>";
	//Το πλήθος των εγγραφών στη βάση ανά τύπο (μέθοδο) αίτησης
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
  echo  "</table>";
  ?>
  </div>
  <div class="cont3">
  <?php
  echo "<table border='1'>
	<tr>
	<th>Response Status</th>
	<th>Total</th>
	</tr>";
	//Το πλήθος των εγγραφών στη βάση ανά κωδικό (status) απόκρισης
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
  echo "</table>";
  ?>
  </div>
  <div class="cont4">
  <?php
  echo "<table border='1'>
  <tr>
  <th>Content Type</th>
  <th>Average Age</th>
  </tr>";
  //Η μέση ηλικία των ιστοαντικειμένων τη στιγμή που ανακτήθηκαν, ανά CONTENT-TYPE
  $avgage=mysqli_query($conn,"SELECT AVG(ageres) FROM hresponse GROUP BY contentTyperes");
  $avgname=mysqli_query($conn,"SELECT contentTyperes FROM hresponse GROUP BY contentTyperes");
	while ($row1=mysqli_fetch_array($avgname)){
		$name2=$row1['contentTyperes'];
		echo "
        <tr>
        <td>".$name2."</td>";
		while ($row2=mysqli_fetch_array($avgage)){ 
			$number2=$row2['AVG(ageres)'];
			echo "
	        <td>".$number2."</td>
	        </tr>";
			break;
		}  
	}
	echo "</table>";
  ?>
  </div>
 </body>
</html>