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
 <input type="file" id="file-selector" accept=".har">
<script>
  const fileSelector = document.getElementById('file-selector');
  fileSelector.addEventListener('change', (event) => {
    const fileList = event.target.files;
    console.log(fileList);
  });
</script>
<br>
<br>
<script>
function dude(file) {
  // Check if the file is an image.
  const reader = new FileReader();
  reader.addEventListener('load', (event) => {
    har.src = event.target.result;
  });
  reader.readAsDataURL(file);
}
</script>
<form action="?" method="post">
  <button type="submit" name="submit">Upload File</button> <br> <br>  
    <a href="myfile" download=""><button type="button">Download File</button></a>
</form>
	
	<!--Σύνδεση με την σελίδα upload-process.php-->
    <?php include 'upload-process.php' ?>	
  </body>
</html>