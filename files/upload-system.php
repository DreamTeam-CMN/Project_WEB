<?php

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
    <title>Upload Page</title>
  </head>
  <body>
  <a href='/logout-system.php'>Log out</a>
  <a href='/profile.management-system.php'>Profile management</a>
  <a href='/upload-system.php'>Upload</a>
  <a href='/home-system.php'>Home</a>
  <h1>Choose a File to Upload</h1>
  <form class="form" id="myform">
    <input type="file" name="myfile" id="myfile"> <br><br>
	<button type="submit">Upload File</button>
	
  </form>
  <script>
    const myform=document.getElementById("myform");
	const myfile=document.getElementById("myfile");
	myform.addEventListener("submit" , e => {
		e.preventDefault();
		const endpoint="upload.php";
		const formData=new formData();
		formData.append("myfile" , myfile.files[0]);
	fetch(endpoint , {
		method:"post",
	body: formData})
	)
	</script>
    <a href="myfile" download=""><button type=button">Download File</button></a>	
  </body>
</html>