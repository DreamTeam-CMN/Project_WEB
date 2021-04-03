<!--Έλεγχος ορθότητας εισαγώμενων στοιχείων για είσοδο του χρήστη-->
<?php

/*Αρχικοποίηση κενού μηνύματος*/
$message="";

/*Διαδικασία ελέγχου πάτημα του πλήκτρου Login*/
if (isset($_POST["login"])){
	
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
			 if ($_POST["user"]!=="bigbrother"){
			 $message = "You are successfully authenticated!";
			 echo $message;
			 $user=$_POST['user'];
		     
			 /*Φόρτωση του username του εκάστοτε χρήστη*/
			 session_start();
	         $_SESSION['user']=$user;
			 
			 /*Ανακατεύθυνση στη σελίδα home-system.php*/
			 header('Location: home-system.php');
			 	
			 }else{
				 echo "Invalid Username or Password";
			 }
		  }
		 }
	  }
}
  		    
?>