<?php
// αρχείο για τη δημιουργία του χάρτη του διαχειριστή
/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';

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
  <a href='/admin-page.php'>Previous Page</a>
  <a href='/logout-system.php'>Log out</a><br>
  
  <div id="mapid"></div>
  
  <script>
  //Δήλωση πινάκων που χρησιμοποιήσαμε
var info=new Array(); //αρχείο απο php
var lat=new Array(); // συντεταγμένες των χρηστών
var lon=new Array(); // συντεταγμένες των χρηστών
var dom=new Array(); //domain της ιστοσελίδας που συνδέθηκε ο χρήστης
var usn=new Array(); // όνομα χρήστη
var ndu=new Array(); //πινακας χωρίς διπλότυπα των χρηστών
var lalo=new Array(); //ενωμένοι οι πίνακες lat και lon 
var ndl=new Array(); //ο πίνακας lalo χωρίς διπλότυπα
var mapu=new Array(); //το περιεχόμενο που θα εμφανιζεται στον marker στο χάρτη για τις τοποθεσίες των χρηστών
var lat1=new Array(); //αντίγραφο του lat
var lon1=new Array(); //αντίγραφο του lon
var hname=new Array(); //ονόματα των har αρχείων (domain)
var sip=new Array(); //server IP Address
var sip1=new Array(); //αντιγραφο του sip
var nds=new Array(); //ο πίνακας sip χωρίς διπλότυπα
var ndh=new Array(); //ο πίνακας hname χωρίς διπλότυπα
var cnt=new Array(); //πινακας που μετράει το πλήθος των request που έγιναν ανά marker
var mapdom=new Array(); //το συνολο των domain που βρέθηκαν και το περιεχόμενο φαίνεται σε κάθε marker των χρηστών
var ulon=new Array(); //αντίγραφο του lon
var ulat=new Array(); //αντιγραφο του lat 
var alon=new Array(); //αντιγραφο του lon 
var alat=new Array(); // αντίγραφο του lat
var cnt1=new Array(); // αντίγραφο του cnt για χρήση των marker απο τον admin
var ucnt=new Array(); // αντίγραφο του cnt για χρήση των marker απο τον user


