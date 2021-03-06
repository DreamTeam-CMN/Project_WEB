<?php

/*Αρχικοποίηση κενού μηνύματος*/
$message="";

/*Διαδικασία ελέγχου πάτημα του πλήκτρου Login*/
if (isset($_POST["loginad"])){
	
	  /*Έλεγχος ύπαρξης περιεχομένου στα πεδία*/
	  if (!empty($_POST["user"])){
		  if (!empty($_POST["pass"])){
			  
		  /*Έλεγχος ύπαρξης των παραπάνω στοιχείων στη βάση*/
		  $result=mysqli_query($conn,"SELECT * FROM userinfo WHERE username='" . $_POST["user"] . "' and password = '". $_POST["pass"]."'");
		  $count=mysqli_num_rows($result);
		  if($count==0){
		            $message = "Invalid Username or Password!";
			        echo $message;
				  }else{
					if ($_POST["user"]=="bigbrother"){
				      if($_POST["pass"]=="BIG123@@"){
			 $message = "You are successfully authenticated!";
			 echo $message;
			 $user=$_POST['user'];
		     
			 /*Φόρτωση του username του εκάστοτε χρήστη*/
			 session_start();
	         $_SESSION['user']=$user;
			 
			 /*Ανακατεύθυνση στη σελίδα home-system.php*/
			 header('Location: admin-page.php');
					  }
					}else{
						$message="You are not an admin.Get out!";
						echo "<br>";
						echo $message;
					}
			  }
		  }
		 }
	  }
  		    
?>