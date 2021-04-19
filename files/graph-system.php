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
   <button  id="Prov">Providers</button>
   <button  id="Meth">Request Methods</button>
 <script>
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

		var xhr = new XMLHttpRequest();
		xhr.open("POST", "request.php");
		xhr.send();
		xhr.onload = function(){
		result = this.response;//file from php
		var edit=result.split("]");
			analysis(edit);
			//console.log(this.response);
	    };
	
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
		
	}
	
	for (var i=0;i<time.length;i++){
		for(var j = 0; j < ( time.length - i -1 ); j++){
			if(time[j] > time[j+1]){
         		var temp1 = time[j];
				time[j] = time[j + 1];
				time[j+1] = temp1;
				//console.log(typeof time);
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
		//console.log(avg[i]);
		
	}
	for (var i=0;i<24;i++){
		var counter=0;
		var counter1=0;
		var counter2=0;
		avgote[i]=0;
		avgfor[i]=0;
		avgwin[i]=0;
		for(var j=0;j<prov.length-1;j++){
			if (time[j]>=i && time[j]<i+1 && prov[j]==prov[1]){
				avgote[i]=avgote[i]+timi[j];
				counter++;
			}else if(time[j]>=i && time[j]<i+1 && prov[j]==prov[354]){
				avgfor[i]=avgfor[i]+timi[j];
				counter1++;
			}else if(time[j]>=i && time[j]<i+1 && prov[j]==prov[755]){
				avgwin[i]=avgwin[i]+timi[j];
				counter2++;
			}
		}
		avgote[i]=avgote[i]/counter;
		avgfor[i]=avgfor[i]/counter1;
		avgwin[i]=avgwin[i]/counter2;
	}
	for(var i=0;i<24;i++){
	    if(isNaN(avg[i])){
			avg[i]=0;
	    }
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
	
	/*for(var i=0;i<2500;i++){
		if (reqm[i]!= reqm[1]){	
		console.log(reqm[i]);
		console.log(i);
		}
	}*/
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
	
	for(var i=0;i<24;i++){
	    if(isNaN(avgget[i])){
			avgget[i]=0;
	    }
	    if(isNaN(avgpost[i])){
			avgpost[i]=0;
	    }
		if(isNaN(avgopt[i])){
			avgopt[i]=0;
	    }
	}
	
	
	
	//console.log(timi);
	var ctx=document.getElementById('chartContainer');
    window.chart = new Chart(ctx, {
	type: 'line',
	data: {        
		labels: ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"],
		datasets: [{
			label: 'Response timings analysis',
			data: avg,
			backgroundColor: "rgba(255, 99, 132, 0.2)",
			borderColor: "rgba(255, 99, 132, 1)",
			borderWidth: 3,
			fill: false,
			lineTension: 0
		}]
	}
});
var button=document.getElementById("Prov");
button.onclick = function (){
	a(window.chart);
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
		}
		]
	}
});
};
var button=document.getElementById("Meth");
button.onclick = function (){
	a(window.chart);
};
}

 function a(chart){
	 chart.destroy();
 }
 

  
  </script>
  
  </body>
  </html>