<?php

if(isset($_GET["ucity"]) && isset($_GET["geo"]) && isset($_GET["geo2"]) && isset($_GET["org"]) && isset($_GET["uip"]) && isset($_GET["serverip"]) ) {

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
echo "Connected Successfully";
echo "<br>";

session_start();
$user = $_SESSION['user'];
echo "Welcome ".$user;
echo "<br>";


   $city=$_GET['ucity'];
   $lat=$_GET['geo'];
   $lon=$_GET['geo2'];
   $provider=$_GET['org'];
   $userip=$_GET['uip'];
   $sip=$_GET['serverip'];
   $date=date("Y-m-d");
   echo $date;
   $iduser=mysqli_query($conn,"SELECT iduserinfo FROM userinfo WHERE username='".$user."'" );
   $result=mysqli_fetch_array($iduser);
   $idu=$result['iduserinfo'];
   $url='http://ipinfo.io/' .$sip;
   $ch=curl_init($url);
   curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
   $data=curl_exec($ch);
   curl_close($ch);
   $ret_array=json_decode($data,TRUE);
   print "<pre>";
   print_r($ret_array);
   print "</pre>";
   $sql = "INSERT INTO harfiles (city , date , ipaddress , provider , iduserinfo , latitude , longitude ) VALUES (?,?,?,?,?,?,?)";
   $stmt= $conn->prepare($sql);
   $stmt->bind_param("sssssss", $city, $date, $userip, $provider, $idu, $lat, $lon );
   $stmt->execute();
   
}elseif( $_REQUEST["newef"] ){
	
	/*Σύνδεση με την σελίδα connect.php*/
    include_once 'connect.php';
    echo "Connected Successfully";
    echo "<br>";

    session_start();
    $user = $_SESSION['user'];
    echo "Welcome ".$user;
    echo "<br>";
	
   $EditedFile = $_REQUEST['newef'];
   $sql = "INSERT INTO harfiles (hartext) VALUES (?)";
   $stmt= $conn->prepare($sql);
   $stmt->bind_param("s", $EditedFile );
   $stmt->execute();
}
?>

<!DOCTYPE html>
<html>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>