<?php
$message="";
if (isset($_POST["login"])){
	  if (!empty($_POST["user"])){
		  if (!empty($_POST["pass"])){
		  $result=mysqli_query($conn,"SELECT * FROM userinfo WHERE username='" . $_POST["user"] . "' and password = '". $_POST["pass"]."'");
		  $count=mysqli_num_rows($result);
		  if($count==0){
		     $message = "Invalid Username or Password!";
			 echo $message;
		  }else{
			 $message = "You are successfully authenticated!";
			 echo $message;
			 $user=$_POST['user'];
			 session_start();
	         $_SESSION['user']=$user;
			 header('Location: home-system.php');
		  }
		 }
	  }
}
  		    
?>