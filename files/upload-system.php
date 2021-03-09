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
<input type="button" value="Upload" onclick="upload(event)">
<script>
function readFiles(event) {
    var fileList=event.target.files;
	for(var i=0; i < fileList.length; i++ ) {
        loadAsText(fileList[i]);
}
var theFile = fileList[0];
}
	
function loadAsText(theFile) {
    var reader = new FileReader();
	
    reader.onload = function(loadedEvent) {
        // result contains loaded file.
        console.log(loadedEvent.target.result);
    }
    reader.readAsText(theFile);
}
console.stdlog = console.log.bind(console);
console.logs = [];
console.log = function(){
   console.logs.push(Array.from(arguments));
   console.stdlog.apply(console, arguments);
   //document.write(console.logs); κραταμε το har της κονσολας
}
//Upload!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
function upload(event) {
    console.log("Uploading...");

    const fileField = document.getElementById("fileField");
    const formData = new FormData();

    formData.append('test', 'testValue');
    formData.append('selectedFile', fileField.files[0]);

    fetch('http://localhost/upload-system.php?', {
        method: 'PUT',
        body: formData
    })
    .then((result) => {
        console.log('Success:', result);
    })
    ;
}
</script>
  </body>
</html>