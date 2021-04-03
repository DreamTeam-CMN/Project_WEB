<?php


/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
echo "eimai edw";

session_start();
$user = $_SESSION['user'];


	
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
$iduser=mysqli_query($conn,"SELECT iduserinfo FROM userinfo WHERE username='".$user."'" );
$result=mysqli_fetch_array($iduser);
$idu=$result['iduserinfo'];

$harn=$json_data->log->entries[0]->request->url;
echo $harn;

$idhar=mysqli_query($conn,"SELECT idharfiles FROM harfiles WHERE iduserinfo='".$idu."' AND harname='".$harn."'" );
$result=mysqli_fetch_array($idhar);
$idh=$result['idharfiles'];

foreach ($json_data->log->entries as $v){
	
	$sdt=$v->startedDateTime;
	$sia=$v->serverIPAddress;
	$tw=$v->timings->wait;
	$reqm=$v->request->method;
	$requ=$v->request->url;
	$ress=$v->response->status;
	$resst=$v->response->statusText;
	  
    $sql = "INSERT INTO entries (startedDateTime , serverIPAddress , timingsWait , idharfiles , requestMethod , requestUrl , responseStatus , responseStatusText ) VALUES (?,?,?,?,?,?,?,?)";
	$stmt= $conn->prepare($sql);
	$stmt->bind_param("ssssssss", $sdt , $sia, $tw, $idh, $reqm, $requ, $ress, $resst );
	$stmt->execute();
	
    foreach ($v->response->headers as $u){
		if ($u->name=='content-type' || $u->name=='Content-Type'){
			$ct=$u->value;
			echo $ct;
		}
	}
}



?>

<!DOCTYPE html>
<html>
    <body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</body>
</html>