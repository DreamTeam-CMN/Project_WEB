<?php
//απόκτηση και ανέβασμα αρχείων στην βάση έπειτα από την επεξεργασία 
if(isset($_POST["ucity"]) && isset($_POST["geo"]) && isset($_POST["geo2"]) && isset($_POST["org"]) && isset($_POST["uip"]) && isset($_POST["serverip"]) && isset($_POST["urL"])) {
	
	$city=$_POST['ucity'];
	$lat=$_POST['geo'];
	$lon=$_POST['geo2'];
	$provider=$_POST['org'];
	$userip=$_POST['uip'];
	$harname=$_POST['urL'];
	$sip=$_POST['serverip'];	

}
	/*Σύνδεση με την σελίδα connect.php*/
	include_once 'connect.php';	
	
	session_start();
	$user = $_SESSION['user'];	
	
	$date=date("Y-m-d");
	
	$iduser=mysqli_query($conn,"SELECT iduserinfo FROM userinfo WHERE username='".$user."'" );
	$result=mysqli_fetch_array($iduser);
	$idu=$result['iduserinfo'];
	
	
	//εισαγωγή στη βάση δεδομένων
	$sql = "INSERT INTO harfiles (harname , city , date , ipaddress , provider , iduserinfo , latitude , longitude ) VALUES (?,?,?,?,?,?,?,?)";
	$stmt= $conn->prepare($sql);
	$stmt->bind_param("ssssssss", $harname , $city, $date, $userip, $provider, $idu, $lat, $lon );
	$stmt->execute();
	
	
	
?>

<!DOCTYPE html>
<html>
    <body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</body>
</html>