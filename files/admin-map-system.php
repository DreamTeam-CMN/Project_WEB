<?php
//εκτέλεση τψν queries από τη βάση ώστε να σταλούν στο admin-map.php και να δημιουργηθεί ο χάρτης
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
	
$amapTable=array();	// αρχικοποίηση του πίνακα για την αποθήκευση των στοιχείων της βάσης
$array=mysqli_query($conn,"SELECT harfiles.latitude, harfiles.longitude, entries.requestUrl, harfiles.harname, userinfo.username, entries.serverIPAddress
FROM harfiles INNER JOIN entries ON harfiles.idharfiles=entries.idharfiles LEFT JOIN userinfo ON harfiles.iduserinfo=userinfo.iduserinfo");
while ($row=mysqli_fetch_array($array)){
	$amapTable[0]=$row['latitude'];
	$amapTable[1]=$row['longitude'];
	$amapTable[2]=$row['requestUrl'];
	$amapTable[3]=$row['username'];
	$amapTable[4]=$row['harname'];
	$amapTable[5]=$row['serverIPAddress'];
	$amapTable[5]=str_replace("[", "", $amapTable[5]);
	$amapTable[5]=str_replace("]", "", $amapTable[5]);
	echo json_encode($amapTable); //κωδικοποίηση για αποστολή στο admin-map.php αρχείο
	
}
?>