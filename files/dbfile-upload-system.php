<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';


session_start();
$user = $_SESSION['user'];


	
$sdt="";//startedDateTime
$sia="";//serverIPAddress
$tw="";//timings wait
$reqm="";//request method
$requ="";//request url
$ress="";//response status
$resst="";//response statusText
$ct="";//headers content-type
$cc="";//headers cache-control
$p="";//headers pragma
$a="";//headers age
$e="";//headers expires
$lm="";//headers last-modified
$h="";//headers host
$int1=0;

if( $_REQUEST["EditedFile"] ){
	
	$EditedFile = $_REQUEST['EditedFile'];
}
$json_data=json_decode($EditedFile,false);

$iduser=mysqli_query($conn,"SELECT iduserinfo FROM userinfo WHERE username='".$user."'" );
$result=mysqli_fetch_array($iduser);
$idu=$result['iduserinfo'];//pairnoume to id tou user

$harn=$json_data->log->entries[0]->request->url;//pairnoume to onoma tou har

$idhar=mysqli_query($conn,"SELECT idharfiles FROM harfiles WHERE iduserinfo='".$idu."' AND harname='".$harn."'" );
$result=mysqli_fetch_array($idhar);
$idh=$result['idharfiles'];//pairnoume to id tou har

$topOne = mysqli_query($conn, "SELECT identries FROM entries ORDER BY identries DESC LIMIT 1");
$int1=mysqli_fetch_array($topOne);
$counter=$int1['identries'];
if (is_null($counter)){
	$counter=0;
}

$sqlentriesQuery = "INSERT INTO entries (startedDateTime, serverIPAddress, timingsWait, idharfiles, requestMethod, requestURL, responseStatus, responseStatusText) VALUES";
$sqlhrequestQuery = "INSERT INTO hrequest (contentType, cacheControl , pragma , expires , age , lastModified, host , identries) VALUES";
$sqlhresponseQuery = "INSERT INTO hresponse (contentTyperes, cacheControlres , pragmares , expiresres , ageres , lastModifiedres , hostres , identries) VALUES";

foreach ($json_data->log->entries as $v){
	
	$sdt=$v->startedDateTime;
	$sia=$v->serverIPAddress;
	$tw=$v->timings->wait;
	$reqm=$v->request->method;
	$requ=$v->request->url;
	$ress=$v->response->status;
	$resst=$v->response->statusText;
	
	$counter++;
    $sqlentriesQuery .= "('". $sdt . "','" . $sia . "','" . $tw . "','" . $idh . "','". $reqm . "','" . $requ . "','" . $ress . "','" . $resst . "'),";
			
    foreach ($v->response->headers as $u){
		if ($u->name=='content-type' || $u->name=='Content-Type'){
			$ct=$u->value;
		}elseif ($u->name=='cache-control' || $u->name=='Cache-Control'){
			$cc=$u->value;
		}elseif ($u->name=='pragma' || $u->name=='Pragma'){
			$p=$u->value;
		}elseif ($u->name=='expires' || $u->name=='Expires'){
			$e=$u->value;
		}elseif ($u->name=='age' || $u->name=='Age'){
			$a=$u->value;
		}elseif ($u->name=='host' || $u->name=='Host'){
			$h=$u->value;
		}elseif ($u->name=='last-modified' || $u->name=='Last-Modified'){
			$lm=$u->value;
		}
		
		$sqlhresponseQuery .= "('". $ct . "','" . $cc . "','" . $p . "','" . $e . "','". $a . "','" . $lm . "','" . $h . "','" . $counter . "'),";
	}
	
	foreach ($v->request->headers as $u){
		if ($u->name=='content-type' || $u->name=='Content-Type'){
			$ct=$u->value;
		}elseif ($u->name=='cache-control' || $u->name=='Cache-Control'){
			$cc=$u->value;
		}elseif ($u->name=='pragma' || $u->name=='Pragma'){
			$p=$u->value;
		}elseif ($u->name=='expires' || $u->name=='Expires'){
			$e=$u->value;
		}elseif ($u->name=='age' || $u->name=='Age'){
			$a=$u->value;
		}elseif ($u->name=='host' || $u->name=='Host'){
			$h=$u->value;
		}elseif ($u->name=='last-modified' || $u->name=='Last-Modified'){
			$lm=$u->value;
		}
		
		$sqlhrequestQuery .= "('". $ct . "','" . $cc . "','" . $p . "','" . $e . "','". $a . "','" . $lm . "','" . $h . "','" . $counter . "'),";
	}
}
$sqlentriesQuery = substr_replace($sqlentriesQuery, ";", -1);
$mysql=$conn->prepare($sqlentriesQuery);
$mysql->execute();
$sqlhrequestQuery = substr_replace($sqlhrequestQuery, ";", -1);
$mysql1=$conn->prepare($sqlhrequestQuery);
$mysql1->execute();
$sqlhresponseQuery = substr_replace($sqlhresponseQuery, ";", -1);
$mysql2=$conn->prepare($sqlhresponseQuery);
$mysql2->execute();


?>

<!DOCTYPE html>
<html>
    <body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</body>
</html>