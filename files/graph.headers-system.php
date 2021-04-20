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
  <script>
  var info=new Array();
  var contres=new Array();
  var cachres=new Array();
  var expres=new Array();
  var lares=new Array();
  var pro=new Array();
  var contreq=new Array();
  var cachreq=new Array();
  const nod=new Array();
  const nod1=new Array();
  const prova=new Array();
  var counter=0;
  
  /*Συλλογή δεδομένων*/
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "headers.php");
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
			contres[i]=info[i][0];//the contentType from response
			cachres[i]=info[i][1].slice(1,-1);//the cacheControl from response
			expres[i]=info[i][2].slice(1,-5);//the expires from response
			cachres[i]=cachres[i].split(" ");
			lares[i]=info[i][3].slice(1,-5);//the lastModified from response
			pro[i]=info[i][4];//the providers 
			contreq[i]=info[i][5];//the contentType from request
			cachreq[i]=info[i][6].slice(1,-1);//the cacheControl from request
		}
		
		/*Διαδικασία αφαίρεσης διπλότυπων από τα content-type του response*/
		for (var i=0;i<contres.length;i++){
			let exists=false;
			for (var j=0;j<nod.length;j++){
				if (contres[i]===nod[j]){
					exists=true;
					break;
				}
			}
			if (!exists){
				nod.push(contres[i]);
			}
		}
		
		/*Διαδικασία αφαίρεσης διπλότυπων από τα content-type του request*/
		for (var i=0;i<contreq.length;i++){
			let exists=false;
			for (var j=0;j<nod1.length;j++){
				if (contreq[i]===nod1[j]){
					exists=true;
					break;
				}
			}
			if (!exists){
				nod1.push(contreq[i]);
			}
		}
		
		/*Διαδικασία αφαίρεσης διπλότυπων από τους providers*/
		for (var i=0;i<pro.length;i++){
			let exists=false;
			for (var j=0;j<prova.length;j++){
				if (pro[i]===prova[j]){
					exists=true;
					break;
				}
			}
			if (!exists){
				prova.push(pro[i]);
			}
		}
		//for (var i=0;i<cachres.length-1;i++){
			//for(var j=0;cachres[i].length;j++){
				//counter++;
			//}
		//}
		console.log(cachres);
	}
	
	
	
  
  </script>
  </body>
</html>