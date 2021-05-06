<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
echo "Connected Successfully";
echo "<br>";

session_start();
$user = $_SESSION['user'];
echo "Welcome ".$user;
echo "<br>";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Map</title>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
   <style>
   #mapid { height: 650px; }
   </style>
  </head>
  <body>
  <a href='/logout-system.php'>Log out</a><br>
  
  <div id="mapid"></div>
  
  <script>
var info=new Array();
var lat=new Array();
var lon=new Array();
var dom=new Array();
var usn=new Array();

  var xhr = new XMLHttpRequest();
	xhr.open("POST", "admin-map-system.php");
	xhr.send();
	xhr.onload = function(){
		result = this.response;//data from php
		var edit = result.split("]");
		analysisip(edit);
	};
  function analysisip (edit) {
		for (var i=0;i<edit.length-1;i++){
			info[i]=edit[i].slice(1);
			info[i]=info[i].split(",");
			lat[i]=info[i][0].slice(1,-1)*1;
			lon[i]=info[i][1].slice(1,-1)*1;
			dom[i]=info[i][2].slice(1,-1);
			usn[i]=info[i][3].slice(1,-1);
		}
		
		var mymap = L.map('mapid').setView([37.9842, 23.7353], 4);
		const attribution='&copy? <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
		const tileUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
		const tiles=L.tileLayer(tileUrl,{attribution});
		tiles.addTo(mymap);
		const api_url='https://apiwheretheiss.at/v1/satellites/25544';
		
		for (var i=0;i<lat.length;i++){
			var marker = L.marker([lat[i], lon[i]]).addTo(mymap);
			marker.bindPopup(dom[i]);//lathos domain
		}
		/*for (var i=0;i<sip.length;i++){
			let exists=false;
			for (var j=0;j<nds.length;j++){
				if (sip[i]===nds[j]){
					exists=true;
					break;
				}
			}
			if (!exists){
				nds.push(sip[i]);
			}
		}
		console.log(nds); // counter gia to plhthos tn ip sta marker
*/
		
		
		
			
		
  }
  
  
  </script>
  
  
  </body>
</html>

