<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
?>
<div class="menu">
<?php
session_start();
$user = $_SESSION['user'];
echo "Welcome ".$user;
echo "<br>";
?>
</div>

<!DOCTYPE html>
<html>
  <head>
    <title>Map</title>
	<link rel="stylesheet" type="text/css" href="stylesheet-home.css"></link>
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
  <div class="menu">
  <a href='home-system.php'>Home</a>
  <a href='/logout-system.php'>Log out</a><br>
  </div>
  <div id="mapid"></div>
  
  <script>
  //Δήλωση πινάκων που χρησιμοποιήσαμε
var info=new Array();//αρχείο απο php
var sip=new Array();//server IP Address
var sip1=new Array();//αντιγραφο του sip
var dom=new Array();//domain της ιστοσελίδας που συνδέθηκε ο χρήστης
var ent=new Array();//αποθηκευση entries
var nds=new Array();//ο πίνακας sip χωρίς διπλότυπα
var ndu=new Array();//ο πίνακας url χωρίς διπλότυπα
var url=new Array();//διευθύνσεις url (har name)
var cnt=new Array();//αποθήκευση του πλήθους των requests ανα τοποθεσία 
var comma= " , "; //κόμμα 
var mapdom= new Array();//το συνολο των domain που βρέθηκαν και το περιεχόμενο φαίνεται σε κάθε marker του χρήστη

//ajax για απόκτηση των αρχείων από το αρχείο user-map-system.php που παίρνει τα δεδομένα από τη βάση.
  var xhr = new XMLHttpRequest();
	xhr.open("POST", "user-map-system.php");
	xhr.send();
	xhr.onload = function(){
		result = this.response;//data from php
		var edit = result.split("]");
		analysisip(edit);
	};
	//κύρια μέθοδος του αρχείου user-map.php
  function analysisip (edit) {
	  //επεξεργασία των αρχείων της βάσης και κατανομή τους σε αντίστοιχους πίνακες
		for (var i=0;i<edit.length-1;i++){
			info[i]=edit[i].slice(1);
			info[i]=info[i].split(",");
			sip[i]=info[i][0].slice(1,-1);
			dom[i]=info[i][1].slice(1,-1);
			ent[i]=info[i][2].slice(1,-1)*1;
			url[i]=info[i][3].slice(1,-1);	
		}
		//διαγραφή διπλοτύπων για τον πίνακα sip (server IP Address)
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
		//διαγραφή διπλοτύπων για τον πίνακα url (ονοματα των ιστοσελίδων)
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
		//αρχικοποίηση τψν πινάκων ως 0 και κενό αντίστοιχα
		for (var i=0; i<nds.length; i++){
			cnt[i]=0;
			mapdom[i]=" ";
			
		}
		//κρατάμε κατ' αντιστοιχία τα server IP Address και τις τοποθεσίες των χρηστών για την δημιουργία των markers στο χάρτη.
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
		//δημιουργία επιθυμητών κειμένων για το χάρτη
		for (var i=0; i<mapdom.length; i++){
			mapdom[i]=mapdom[i].slice(4);
			cnt[i]= cnt[i].toString();
			mapdom[i]= "The domains are: " + mapdom[i]+ " and were found " + cnt[i] + " requests.";
		}
		//επανάληψη για την εισαγωγή των markers στον χάρτη
		for (var i=0; i<sip1.length; i++){
			getloc(sip1[i], mapdom[i]);
		}
		//δημιουργία του χάρτη με συγκεκριμένη μεγένθυση στις συντεταγμένες:[37.9842, 23.7353]
		var mymap = L.map('mapid').setView([37.9842, 23.7353], 4);
		const attribution='&copy? <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
		const tileUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
		const tiles=L.tileLayer(tileUrl,{attribution});
		tiles.addTo(mymap);
		//Η συνάρτηση αυτή δημιουργεί markers στο ΄χαρτη έπειτα από ανάλυση των server IP Address
		function getloc(ip,domain){
			$.getJSON('https://json.geoiplookup.io/'+ip, function(data){
				var marker = L.marker([data.latitude, data.longitude]).addTo(mymap);
				marker.bindPopup(domain);
			});
		}
  }
  
  
  </script>
  
  
  </body>
</html>
