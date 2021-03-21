<!--Σύστημα upload αρχείων-->
<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
echo "Connected Successfully";
echo "<br>";

/*Φόρτωση του username του εκάστοτε χρήστη*/
session_start();
$user = $_SESSION['user'];
echo "Welcome ".$user;
echo "<br>";

?>

<!DOCTYPE html>
<html>
    <head>
      <title>Upload Page</title>
    </head>
    <body>
  
      <!--Menu-->
      <a href='/logout-system.php'>Log out</a>
      <a href='/profile.management-system.php'>Profile management</a>
      <a href='/upload-system.php'>Upload</a>
      <a href='/home-system.php'>Home</a>
  
      <h1>Choose a File to Upload</h1>
      <input type="file" onchange="readFiles(event)" accept=".har">
      <br>
      <br>
      <input id="down" type="button" disabled="true" value="Download" onclick="save(event)">
      <br>
      <br>
      <input id="up" type="button" disabled="true" value="Upload" onclick="upload(event)">
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
		
                /*Συνάρτηση upload*/
		        document.getElementById('up').onclick=function() {
		            $.getJSON('https://ipapi.co/json/', function(data) {
                        console.log(JSON.stringify(data, null, 2));
                    });
		            EditedFile=JSON.stringify(newhar);
		            console.log(EditedFile);
	            }
            }
            reader.readAsText(theFile);
	        document.getElementById("down").disabled=false;
	        document.getElementById("up").disabled=false;
        }

      </script>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </body>
</html>