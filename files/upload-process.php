<!--Φόρτωση αρχείου στον server-->
<?php
   if (isset($_POST["submit"])){
	   $file=$_FILES['file'];
	   $fileName=$_FILES['file']['name'];
	   $fileTmpName=$_FILES['file']['tmp_name'];
	   $fileSize=$_FILES['file']['size'];
	   $fileError=$_FILES['file']['error'];
	   $fileType=$_FILES['file']['type'];
	   
	   $fileExt=explode('.', $fileName);
	   $fileActualExt=strtolower(end($fileExt));
	   
	   $allowed=array('har');
	   
	   if (in_array($fileActualExt,$allowed)){
		   if ($fileError===0){
			   $fileNameNew=uniqid('',true).".".$fileActualExt;
			   $fileDestination='HAR-uploads/'.$fileNameNew;
			   move_uploaded_file($fileTmpName,$fileDestination); 
			   echo "<br>";
			   echo "Your har file uploaded successfully";
			}else{
				echo "Error uploading";
		   }
	   }else{
		   echo "Only har files allowed";
		   echo "Choose ONLY har files";
	   }
}