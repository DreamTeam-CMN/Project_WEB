<?php
//εκτέλεση τψν queries από τη βάση ώστε να σταλούν στο user-map.php και να δημιουργηθεί ο χάρτης
 $servername="localhost";
  $username="root";
  $password="";
  $db="webdb";
  
  $conn=mysqli_connect($servername,$username,$password,$db);
  if(mysqli_connect_errno()){
    echo "Failed to connect to MYSQL:" . mysqli_connect_error();
	}

session_start();
$user = $_SESSION['user'];

$iduser=mysqli_query($conn,"SELECT iduserinfo FROM userinfo WHERE username='".$user."'" );
$result=mysqli_fetch_array($iduser);
$idu=$result['iduserinfo'];
	
$mapTable=array();	// αρχικοποίηση του πίνακα για την αποθήκευση των στοιχείων της βάσης
$array=mysqli_query($conn,"SELECT entries.serverIPAddress, entries.requestUrl , entries.identries, entries.idharfiles, harfiles.idharfiles, harfiles.iduserinfo , harfiles.harname
FROM entries INNER JOIN harfiles ON harfiles.idharfiles=entries.idharfiles WHERE harfiles.iduserinfo='".$idu."'");
while ($row=mysqli_fetch_array($array)){
	$mapTable[0]=$row['serverIPAddress'];
	$mapTable[1]=$row['requestUrl'];
	$mapTable[2]=$row['identries'];
	$mapTable[3]=$row['harname'];
	echo json_encode($mapTable);//κωδικοποίηση για αποστολή στο user-map.php αρχείο
		
}

?>