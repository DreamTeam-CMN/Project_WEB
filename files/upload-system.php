<!--Σύστημα upload αρχείων-->
<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
?>
<div class="menu">
<?php
/*Φόρτωση του username του εκάστοτε χρήστη*/
session_start();
$user = $_SESSION['user'];
echo "Welcome ".$user;
echo "<br>";
?>
</div>

<!DOCTYPE html>
<html>
    <head>
      <title>Upload Page</title>
	  <link rel="stylesheet" type="text/css" href="stylesheet-upload.css"></link>
    </head>
    <body>
  
      <!--Menu-->
	  <div class="menu">
      <a href='home-system.php'>Home</a>
	  <a href='/logout-system.php'>Log out</a><br>
	  </div>
  
	 <div class="container">
	 <div class="upload">
      <h2>Choose a File to Upload</h2>
	  
	  <div class="sep"></div>
      <input type="file" onchange="readFiles(event)" id="f" accept=".har">
	  <label for="f">Choose File</label>
      <br>
      <br>
      <input id="down" type="button" disabled="true" value="Download" onclick="save(event)">
      <br>
      <br>
      <input id="up" type="button" disabled="true" value="Upload" onclick="upload(event)">
	  <br>
	  <br>
	  </div>
   </div>
	  <div id="myDiv1"></div>
	  <div id="myDiv"></div>
      <script>
      /*Διαδικασία φόρτωσης και επεξεργασίας har αρχείου*/
      var EditedFile;

        function readFiles(event) {
            var fileList=event.target.files;
	        for(var i=0; i < fileList.length; i++ ) {
                 loadAndEdit(fileList[i]);
            }
            var theFile = fileList[0];
        }

        /*Φόρτωση har αρχείου*/	
        function loadAndEdit(theFile) {
            var reader = new FileReader();
	
            reader.onload = function(loadedEvent) {
                console.log(loadedEvent.target.result);
		        var harjson=JSON.parse(loadedEvent.target.result);//μετατροπή περιεχομένου αρχείου σε object
		
		        let newhar=JSON.parse(JSON.stringify(harjson));//αντίγραφο object προς επεξεργασία
		
		        /*επεξεργασία αντιγράφου*/
		        for (var k in newhar.log) {
                    if (k !== 'entries') {
                        delete newhar.log[k];
			        }else{
				        for (var l in newhar.log.entries){
					        for (var m in newhar.log.entries[l]){
					            if (m !== 'startedDateTime' && m !== 'serverIPAddress' && m !== 'timings' && m !== 'request' && m !== 'response'){
						            delete newhar.log.entries[l][m];
					            }
					        }
				        }
			        }
		        }
		        for (var k in newhar.log.entries){
			        for (var l in newhar.log.entries[k].timings){
				        if (l !== 'wait'){
					       delete newhar.log.entries[k].timings[l];
				        }
			        }
			        for (var m in newhar.log.entries[k].request){
				        if (m !== 'method' && m !== 'url' && m !== 'headers'){
					        delete newhar.log.entries[k].request[m];
						}else if (m == 'url'){
							newhar.log.entries[k].request[m] = newhar.log.entries[k].request[m].replace('http://','').replace('https://','').replace('www.','').split(/[/?#]/)[0];
				        }else if (m == 'headers'){
					        for (var t in newhar.log.entries[k].request.headers){
					            for (var q in newhar.log.entries[k].request.headers[t]){
						            if (q === 'name'){
								        if ((newhar.log.entries[k].request.headers[t][q] !== 'Cache-Control' && newhar.log.entries[k].request.headers[t][q] !== 'cache-control') && 
								            (newhar.log.entries[k].request.headers[t][q] !== 'Content-Type' && newhar.log.entries[k].request.headers[t][q] !== 'content-type') &&
								            (newhar.log.entries[k].request.headers[t][q] !== 'Pragma' && newhar.log.entries[k].request.headers[t][q] !== 'pragma') &&
								            (newhar.log.entries[k].request.headers[t][q] !== 'Expires' && newhar.log.entries[k].request.headers[t][q] !== 'expires') &&
								            (newhar.log.entries[k].request.headers[t][q] !== 'Age' && newhar.log.entries[k].request.headers[t][q] !== 'age') && 
								            (newhar.log.entries[k].request.headers[t][q] !== 'Last-Modified' && newhar.log.entries[k].request.headers[t][q] !== 'last-modified') && 
								            (newhar.log.entries[k].request.headers[t][q] !== 'Host' && newhar.log.entries[k].request.headers[t][q] !== 'host')){
									            delete newhar.log.entries[k].request.headers[t];
								        }
							        }  				
						        }
					        }
							newhar.log.entries[k].request.headers = $.grep(newhar.log.entries[k].request.headers,function(n){ return n == 0 || n });
				        }
			        }
					
			        for (var m in newhar.log.entries[k].response){
				        if (m !== 'status' && m !== 'statusText' && m !== 'headers'){
					        delete newhar.log.entries[k].response[m];
				        }else if (m == 'headers'){
					        for (var t in newhar.log.entries[k].response.headers){
					            for (var q in newhar.log.entries[k].response.headers[t]){
						            if (q === 'name'){
								         if ((newhar.log.entries[k].response.headers[t][q] !== 'Cache-Control' && newhar.log.entries[k].response.headers[t][q] !== 'cache-control') && 
								             (newhar.log.entries[k].response.headers[t][q] !== 'Content-Type' && newhar.log.entries[k].response.headers[t][q] !== 'content-type') &&
								             (newhar.log.entries[k].response.headers[t][q] !== 'Pragma' && newhar.log.entries[k].response.headers[t][q] !== 'pragma') &&
								             (newhar.log.entries[k].response.headers[t][q] !== 'Expires' && newhar.log.entries[k].response.headers[t][q] !== 'expires') &&
								             (newhar.log.entries[k].response.headers[t][q] !== 'Age' && newhar.log.entries[k].response.headers[t][q] !== 'age') && 
								             (newhar.log.entries[k].response.headers[t][q] !== 'Last-Modified' && newhar.log.entries[k].response.headers[t][q] !== 'last-modified') && 
								             (newhar.log.entries[k].response.headers[t][q] !== 'Host' && newhar.log.entries[k].response.headers[t][q] !== 'host')){
									            delete newhar.log.entries[k].response.headers[t];
								        }
							        } 				
						        }
					        }
							newhar.log.entries[k].response.headers = $.grep(newhar.log.entries[k].response.headers,function(n){ return n == 0 || n });
				        }
			        }
		        }
		        console.log(newhar);
		        
		        /*Συνάρτηση download*/
		        document.getElementById('down').onclick=function() {
                    const a = document.createElement("a");
                    a.href = URL.createObjectURL(new Blob([JSON.stringify(newhar, null, 2)], {
                        type: "text/plain"
                    }));
                    a.setAttribute("download", "data.json");
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                };//τέλος download
		       
                /*Συνάρτηση μεταφοράς δεδομένων προς upload*/
		        document.getElementById('up').onclick=function() {
					$.getJSON('https://ipapi.co/json/', function(data) {
                        var ipdata = JSON.stringify(data, null, 2);
						var ipdata1=JSON.parse(ipdata);
						var ucity=ipdata1.city;
						var	geo=ipdata1.latitude;
						var	geo2=ipdata1.longitude;
						var	org=ipdata1.org;
						var	uip=ipdata1.ip;
						var urL=newhar.log.entries[0].request.url;
						console.log(urL);
						var serverip=newhar.log.entries[0].serverIPAddress; //η ip του server
						/*Μεταφορά των τιμών των προσωπικών στοιχείων του χρήστη*/
						$.ajax({
							url: 'db-upload-system.php',
							type: 'POST',
							data: { ucity : ucity , geo : geo , geo2 : geo2 , org : org , uip : uip , serverip : serverip , urL : urL},
							success: function(data) {
								$('#myDiv').html(data);								
							},
							error: function(XMLHttpRequest, textStatus, errorThrown) {
								alert('failed to upload');
							}
						});
					});
					/*Μεταφορά του αρχείου μετά από μετατροπή σε string*/
					var delayInMilliseconds = 3000; //3 seconds

					setTimeout(function() {
						var EditedFile=JSON.stringify(newhar);
						$("#myDiv1").load('dbfile-upload-system.php', {EditedFile : EditedFile});
						alert("Upload is done!");
					}, delayInMilliseconds);
				}//τέλος συνάρτησης μεταφοράς
            }
            reader.readAsText(theFile);
	        document.getElementById("down").disabled=false;
	        document.getElementById("up").disabled=false;
        }
		
		

      </script>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </body>
</html>