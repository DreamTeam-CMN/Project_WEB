<?php
//ανάκτηση αρχείων από τη βάση για τη δημιουργία των charts της ανάλησης των χρόνων απόκρισης
$servername="localhost";
  $username="root";
  $password="";
  $db="webdb";
  
  $conn=mysqli_connect($servername,$username,$password,$db);
  if(mysqli_connect_errno()){
    echo "Failed to connect to MYSQL:" . mysqli_connect_error();
	}
	
$waitTable=array(); //δημιουργία πίνακα για αποθήκευση των στοιχείων της βάσης
$array=mysqli_query($conn,"SELECT entries.timingsWait, entries.startedDateTIme, harfiles.provider, entries.requestMethod, hrequest.contentType 
FROM entries INNER JOIN harfiles ON entries.idharfiles=harfiles.idharfiles LEFT JOIN hrequest ON entries.identries=hrequest.identries");
while ($row1=mysqli_fetch_array($array)){
	$waitTable[0]=$row1['timingsWait'];
	$waitTable[1]=$row1['startedDateTIme'];
	$waitTable[2]=$row1['provider'];
	$waitTable[3]=$row1['requestMethod'];
	$waitTable[4]=$row1['contentType'];
	echo json_encode($waitTable); //εντολή για αποστολή του πίνακα και απόκτησή του στη συνέχεια μεσω ajax
}

?>