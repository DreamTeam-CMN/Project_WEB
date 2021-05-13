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
var sip=new Array();
var sip1=new Array();
var dom=new Array();
var ent=new Array();
var nds=new Array();
var ndu=new Array();
var url=new Array();
var cnt=new Array();
var comma= " , ";
var mapdom= new Array();


  var xhr = new XMLHttpRequest();
	xhr.open("POST", "user-map-system.php");
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
			sip[i]=info[i][0].slice(1,-1);
			dom[i]=info[i][1].slice(1,-1);
			ent[i]=info[i][2].slice(1,-1)*1;
			url[i]=info[i][3].slice(1,-1);
			
			
		}
		
		for (var i=0;i<sip.length;i++){
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
		for (var i=0;i<url.length;i++){
			let exists=false;
			for (var j=0;j<ndu.length;j++){
				if (url[i]===ndu[j]){
					exists=true;
					break;
				}
			}
			if (!exists){
				ndu.push(url[i]);
			}
		}
		
		for (var i=0; i<nds.length; i++){
			cnt[i]=0;
			mapdom[i]=" ";
			
		}
		
		for (var i=0; i<sip.length; i++){
			
			for (var j=0; j<nds.length; j++){
				if (sip[i]==nds[j]){
					cnt[j]=cnt[j]+1;
					var n = mapdom[j].search(url[i]);
					if(n==-1){
						mapdom[j]= mapdom[j]+ " , " + url[i];
						sip1[j]= sip[i];
					}
				}	
			}	
		}
		
		for (var i=0; i<mapdom.length; i++){
			mapdom[i]=mapdom[i].slice(4);
			cnt[i]= cnt[i].toString();
			mapdom[i]= "The domains are: " + mapdom[i]+ " and were found " + cnt[i] + " requests.";
		}
		for (var i=0; i<sip1.length; i++){
			getloc(sip1[i], mapdom[i]);
		}
		
		var mymap = L.map('mapid').setView([37.9842, 23.7353], 4);
		const attribution='&copy? <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
		const tileUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
		const tiles=L.tileLayer(tileUrl,{attribution});
		tiles.addTo(mymap);
		const api_url='https://apiwheretheiss.at/v1/satellites/25544';
		
		function getloc(ip,domain){
			$.getJSON('https://json.geoiplookup.io/'+ip, function(data){
				var marker = L.marker([data.latitude, data.longitude]).addTo(mymap);
				marker.bindPopup(domain);//lathos domain
			});
		}
  }
  
  
  </script>
  
  
  </body>
</html>
