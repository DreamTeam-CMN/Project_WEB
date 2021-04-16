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

 <script>
var info=new Array();
var result=new Array();
var date=new Array();
var time=new Array();
var prov=new Array();
var reqm=new Array();	
var cont=new Array();
var timi=new Array();
		
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "request.php");
		xhr.send();
		xhr.onload = function(){
			result = this.response;//file from php
		var edit=result.split("]");
			analysis(edit);
	    };
	
function analysis (edit) {
	
	for (var i=0;i<edit.length-1;i++){
		info[i]=edit[i].slice(1);
		info[i]=info[i].split(",");
		date[i]=info[i][1].slice(1,11);//the date from startedDateTime
		time[i]=info[i][1].slice(12,20);//the time from startedDateTime
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
	
	var ctx=document.getElementById('chartContainer');
    var chart = new Chart(ctx, {
	type: 'line',
	data: {        
		labels: time,
		datasets: [{
			label: 'Response timings analysis',
			data: timi,
			backgroundColor: "rgba(255, 99, 132, 0.2)",
			borderColor: "rgba(255, 99, 132, 1)",
			borderWidth: 1,
			fill: false,
			lineTension: 0
		}]
	}
});
}
 
 

  
  </script>
  
  </body>
  </html>