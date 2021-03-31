<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';

session_start();
$user = $_SESSION['user'];

$iduser=mysqli_query($conn,"SELECT iduserinfo FROM userinfo WHERE username='".$user."'" );
$result=mysqli_fetch_array($iduser);
$idu=$result['iduserinfo'];

$idhar=mysqli_query($conn,"SELECT idharfiles FROM harfiles WHERE iduserinfo='".$idu."'" );
$result=mysqli_fetch_array($idhar);
$idh=$result['idharfiles'];
echo $idh;
	
$sdt="";//startedDateTime
$sia="";//serverIPAddress
$tw="";//timings wait
$reqm="";//request method
$requ="";//request url
$ress="";//response status
$resst="";//response statusText

if( $_REQUEST["EditedFile"] ){
	
	$EditedFile = $_REQUEST['EditedFile'];
}
$json_data=json_decode($EditedFile,false);
//echo gettype($json_data);

foreach ($json_data->log->entries as $v){
	/*Σύνδεση με την σελίδα connect.php*/
	include_once 'connect.php';
	
	$sdt=$v->startedDateTime;
	$sia=$v->serverIPAddress;
	$tw=$v->timings->wait;
	$reqm=$v->request->method;
	$requ=$v->request->url;
	$ress=$v->response->status;
	$resst=$v->response->statusText;

	$sql = "INSERT INTO entries (startedDateTime , serverIPAddress , timings-wait , idharfiles , request-method , request-url , response-status , response-statusText) VALUES (?,?,?,?,?,?,?,?)";
    $stmt= $conn->prepare($sql);
	$stmt->bind_param("ssssssss", $sdt , $sia , $tw , $idh , $reqm , $requ , $ress , $resst );
	$stmt->execute();
}



?>

<!DOCTYPE html>
<html>
    <body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</body>
</html>