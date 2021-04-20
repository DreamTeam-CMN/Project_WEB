<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
echo "Connected Successfully";
echo "<br>";

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Chart Page</title>
  </head>
  <body>
  <a href='/admin-page.php'>Previous Page</a>
  <a href='/logout-system.php'>Log out</a>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.0/chart.min.js" integrity="sha512-RGbSeD/jDcZBWNsI1VCvdjcDULuSfWTtIva2ek5FtteXeSjLfXac4kqkDRHVGf1TwsXCAqPTF7/EYITD0/CTqw==" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <canvas id="chartContainer" width="1200" height="400"></canvas>
  <button  id="Basic">Basic</button>
  <button  id="Cont">Content Type</button>
  <button  id="Days">Days</button>
  <button  id="Meth">Request Methods</button>
  <button  id="Prov">Providers</button>
  
  <script>
    /* Αρχικοποιήσεις πινάκων*/
	var info=new Array();
	var result=new Array();
	
	var date=new Array();
	var time=new Array();
	var prov=new Array();
	var reqm=new Array();
	var cont=new Array();
	var timi=new Array();
	
	var avg=new Array();
	
	var avgote=new Array();
	var avgfor=new Array();
	var avgwin=new Array();
	
	var avgget=new Array();
	var avgopt=new Array();
	var avgpost=new Array();
	
	var n=new Array();
	var avgsun=new Array();
	var avgmon=new Array();
	var avgtue=new Array();
	var avgwed=new Array();
	var avgthu=new Array();
	var avgfri=new Array();
	var avgsat=new Array();
	
	var avgapp=new Array();
	var avgtex=new Array();
	var avgima=new Array();
	var avgfon=new Array();
	var avgnul=new Array();
	const nod=new Array();
	const prova=new Array();
	
	/*Συλλογή δεδομένων*/
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "request.php");
	xhr.send();
	xhr.onload = function(){
		result = this.response;//data from php
		var edit=result.split("]");
		analysis(edit);
	};
	
	/*Βασική Συνάρτηση επεξεργασίας δεδομένων και δημιουργίας γραφημάτων*/
	function analysis (edit) {
		for (var i=0;i<edit.length-1;i++){
			info[i]=edit[i].slice(1);
			info[i]=info[i].split(",");
			date[i]=info[i][1].slice(1,11);//the date from startedDateTime
			time[i]=info[i][1].slice(12,20);//the time from startedDateTime
			time[i]=time[i].slice(0,2);
			time[i]=time[i]*1;
			timi[i]=info[i][0].slice(1,-1);//the timingswait 
			timi[i]*=1;//string to number
			prov[i]=info[i][2];//provider
			reqm[i]=info[i][3];//requestmethod
			cont[i]=info[i][4];//request content-type
			
			/*Διαδικασία εξαγωγής ημέρας από ημερομηνία*/
			var d=new Date(date[i]);
			var weekday = new Array(7);
			weekday[0] = "Sunday";
			weekday[1] = "Monday";
			weekday[2] = "Tuesday";
			weekday[3] = "Wednesday";
			weekday[4] = "Thursday";
			weekday[5] = "Friday";
			weekday[6] = "Saturday";
			n[i] = weekday[d.getDay()];
		}
		
		/*Διαδικασία αφαίρεσης διπλότυπων από τα content-type*/
		for (var i=0;i<cont.length;i++){
			let exists=false;
			for (var j=0;j<nod.length;j++){
				if (cont[i]===nod[j]){
					exists=true;
					break;
				}
			}
			if (!exists){
				nod.push(cont[i]);
			}
		}
		
		/*Διαδικασία αφαίρεσης διπλότυπων από τους providers*/
		for (var i=0;i<prov.length;i++){
			let exists=false;
			for (var j=0;j<prova.length;j++){
				if (prov[i]===prova[j]){
					exists=true;
					break;
				}
			}
			if (!exists){
				prova.push(prov[i]);
			}
		}
		
		/*Ταξινόμηση πινάκων με βάση την ώρα*/
		for (var i=0;i<time.length;i++){
			for(var j = 0; j < ( time.length - i -1 ); j++){
				if(time[j] > time[j+1]){
					var temp1 = time[j];
					time[j] = time[j + 1];
					time[j+1] = temp1;
					
					var temp2 = date[j];
					date[j] = date[j + 1];
					date[j+1] = temp2;
					
					var temp3 = timi[j];
					timi[j] = timi[j + 1];
					timi[j+1] = temp3;
					
					var temp5 = prov[j];
					prov[j] = prov[j + 1];
					prov[j+1] = temp5;
					
					var temp4 = reqm[j];
					reqm[j] = reqm[j + 1];
					reqm[j+1] = temp4;
					
					var temp6 = cont[j];
					cont[j] = cont[j + 1];
					cont[j+1] = temp6;
				}
			}
		}
		
		/*Μέση τιμή των timings*/
		for (var i=0;i<24;i++){
			counter=0;
			avg[i]=0;
			for(var j=0;j<time.length-1;j++){
				if (time[j]>=i && time[j]<i+1){
					avg[i]=avg[i]+timi[j];
					counter++;
				}
			}
			avg[i]=avg[i]/counter;
		}
		
		/*Μέση τιμή των timings ανά content-type*/
		for (var i=0;i<24;i++){
			var counter=0;
			var counter1=0;
			var counter2=0;
			var counter3=0;
			var counter4=0;
			avgapp[i]=0; //application
			avgtex[i]=0; //text
			avgima[i]=0; //image
			avgfon[i]=0; //font
			avgnul[i]=0; //no tag or null
			for(var j=0;j<cont.length-1;j++){
				if (time[j]>=i && time[j]<i+1 && (cont[j]==nod[0] || cont[j]===nod[8])){
					avgnul[i]=avgnul[i]+timi[j];
					counter++;
				}else if(time[j]>=i && time[j]<i+1 && cont[j]===nod[23]){
					avgfon[i]=avgfon[i]+timi[j];
					counter1++;
				}else if(time[j]>=i && time[j]<i+1 && (cont[j]===nod[6] || cont[j]===nod[11] || cont[j]===nod[25] || cont[j]===nod[26] || cont[j]===nod[28] || cont[j]===nod[33])){
					avgima[i]=avgima[i]+timi[j];
					counter2++;
				}else if(time[j]>=i && time[j]<i+1 && (cont[j]===nod[1] || cont[j]===nod[2] || cont[j]===nod[3] || cont[j]===nod[12] || cont[j]===nod[16] || cont[j]===nod[17] || cont[j]===nod[19] || cont[j]===nod[20] || cont[j]===nod[21] || cont[j]===nod[22] || cont[j]===nod[24] || cont[j]===nod[32] || cont[j]===nod[37])){
					avgapp[i]=avgapp[i]+timi[j];
					counter3++;
				}else if(time[j]>=i && time[j]<i+1 && (cont[j]===nod[4] || cont[j]===nod[5] || cont[j]===nod[7] || cont[j]===nod[9] || cont[j]===nod[10] || cont[j]===nod[13] || cont[j]===nod[14] || cont[j]===nod[15] || cont[j]===nod[18] || cont[j]===nod[27] || cont[j]===nod[29] || cont[j]===nod[30] || cont[j]===nod[31] || cont[j]===nod[34] || cont[j]===nod[35] || cont[j]===nod[36])){
					avgtex[i]=avgtex[i]+timi[j];
					counter4++;
				}
			}
			avgnul[i]=avgnul[i]/counter;
			avgfon[i]=avgfon[i]/counter1;
			avgima[i]=avgima[i]/counter2;
			avgapp[i]=avgapp[i]/counter3;
			avgtex[i]=avgtex[i]/counter4;
		}
		
		/*Μέση τιμή των timings ανά ημέρα*/
		for (var i=0;i<24;i++){
			var counter=0;
			var counter1=0;
			var counter2=0;
			var counter3=0;
			var counter4=0;
			var counter5=0;
			var counter6=0;
			avgsun[i]=0;
			avgmon[i]=0;
			avgtue[i]=0;
			avgwed[i]=0;
			avgthu[i]=0;
			avgfri[i]=0;
			avgsat[i]=0;
			for(var j=0;j<date.length-1;j++){
				if (time[j]>=i && time[j]<i+1 && n[j]=="Sunday"){
					avgsun[i]=avgsun[i]+timi[j];
					counter++;
				}else if(time[j]>=i && time[j]<i+1 && n[j]=="Monday"){
					avgmon[i]=avgmon[i]+timi[j];
					counter1++;
				}else if(time[j]>=i && time[j]<i+1 && n[j]=="Tuesday"){
					avgtue[i]=avgtue[i]+timi[j];
					counter2++;
				}else if(time[j]>=i && time[j]<i+1 && n[j]=="Wednesday"){
					avgwed[i]=avgwed[i]+timi[j];
					counter3++;
				}else if(time[j]>=i && time[j]<i+1 && n[j]=="Thursday"){
					avgthu[i]=avgthu[i]+timi[j];
					counter4++;
				}else if(time[j]>=i && time[j]<i+1 && n[j]=="Friday"){
					avgfri[i]=avgfri[i]+timi[j];
					counter5++;
				}else if(time[j]>=i && time[j]<i+1 && n[j]=="Saturday"){
					avgsat[i]=avgsat[i]+timi[j];
					counter6++;
				}
			}
			avgsun[i]=avgsun[i]/counter;
			avgmon[i]=avgmon[i]/counter1;
			avgtue[i]=avgtue[i]/counter2;
			avgwed[i]=avgwed[i]/counter3;
			avgthu[i]=avgthu[i]/counter4;
			avgfri[i]=avgfri[i]/counter5;
			avgsat[i]=avgsat[i]/counter6;
		}
		
		/*Μέση τιμή των timings ανά request method*/
		for (var i=0;i<24;i++){
			var counter=0;
			var counter1=0;
			var counter2=0;
			avgget[i]=0;
			avgpost[i]=0;
			avgopt[i]=0;
			for(var j=0;j<reqm.length-1;j++){
				if (time[j]>=i && time[j]<i+1 && reqm[j]==reqm[1]){
					avgget[i]=avgget[i]+timi[j];
					counter++;
				}else if(time[j]>=i && time[j]<i+1 && reqm[j]==reqm[200]){
					avgpost[i]=avgpost[i]+timi[j];
					counter1++;	
				}else if(time[j]>=i && time[j]<i+1 && reqm[j]==reqm[1231]){
					avgopt[i]=avgopt[i]+timi[j];
					counter2++;
				}
			}
			avgget[i]=avgget[i]/counter;
			avgpost[i]=avgpost[i]/counter1;
			avgopt[i]=avgopt[i]/counter2;
		}
		
		/*Μέση τιμή των timings ανά provider*/
		for (var i=0;i<24;i++){
			var counter=0;
			var counter1=0;
			var counter2=0;
			avgote[i]=0;
			avgfor[i]=0;
			avgwin[i]=0;
			for(var j=0;j<prov.length-1;j++){
				if (time[j]>=i && time[j]<i+1 && prov[j]==prova[2]){
					avgote[i]=avgote[i]+timi[j];
					counter++;
				}else if(time[j]>=i && time[j]<i+1 && prov[j]==prova[0]){
					avgfor[i]=avgfor[i]+timi[j];
					counter1++;
				}else if(time[j]>=i && time[j]<i+1 && prov[j]==prova[1]){
					avgwin[i]=avgwin[i]+timi[j];
					counter2++;
				}
			}
			avgote[i]=avgote[i]/counter;
			avgfor[i]=avgfor[i]/counter1;
			avgwin[i]=avgwin[i]/counter2;
		}
		
		/*μετατροπή στοιχείων null σε 0*/
		for(var i=0;i<24;i++){
			if(isNaN(avg[i])){
				avg[i]=0;
			}
			//content-type
			if(isNaN(avgnul[i])){
				avgnul[i]=0;
			}
			if(isNaN(avgfon[i])){
				avgfon[i]=0;
			}
			if(isNaN(avgima[i])){
				avgima[i]=0;
			}
			if(isNaN(avgapp[i])){
				avgapp[i]=0;
			}
			if(isNaN(avgtex[i])){
				avgtex[i]=0;
			}
			//day
			if(isNaN(avgsun[i])){
				avgsun[i]=0;
			}
			if(isNaN(avgmon[i])){
				avgmon[i]=0;
			}
			if(isNaN(avgtue[i])){
				avgtue[i]=0;
			}
			if(isNaN(avgwed[i])){
				avgwed[i]=0;
			}
			if(isNaN(avgthu[i])){
				avgthu[i]=0;
			}
			if(isNaN(avgfri[i])){
				avgfri[i]=0;
			}
			if(isNaN(avgsat[i])){
				avgsat[i]=0;
			}
			//request-method
			if(isNaN(avgget[i])){
				avgget[i]=0;
			}
			if(isNaN(avgpost[i])){
				avgpost[i]=0;
			}
			if(isNaN(avgopt[i])){
				avgopt[i]=0;
			}
			//provider
			if(isNaN(avgote[i])){
				avgote[i]=0;
			}
			if(isNaN(avgfor[i])){
				avgfor[i]=0;
			}
			if(isNaN(avgwin[i])){
				avgwin[i]=0;
			}
		}
		
		/*Δημιουργία Βασικού Γραφήματος*/
		var ctx=document.getElementById('chartContainer');
		window.chart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"],
				datasets: [{
					label: 'Response timings analysis',
					data: avg,
					backgroundColor: "rgba(255, 99, 132, 1)",
					borderColor: "rgba(255, 99, 132, 1)",
					borderWidth: 3,
					fill: false,
					lineTension: 0
				}]
			},
			options: {
				plugins: {
					title: {
						display: true,
						text: 'Timings Analysis'
					}
				}
			}
		});
		
		/*Δημιουργία Βασικού Γραφήματος με πάτημα κουμπιού*/
		var button=document.getElementById("Basic");
		button.onclick = function (){
			deschart(window.chart);
			var ctx=document.getElementById('chartContainer');
			window.chart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"],
					datasets: [{
						label: 'Response timings analysis',
						data: avg,
						backgroundColor: "rgba(255, 99, 132, 1)",
						borderColor: "rgba(255, 99, 132, 1)",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					}]
				},
				options: {
					plugins: {
						title: {
							display: true,
							text: 'Timings Analysis'
						}
					}
				}
			});
		};
		
		/*Δημιουργία Γραφήματος ανά content-type με πάτημα κουμπιού*/
		var button=document.getElementById("Cont");
		button.onclick = function (){
			deschart(window.chart);
			var ctx=document.getElementById('chartContainer');
			window.chart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"],
					datasets: [{
						label: 'No Tags',
						data: avgnul,
						backgroundColor: "rgba(255, 99, 132, 1)",
						borderColor: "rgba(255, 99, 132, 1)",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'Font',
						data: avgfon,
						backgroundColor: "#8e5ea2",
						borderColor: "#8e5ea2",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'Image',
						data: avgima,
						backgroundColor: "#3e95cd",
						borderColor: "#3e95cd",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'Application',
						data: avgapp,
						backgroundColor: "#FFA500",
						borderColor: "#FFA500",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'Text',
						data: avgtex,
						backgroundColor: "#FFFF00",
						borderColor: "#FFFF00",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					}]
				},
				options: {
					plugins: {
						title: {
							display: true,
							text: 'Timings Analysis per Content Type'
						}
					}
				}
			});
		};
		
		/*Δημιουργία Γραφήματος ανά day με πάτημα κουμπιού*/
		var button=document.getElementById("Days");
		button.onclick = function (){
			deschart(window.chart);
			var ctx=document.getElementById('chartContainer');
			window.chart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"],
					datasets: [{
						label: 'Sunday',
						data: avgsun,
						backgroundColor: "rgba(255, 99, 132, 1)",
						borderColor: "rgba(255, 99, 132, 1)",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'Monday',
						data: avgmon,
						backgroundColor: "#8e5ea2",
						borderColor: "#8e5ea2",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'Tuesday',
						data: avgtue,
						backgroundColor: "#3e95cd",
						borderColor: "#3e95cd",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'Wednesday',
						data: avgwed,
						backgroundColor: "#FFA500",
						borderColor: "#FFA500",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'Thursday',
						data: avgthu,
						backgroundColor: "#FFFF00",
						borderColor: "#FFFF00",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'Friday',
						data: avgfri,
						backgroundColor: "#9ACD32",
						borderColor: "#9ACD32",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'Saturday',
						data: avgsat,
						backgroundColor: "#00008B",
						borderColor: "#00008B",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					}]
				},
				options: {
					plugins: {
						title: {
							display: true,
							text: 'Timings Analysis per Day'
						}
					}
				}
			});
		};
		
		/*Δημιουργία Γραφήματος ανά request-method με πάτημα κουμπιού*/
		var button=document.getElementById("Meth");
		button.onclick = function (){
			deschart(window.chart);
			var ctx=document.getElementById('chartContainer');
			window.chart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"],
					datasets: [{
						label: 'GET',
						data: avgget,
						backgroundColor: "rgba(255, 99, 132, 1)",
						borderColor: "rgba(255, 99, 132, 1)",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'POST',
						data: avgpost,
						backgroundColor: "#8e5ea2",
						borderColor: "#8e5ea2",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'OPTIONS',
						data: avgopt,
						backgroundColor: "#3e95cd",
						borderColor: "#3e95cd",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					}]
				},
				options: {
					plugins: {
						title: {
							display: true,
							text: 'Timings Analysis per Request Method'
						}
					}
				}
			});
		};
		
		/*Δημιουργία Γραφήματος ανά provider με πάτημα κουμπιού*/
		var button=document.getElementById("Prov");
		button.onclick = function (){
			deschart(window.chart);
			var ctx=document.getElementById('chartContainer');
			window.chart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"],
					datasets: [{
						label: 'COSMOTE',
						data: avgote,
						backgroundColor: "rgba(255, 99, 132, 1)",
						borderColor: "rgba(255, 99, 132, 1)",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'FORTHNET',
						data: avgfor,
						backgroundColor: "#8e5ea2",
						borderColor: "#8e5ea2",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					},
					{
						label: 'WIND',
						data: avgwin,
						backgroundColor: "#3e95cd",
						borderColor: "#3e95cd",
						borderWidth: 3,
						fill: false,
						lineTension: 0
					}]
				},
				options: {
					plugins: {
						title: {
							display: true,
							text: 'Timings Analysis per Provider'
						}
					}
				}
			});
		};		
	}
	
	function deschart(chart){ //συνάρτηση για καταστροφή προηγούμενου chart με το πάτημα του κουμπιού
		chart.destroy();
	}
  </script>
 </body>
</html>