//ajax για απόκτηση των αρχείων από το αρχείο admin-map-system.php που παίρνει τα δεδομένα από τη βάση.
  var xhr = new XMLHttpRequest();
	xhr.open("POST", "admin-map-system.php");
	xhr.send();
	xhr.onload = function(){
		result = this.response;//data from php
		var edit = result.split("]");
		analysisip(edit);
	};
	//κύρια μέθοδος του αρχείου admin-map.php
  function analysisip (edit) {
	  //επεξεργασία των αρχείων της βάσης και κατανομή τους σε αντίστοιχους πίνακες
		for (var i=0;i<edit.length-1;i++){
			info[i]=edit[i].slice(1);
			info[i]=info[i].split(",");
			lat[i]=info[i][0].slice(1,-1)*1;
			lon[i]=info[i][1].slice(1,-1)*1;
			dom[i]=info[i][2].slice(1,-1);
			usn[i]=info[i][3].slice(1,-1);
			hname[i]=info[i][4].slice(1,-1);
			sip[i]=info[i][5].slice(1,-1);
			lalo[i]= lat[i] + "," + lon[i];
		}
		//διαγραφή διπλοτύπων για τον πίνακα usn (ονόματα χρηστών)
		for (var i=0;i<usn.length;i++){
			let exists=false;
			for (var j=0;j<ndu.length;j++){
				if (usn[i]===ndu[j]){
					exists=true;
					break;
				}
			}
			if (!exists){
				ndu.push(usn[i]);
			}
		}
		//διαγραφή διπλοτύπων για τον πίνακα lalo (συντεταγμένες χρηστών)
		for (var i=0;i<lalo.length;i++){
			let exists=false;
			for (var j=0;j<ndl.length;j++){
				if (lalo[i]===ndl[j]){
					exists=true;
					break;
				}
			}
			if (!exists){
				ndl.push(lalo[i]);
			}
		}
		//αρχικοποίηση του πίνακα ως κενό
		for (var i=0; i<ndl.length; i++){
			mapu[i]=" ";
		}
		//δημιουργία περιεχομένου και συντεταγμένων για τα markers
		for (var i=0;i<ndl.length;i++){
			for (var j=0;j<lalo.length;j++){
				if (ndl[i]==lalo[j]){
					var k=mapu[i].search(usn[j]);
					if (k==-1){
						lat1[i]=lat[j];
						lon1[i]=lon[j];
						mapu[i]=mapu[i] + " , " + usn[j];
					}					
				}
			}
		}
		
		
		//επεξεργασία του mapu για να έρθει στην επιθυμητή μορφή
		for (var i=0;i<mapu.length;i++){
			mapu[i]=mapu[i].slice(4);
		}
		
		//αλλαγή χρώματοω για τα markers του admin(μωβ)
		var greenIcon = new L.Icon({
			iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-violet.png',
			shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
			iconSize: [25, 41],
			iconAnchor: [12, 41],
			popupAnchor: [1, -34],
			shadowSize: [41, 41]
		});		
		//δημιουργία του χάρτη με συγκεκριμένη μεγένθυση στις συντεταγμένες:[37.9842, 23.7353]
		var mymap = L.map('mapid').setView([37.9842, 23.7353], 4);
		const attribution='&copy? <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
		const tileUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
		const tiles=L.tileLayer(tileUrl,{attribution});
		tiles.addTo(mymap);
		//προσθήκη των τοποθεσιών των χρηστών (μωβ markers)
		for (var i=0;i<ndl.length;i++){
		var marker = L.marker([lat1[i] , lon1[i]], {icon: greenIcon}).addTo(mymap);
			marker.bindPopup(mapu[i]);
		}
		//διαγραφή διπλοτύπων για τον πίνακα sip(serverIPAddress)
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
		//διαγραφή διπλοτύπων για τον πίνακα hname(har names)
		for (var i=0;i<hname.length;i++){
            let exists=false;
            for (var j=0;j<ndh.length;j++){
                if (hname[i]===ndh[j]){
                    exists=true;
                    break;
                }
            }
            if (!exists){
                ndh.push(hname[i]);
            }
        }
		//αρχικοποίηση τψν πινάκων ως 0 και κενό αντίστοιχα
		for (var i=0; i<nds.length; i++){
            cnt[i]=0;
            mapdom[i]=" ";

        }
		//δημιουργία των marker των server που αποκρίνονται (μπλε)
		var myIcon = L.icon({
		iconUrl: 'my-icon.png',
		iconSize: [38, 95],
		iconAnchor: [22, 94],
		popupAnchor: [-3, -76],
		shadowUrl: 'my-icon-shadow.png',
		shadowSize: [68, 95],
		shadowAnchor: [22, 94]
		});
		//κρατάμε κατ' αντιστοιχία τα server IP Address και τις τοποθεσίες των χρηστών για την δημιουργία των γραμμών που τα συνδέουν.
        for (var i=0; i<sip.length; i++){
            for (var j=0; j<nds.length; j++){
                if (sip[i]==nds[j]){
                    cnt[j]=cnt[j]+1;
                    var n = mapdom[j].search(hname[i]);
                    if(n==-1){
                        mapdom[j]= mapdom[j]+ " , " + hname[i];
                        sip1[j]=sip[i];
						ulat[j]=lat[i];
						ulon[j]=lon[i];
						ucnt[j]=cnt[j];
						
                    }
                }
            }
        }
		//δημιουργία κατάλληλης μορφής για τα περιεχόμενα των markers
        for (var i=0; i<mapdom.length; i++){
            mapdom[i]=mapdom[i].slice(4);
            cnt1[i]= cnt[i].toString();
            mapdom[i]= "The domains are: " + mapdom[i]+ " and were found " + cnt1[i] + " requests.";
        }
		//επανάληψη κατά την οποία καλούμε την συνάρτηση getloc
        for (var i=0; i<sip1.length; i++){
			ucnt[i]=ucnt[i]/5;	//έγινε δια 5 για να καθοριστεί στη συνέχεια το πάχος τψν γραμμών στο χάρτη
			getloc(sip1[i], mapdom[i],ulat[i],ulon[i],ucnt[i]);
        }
		//Η συνάρτηση αυτή δημιουργεί markers στο ΄χαρτη έπειτα από ανάλυση των server IP Address και στη συνέχεια τα ενώνει με τις επιθυμητές γραμμές
		function getloc(ip,domain,lat,lon,cnt){
			$.getJSON('https://json.geoiplookup.io/'+ip, function(data){
				var marker = L.marker([data.latitude, data.longitude]).addTo(mymap);
				marker.bindPopup(domain);
				
				var latlngs = [
					[data.latitude, data.longitude],
					[lat, lon],
					
				];

				var polyline = L.polyline(latlngs, {color: 'black',weight: cnt}).addTo(mymap);
				mymap.fitBounds(polyline.getBounds());
				
				
		
				

			});
		}
		
  }
  
  
  </script>
  
  
  </body>
</html>

