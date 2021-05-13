<?php
$servername="localhost";
  $username="root";
  $password="";
  $db="webdb";
  
  $conn=mysqli_connect($servername,$username,$password,$db);
  if(mysqli_connect_errno()){
    echo "Failed to connect to MYSQL:" . mysqli_connect_error();
	}

$headTable=array();
$counter=0;
$array=mysqli_query($conn,"SELECT hresponse.contentTyperes, hresponse.cacheControlres, hresponse.expiresres, hresponse.lastModifiedres,  harfiles.provider, entries.identries, hrequest.contentType, hrequest.cacheControl 
FROM entries INNER JOIN harfiles ON entries.idharfiles=harfiles.idharfiles LEFT JOIN hresponse ON entries.identries=hresponse.identries LEFT JOIN hrequest ON entries.identries=hrequest.identries");
while ($row1=mysqli_fetch_array($array)){
	$headTable[0]=$row1['contentTyperes'];
	$headTable[1]=$row1['cacheControlres'];
	$headTable[1]=
	$headTable[2]=$row1['expiresres'];
	$headTable[2]=str_replace(","," ",$headTable[2]);
	$headTable[3]=$row1['lastModifiedres'];
	$headTable[3]=str_replace(","," ",$headTable[3]);
	$headTable[4]=$row1['provider'];
	$headTable[5]=$row1['contentType'];
	$headTable[6]=$row1['cacheControl'];
	$headTable[6]=str_replace(","," ",$headTable[6]);	
	echo json_encode($headTable);	
}
?>