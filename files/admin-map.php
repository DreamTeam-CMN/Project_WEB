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
var ndu=new Array();
var lalo=new Array();
var ndl=new Array();
var mapu=new Array();
var lat1=new Array();
var lon1=new Array();
var hname=new Array();
var sip=new Array();
var sip1=new Array();
var nds=new Array();
var ndh=new Array();
var cnt=new Array();
var mapdom=new Array();
var ulon=new Array();
var ulat=new Array();
var alon=new Array();
var alat=new Array();
var cnt1=new Array();
var ucnt=new Array();



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
			hname[i]=info[i][4].slice(1,-1);
			sip[i]=info[i][5].slice(1,-1);
			lalo[i]= lat[i] + "," + lon[i];
		}
		
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
		
		for (var i=0; i<ndl.length; i++){
			mapu[i]=" ";
		}
		
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
		
		
		
		for (var i=0;i<mapu.length;i++){
			mapu[i]=mapu[i].slice(4);
		}
		
		
		var greenIcon = new L.Icon({
			iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-violet.png',
			shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
			iconSize: [25, 41],
			iconAnchor: [12, 41],
			popupAnchor: [1, -34],
			shadowSize: [41, 41]
		});		
		
		var mymap = L.map('mapid').setView([37.9842, 23.7353], 4);
		const attribution='&copy? <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
		const tileUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
		const tiles=L.tileLayer(tileUrl,{attribution});
		tiles.addTo(mymap);
		
		for (var i=0;i<ndl.length;i++){
		var marker = L.marker([lat1[i] , lon1[i]], {icon: greenIcon}).addTo(mymap);
			marker.bindPopup(mapu[i]);//lathos domain
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
		
		for (var i=0; i<nds.length; i++){
            cnt[i]=0;
            mapdom[i]=" ";

        }
		
		var myIcon = L.icon({
		iconUrl: 'my-icon.png',
		iconSize: [38, 95],
		iconAnchor: [22, 94],
		popupAnchor: [-3, -76],
		shadowUrl: 'my-icon-shadow.png',
		shadowSize: [68, 95],
		shadowAnchor: [22, 94]
		});
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

        for (var i=0; i<mapdom.length; i++){
            mapdom[i]=mapdom[i].slice(4);
            cnt1[i]= cnt[i].toString();
            mapdom[i]= "The domains are: " + mapdom[i]+ " and were found " + cnt1[i] + " requests.";
        }
        for (var i=0; i<sip1.length; i++){
			ucnt[i]=ucnt[i]/5;
			
				
			getloc(sip1[i], mapdom[i],ulat[i],ulon[i],ucnt[i]);
        }
		console.log(ucnt);
		function getloc(ip,domain,lat,lon,cnt){
			$.getJSON('https://json.geoiplookup.io/'+ip, function(data){
				var marker = L.marker([data.latitude, data.longitude]).addTo(mymap);
				marker.bindPopup(domain);//lathos domain
				
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

