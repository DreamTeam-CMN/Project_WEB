<!--Έλεγχος ορθότητας password-->
<?php

/*Αρχικοποίηση μεταβλητών του password*/
 $var1=0;
 $var2=0;
 $var3=0;
 $var4=0;
 $var5=0;
 
  /*Διαδικασία ελέγχου πάτημα του πλήκτρου Submit*/
  if (isset($_POST["submit"])){
	  $user=$_POST['user'];
	  
	  /*Φόρτωση του username του εκάστοτε χρήστη*/
	  session_start();
	  $_SESSION['user']=$user;
	  
	  $oldpass=$_POST['oldpass'];
      $pass=$_POST['pass'];
      $conpass=$_POST['conpass'];
	  
	  /*Έλεγχος ύπαρξης περιεχομένου στα πεδία*/
	  if (!empty($_POST["user"])){
		   if (!empty($_POST["pass"])){
				  if (!empty($_POST["conpass"])){
					  
					  /*Κλήση των συναρτήσεων για έλεγχο του password*/
					   $var1=length($var1 , $pass);
				       $var2=num($var2 , $pass);
				       $var3=caps($var3 , $pass);
				       $var4=special($var4 , $pass);
					   $var5=identical($var5 , $pass , $conpass);
			        } else{
					   echo "Insert your password again";
				    }
			    } else{
				    echo "Insert your password";
			    }
        } else{
			echo "Insert your username";
		}
}
  /*Προσθήκη νέων στοιχείων στη βάση δεδομένων*/
  if ($var1==1){
	   if ($var2==1){
		    if ($var3==1){
			    if ($var4==1){
				     if ($var5==1){
						 
						 
						 $sql = "UPDATE userinfo SET username=?, password=?";
						 $stmt= $conn->prepare($sql);
						 $stmt->bind_param("ss", $user, $pass);
						 $stmt->execute();
						 
						 /*Ανακατεύθυνση στη σελίδα upload-system.php*/
					       header('Location: upload-system.php');
				        }
			        } 
		        }
	        }
        }
		
/*Συναρτήσεις*/
function length($var1 , $pass){
    if (strlen($pass)<8){
	  echo "Your password must be at least 8 characters long"; 
	  echo "<br>";
	} else{
		 $var1=$var1+1;
		 return $var1;
	}
}
 function num($var2 , $pass){
	 if (preg_match('#[0-9]#',$pass)){
         $var2=$var2+1;
		 return $var2;
    }else{
        echo "Your password must have at least 1 number";
		echo "<br>";
    }  
}
 function caps($var3 , $pass){
	 if(preg_match('/[A-Z]/', $pass)){
		 $var3=$var3+1;
		 return $var3;
	 }else{
		 echo "Your password must have at least 1 capital letter";
		 echo "<br>";
	 }
}
 function special($var4 , $pass){
	 if (preg_match('/[\'^$%&#*@~!?><>=+]/', $pass)){
		 $var4=$var4+1;
		 return $var4;
	  }else{
		  echo "Your password must have at least 1 special character";
		  echo "<br>";
        }
}
 function identical($var5 , $pass , $conpass){
	 if ($pass==$conpass){
		 $var5=$var5+1;
		 return $var5;
	 }else{
		 echo "Passwords don't match";
		 echo "<br>";
	 }
}

?>