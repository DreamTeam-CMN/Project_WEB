<?php

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
	
	$url='http://ipinfo.io/' .$sip; //doulevei mono gia ipv4, oxi gia ipv6
	$ch=curl_init($url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
	$data=curl_exec($ch);
	curl_close($ch);
	$ret_array=json_decode($data,TRUE);
	print "<pre>";
	print_r($ret_array);
	print "</pre>";
	
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